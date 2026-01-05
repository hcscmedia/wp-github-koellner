<?php
/**
 * Plugin Name: WP GitHub Koellner
 * Plugin URI: https://github.com/hcscmedia/wp-github-koellner
 * Description: Display your GitHub projects on your WordPress site using a shortcode
 * Version: 1.0.0
 * Author: HCS Media
 * Author URI: https://github.com/hcscmedia
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: wp-github-koellner
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

define('WP_GITHUB_KOELLNER_VERSION', '1.0.0');
define('WP_GITHUB_KOELLNER_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('WP_GITHUB_KOELLNER_PLUGIN_URL', plugin_dir_url(__FILE__));

/**
 * Main plugin class
 */
class WP_GitHub_Koellner {
    
    private static $instance = null;
    
    /**
     * GitHub username validation pattern
     */
    const GITHUB_USERNAME_PATTERN = '/^[a-zA-Z0-9]([a-zA-Z0-9-]*[a-zA-Z0-9])?$/';
    
    /**
     * Get singleton instance
     */
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /**
     * Constructor
     */
    private function __construct() {
        add_action('plugins_loaded', array($this, 'init'));
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_init', array($this, 'register_settings'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_styles'));
        add_shortcode('github_projects', array($this, 'github_projects_shortcode'));
    }
    
    /**
     * Initialize plugin
     */
    public function init() {
        load_plugin_textdomain('wp-github-koellner', false, dirname(plugin_basename(__FILE__)) . '/languages/');
    }
    
    /**
     * Enqueue plugin styles
     */
    public function enqueue_styles() {
        wp_enqueue_style('wp-github-koellner', WP_GITHUB_KOELLNER_PLUGIN_URL . 'assets/css/style.css', array(), WP_GITHUB_KOELLNER_VERSION);
    }
    
    /**
     * Add admin menu
     */
    public function add_admin_menu() {
        add_options_page(
            __('GitHub Projects Settings', 'wp-github-koellner'),
            __('GitHub Projects', 'wp-github-koellner'),
            'manage_options',
            'wp-github-koellner',
            array($this, 'settings_page')
        );
    }
    
    /**
     * Register plugin settings
     */
    public function register_settings() {
        register_setting('wp_github_koellner_settings', 'wp_github_koellner_username', array(
            'sanitize_callback' => array($this, 'sanitize_username'),
        ));
        register_setting('wp_github_koellner_settings', 'wp_github_koellner_cache_time', array(
            'sanitize_callback' => array($this, 'sanitize_cache_time'),
        ));
        
        add_settings_section(
            'wp_github_koellner_main',
            __('GitHub Settings', 'wp-github-koellner'),
            null,
            'wp-github-koellner'
        );
        
        add_settings_field(
            'wp_github_koellner_username',
            __('GitHub Username', 'wp-github-koellner'),
            array($this, 'username_field_callback'),
            'wp-github-koellner',
            'wp_github_koellner_main'
        );
        
        add_settings_field(
            'wp_github_koellner_cache_time',
            __('Cache Time (hours)', 'wp-github-koellner'),
            array($this, 'cache_time_field_callback'),
            'wp-github-koellner',
            'wp_github_koellner_main'
        );
    }
    
    /**
     * Username field callback
     */
    public function username_field_callback() {
        $username = get_option('wp_github_koellner_username', '');
        echo '<input type="text" name="wp_github_koellner_username" value="' . esc_attr($username) . '" class="regular-text" />';
        echo '<p class="description">' . __('Enter your GitHub username to display your repositories.', 'wp-github-koellner') . '</p>';
    }
    
    /**
     * Cache time field callback
     */
    public function cache_time_field_callback() {
        $cache_time = get_option('wp_github_koellner_cache_time', '6');
        echo '<input type="number" name="wp_github_koellner_cache_time" value="' . esc_attr($cache_time) . '" min="1" max="24" />';
        echo '<p class="description">' . __('How long to cache GitHub data (1-24 hours). Default: 6 hours.', 'wp-github-koellner') . '</p>';
    }
    
    /**
     * Sanitize GitHub username
     */
    public function sanitize_username($username) {
        $username = sanitize_text_field($username);
        // GitHub usernames can only contain alphanumeric characters and hyphens
        // and cannot begin or end with a hyphen
        if (!preg_match(self::GITHUB_USERNAME_PATTERN, $username)) {
            add_settings_error(
                'wp_github_koellner_username',
                'invalid_username',
                __('Invalid GitHub username. Username can only contain alphanumeric characters and hyphens, and cannot begin or end with a hyphen.', 'wp-github-koellner'),
                'error'
            );
            // Return the previous value
            return get_option('wp_github_koellner_username', '');
        }
        return $username;
    }
    
    /**
     * Sanitize cache time
     */
    public function sanitize_cache_time($cache_time) {
        $cache_time = intval($cache_time);
        // Ensure cache time is between 1 and 24 hours
        if ($cache_time < 1 || $cache_time > 24) {
            add_settings_error(
                'wp_github_koellner_cache_time',
                'invalid_cache_time',
                __('Cache time must be between 1 and 24 hours.', 'wp-github-koellner'),
                'error'
            );
            // Return default value
            return 6;
        }
        return $cache_time;
    }
    
    /**
     * Settings page
     */
    public function settings_page() {
        if (!current_user_can('manage_options')) {
            return;
        }
        ?>
        <div class="wrap">
            <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
            <form action="options.php" method="post">
                <?php
                settings_fields('wp_github_koellner_settings');
                do_settings_sections('wp-github-koellner');
                submit_button(__('Save Settings', 'wp-github-koellner'));
                ?>
            </form>
            
            <hr />
            
            <h2><?php _e('How to Use', 'wp-github-koellner'); ?></h2>
            <p><?php _e('Use the shortcode <code>[github_projects]</code> to display your GitHub repositories on any page or post.', 'wp-github-koellner'); ?></p>
            
            <h3><?php _e('Shortcode Parameters', 'wp-github-koellner'); ?></h3>
            <ul>
                <li><code>[github_projects]</code> - <?php _e('Display all public repositories', 'wp-github-koellner'); ?></li>
                <li><code>[github_projects limit="5"]</code> - <?php _e('Limit the number of repositories displayed', 'wp-github-koellner'); ?></li>
                <li><code>[github_projects username="other_user"]</code> - <?php _e('Display repositories from a different user', 'wp-github-koellner'); ?></li>
            </ul>
        </div>
        <?php
    }
    
    /**
     * Fetch GitHub repositories
     */
    private function fetch_github_repos($username, $limit = null) {
        // Validate username format
        if (!preg_match(self::GITHUB_USERNAME_PATTERN, $username)) {
            return array('error' => __('Invalid GitHub username format.', 'wp-github-koellner'));
        }
        
        $cache_key = 'wp_github_koellner_repos_' . $username;
        $cached_data = get_transient($cache_key);
        
        if (false !== $cached_data) {
            return $cached_data;
        }
        
        $api_url = 'https://api.github.com/users/' . urlencode($username) . '/repos?sort=updated&per_page=100';
        
        $response = wp_remote_get($api_url, array(
            'headers' => array(
                'User-Agent' => 'WordPress/WP-GitHub-Koellner',
            ),
            'timeout' => 15,
        ));
        
        if (is_wp_error($response)) {
            return array('error' => $response->get_error_message());
        }
        
        $body = wp_remote_retrieve_body($response);
        $repos = json_decode($body, true);
        
        if (!is_array($repos)) {
            return array('error' => __('Invalid response from GitHub API', 'wp-github-koellner'));
        }
        
        // Check for API error
        if (isset($repos['message'])) {
            return array('error' => sanitize_text_field($repos['message']));
        }
        
        // Cache the results (validated by sanitize_cache_time)
        $cache_time = intval(get_option('wp_github_koellner_cache_time', 6));
        $cache_duration = $cache_time * HOUR_IN_SECONDS;
        set_transient($cache_key, $repos, $cache_duration);
        
        return $repos;
    }
    
    /**
     * GitHub projects shortcode
     */
    public function github_projects_shortcode($atts) {
        $atts = shortcode_atts(array(
            'username' => get_option('wp_github_koellner_username', ''),
            'limit' => null,
        ), $atts);
        
        $username = sanitize_text_field($atts['username']);
        $limit = $atts['limit'] ? intval($atts['limit']) : null;
        
        if (empty($username)) {
            return '<div class="wp-github-koellner-error">' . __('Please configure your GitHub username in the plugin settings.', 'wp-github-koellner') . '</div>';
        }
        
        $repos = $this->fetch_github_repos($username, $limit);
        
        if (isset($repos['error'])) {
            return '<div class="wp-github-koellner-error">' . sprintf(__('Error fetching GitHub repositories: %s', 'wp-github-koellner'), esc_html($repos['error'])) . '</div>';
        }
        
        if (empty($repos)) {
            return '<div class="wp-github-koellner-message">' . __('No repositories found.', 'wp-github-koellner') . '</div>';
        }
        
        // Limit repos if needed
        if ($limit) {
            $repos = array_slice($repos, 0, $limit);
        }
        
        // Build output
        $output = '<div class="wp-github-koellner-projects">';
        
        foreach ($repos as $repo) {
            $output .= '<div class="github-project">';
            $output .= '<div class="project-header">';
            $output .= '<h3 class="project-name"><a href="' . esc_url($repo['html_url']) . '" target="_blank" rel="noopener noreferrer">' . esc_html($repo['name']) . '</a></h3>';
            $output .= '</div>';
            
            if (!empty($repo['description'])) {
                $output .= '<p class="project-description">' . esc_html($repo['description']) . '</p>';
            }
            
            $output .= '<div class="project-meta">';
            
            if (!empty($repo['language'])) {
                $output .= '<span class="project-language"><span class="language-dot"></span>' . esc_html($repo['language']) . '</span>';
            }
            
            if (isset($repo['stargazers_count'])) {
                $output .= '<span class="project-stars">⭐ ' . intval($repo['stargazers_count']) . '</span>';
            }
            
            if (isset($repo['forks_count'])) {
                $output .= '<span class="project-forks">🔀 ' . intval($repo['forks_count']) . '</span>';
            }
            
            if (!empty($repo['updated_at'])) {
                try {
                    $date = new DateTime($repo['updated_at']);
                    $output .= '<span class="project-updated">' . sprintf(__('Updated: %s', 'wp-github-koellner'), $date->format('M j, Y')) . '</span>';
                } catch (Exception $e) {
                    // Skip invalid date format
                }
            }
            
            $output .= '</div>'; // project-meta
            $output .= '</div>'; // github-project
        }
        
        $output .= '</div>'; // wp-github-koellner-projects
        
        return $output;
    }
}

// Initialize the plugin
WP_GitHub_Koellner::get_instance();
