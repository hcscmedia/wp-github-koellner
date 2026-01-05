<?php
/**
 * Plugin Name: WP GitHub Köllner
 * Plugin URI: https://github.com/hcscmedia/wp-github-koellner
 * Description: Zeigt GitHub-Projekte auf deiner WordPress-Seite an
 * Version: 1.0.0
 * Author: HCSC Media
 * Author URI: https://github.com/hcscmedia
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: wp-github-koellner
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('WP_GITHUB_KOELLNER_VERSION', '1.0.0');
define('WP_GITHUB_KOELLNER_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('WP_GITHUB_KOELLNER_PLUGIN_URL', plugin_dir_url(__FILE__));

/**
 * Main plugin class
 */
class WP_GitHub_Koellner {
    
    private static $instance = null;
    
    /**
     * Get singleton instance
     */
    public static function get_instance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /**
     * Constructor
     */
    private function __construct() {
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_init', array($this, 'register_settings'));
        add_shortcode('github_projects', array($this, 'github_projects_shortcode'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_styles'));
    }
    
    /**
     * Enqueue frontend styles
     */
    public function enqueue_styles() {
        wp_enqueue_style(
            'wp-github-koellner',
            WP_GITHUB_KOELLNER_PLUGIN_URL . 'assets/css/style.css',
            array(),
            WP_GITHUB_KOELLNER_VERSION
        );
    }
    
    /**
     * Add admin menu
     */
    public function add_admin_menu() {
        add_options_page(
            'GitHub Projekte Einstellungen',
            'GitHub Projekte',
            'manage_options',
            'wp-github-koellner',
            array($this, 'settings_page')
        );
    }
    
    /**
     * Register settings
     */
    public function register_settings() {
        register_setting('wp_github_koellner_settings', 'wp_github_koellner_username');
        register_setting('wp_github_koellner_settings', 'wp_github_koellner_token');
        register_setting('wp_github_koellner_settings', 'wp_github_koellner_cache_time');
        
        add_settings_section(
            'wp_github_koellner_main',
            'GitHub API Einstellungen',
            array($this, 'settings_section_callback'),
            'wp-github-koellner'
        );
        
        add_settings_field(
            'wp_github_koellner_username',
            'GitHub Benutzername',
            array($this, 'username_field_callback'),
            'wp-github-koellner',
            'wp_github_koellner_main'
        );
        
        add_settings_field(
            'wp_github_koellner_token',
            'GitHub Personal Access Token (optional)',
            array($this, 'token_field_callback'),
            'wp-github-koellner',
            'wp_github_koellner_main'
        );
        
        add_settings_field(
            'wp_github_koellner_cache_time',
            'Cache-Zeit (in Stunden)',
            array($this, 'cache_time_field_callback'),
            'wp-github-koellner',
            'wp_github_koellner_main'
        );
    }
    
    /**
     * Settings section callback
     */
    public function settings_section_callback() {
        echo '<p>Gib deinen GitHub-Benutzernamen ein, um deine Projekte anzuzeigen. Ein Personal Access Token ist optional, aber empfohlen für höhere API-Limits.</p>';
    }
    
    /**
     * Username field callback
     */
    public function username_field_callback() {
        $username = get_option('wp_github_koellner_username', '');
        echo '<input type="text" name="wp_github_koellner_username" value="' . esc_attr($username) . '" class="regular-text" />';
        echo '<p class="description">Dein GitHub-Benutzername (z.B. "hcscmedia")</p>';
    }
    
    /**
     * Token field callback
     */
    public function token_field_callback() {
        $token = get_option('wp_github_koellner_token', '');
        echo '<input type="password" name="wp_github_koellner_token" value="' . esc_attr($token) . '" class="regular-text" />';
        echo '<p class="description">Optional: Personal Access Token für höhere API-Limits</p>';
    }
    
    /**
     * Cache time field callback
     */
    public function cache_time_field_callback() {
        $cache_time = get_option('wp_github_koellner_cache_time', '1');
        echo '<input type="number" name="wp_github_koellner_cache_time" value="' . esc_attr($cache_time) . '" min="1" max="24" />';
        echo '<p class="description">Wie lange sollen die GitHub-Daten zwischengespeichert werden? (Standard: 1 Stunde)</p>';
    }
    
    /**
     * Settings page
     */
    public function settings_page() {
        ?>
        <div class="wrap">
            <h1>GitHub Projekte Einstellungen</h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('wp_github_koellner_settings');
                do_settings_sections('wp-github-koellner');
                submit_button();
                ?>
            </form>
            
            <hr />
            
            <h2>Verwendung</h2>
            <p>Verwende den folgenden Shortcode, um deine GitHub-Projekte anzuzeigen:</p>
            <code>[github_projects]</code>
            
            <h3>Shortcode-Optionen:</h3>
            <ul>
                <li><code>[github_projects limit="6"]</code> - Anzahl der anzuzeigenden Projekte (Standard: 10)</li>
                <li><code>[github_projects sort="updated"]</code> - Sortierung: "updated", "created", "pushed", "full_name" (Standard: "updated")</li>
                <li><code>[github_projects type="owner"]</code> - Repository-Typ: "owner", "public", "private", "member" (Standard: "owner")</li>
            </ul>
        </div>
        <?php
    }
    
    /**
     * Fetch GitHub repositories
     */
    private function fetch_github_repos($username, $token = '', $sort = 'updated', $type = 'owner') {
        $cache_key = 'wp_github_koellner_repos_' . md5($username . $sort . $type);
        $cached_data = get_transient($cache_key);
        
        if ($cached_data !== false) {
            return $cached_data;
        }
        
        $url = "https://api.github.com/users/{$username}/repos";
        $url = add_query_arg(array(
            'sort' => $sort,
            'type' => $type,
            'per_page' => 100
        ), $url);
        
        $args = array(
            'headers' => array(
                'User-Agent' => 'WP-GitHub-Koellner/' . WP_GITHUB_KOELLNER_VERSION,
            ),
            'timeout' => 15
        );
        
        if (!empty($token)) {
            $args['headers']['Authorization'] = 'token ' . $token;
        }
        
        $response = wp_remote_get($url, $args);
        
        if (is_wp_error($response)) {
            return array('error' => 'API-Anfrage fehlgeschlagen: ' . $response->get_error_message());
        }
        
        $status_code = wp_remote_retrieve_response_code($response);
        if ($status_code !== 200) {
            return array('error' => 'GitHub API Fehler: HTTP ' . $status_code);
        }
        
        $body = wp_remote_retrieve_body($response);
        $repos = json_decode($body, true);
        
        if (!is_array($repos)) {
            return array('error' => 'Ungültige Antwort von GitHub API');
        }
        
        // Cache for specified hours
        $cache_time = get_option('wp_github_koellner_cache_time', 1);
        set_transient($cache_key, $repos, $cache_time * HOUR_IN_SECONDS);
        
        return $repos;
    }
    
    /**
     * GitHub projects shortcode
     */
    public function github_projects_shortcode($atts) {
        $atts = shortcode_atts(array(
            'limit' => 10,
            'sort' => 'updated',
            'type' => 'owner'
        ), $atts);
        
        $username = get_option('wp_github_koellner_username', '');
        if (empty($username)) {
            return '<div class="wp-github-koellner-error">Bitte konfiguriere deinen GitHub-Benutzernamen in den Einstellungen.</div>';
        }
        
        $token = get_option('wp_github_koellner_token', '');
        $repos = $this->fetch_github_repos($username, $token, $atts['sort'], $atts['type']);
        
        if (isset($repos['error'])) {
            return '<div class="wp-github-koellner-error">' . esc_html($repos['error']) . '</div>';
        }
        
        if (empty($repos)) {
            return '<div class="wp-github-koellner-empty">Keine GitHub-Projekte gefunden.</div>';
        }
        
        // Limit results
        $repos = array_slice($repos, 0, intval($atts['limit']));
        
        // Build output
        ob_start();
        ?>
        <div class="wp-github-koellner-container">
            <div class="github-projects-grid">
                <?php foreach ($repos as $repo): ?>
                    <div class="github-project-card">
                        <div class="project-header">
                            <h3 class="project-title">
                                <a href="<?php echo esc_url($repo['html_url']); ?>" target="_blank" rel="noopener noreferrer">
                                    <?php echo esc_html($repo['name']); ?>
                                </a>
                            </h3>
                            <?php if ($repo['private']): ?>
                                <span class="project-badge private">Privat</span>
                            <?php else: ?>
                                <span class="project-badge public">Öffentlich</span>
                            <?php endif; ?>
                        </div>
                        
                        <?php if (!empty($repo['description'])): ?>
                            <p class="project-description"><?php echo esc_html($repo['description']); ?></p>
                        <?php endif; ?>
                        
                        <div class="project-meta">
                            <?php if (!empty($repo['language'])): ?>
                                <span class="meta-item language">
                                    <span class="language-dot" style="background-color: <?php echo esc_attr($this->get_language_color($repo['language'])); ?>"></span>
                                    <?php echo esc_html($repo['language']); ?>
                                </span>
                            <?php endif; ?>
                            
                            <span class="meta-item stars">
                                ⭐ <?php echo number_format_i18n($repo['stargazers_count']); ?>
                            </span>
                            
                            <span class="meta-item forks">
                                🔀 <?php echo number_format_i18n($repo['forks_count']); ?>
                            </span>
                        </div>
                        
                        <?php if (!empty($repo['topics']) && is_array($repo['topics'])): ?>
                            <div class="project-topics">
                                <?php foreach (array_slice($repo['topics'], 0, 5) as $topic): ?>
                                    <span class="topic-tag"><?php echo esc_html($topic); ?></span>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        
                        <div class="project-footer">
                            <span class="updated-date">
                                Aktualisiert: <?php echo human_time_diff(strtotime($repo['updated_at']), current_time('timestamp')); ?> ago
                            </span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
    
    /**
     * Get language color
     */
    private function get_language_color($language) {
        $colors = array(
            'JavaScript' => '#f1e05a',
            'TypeScript' => '#3178c6',
            'Python' => '#3572A5',
            'Java' => '#b07219',
            'C' => '#555555',
            'C++' => '#f34b7d',
            'C#' => '#178600',
            'PHP' => '#4F5D95',
            'Ruby' => '#701516',
            'Go' => '#00ADD8',
            'Rust' => '#dea584',
            'Swift' => '#ffac45',
            'Kotlin' => '#A97BFF',
            'Dart' => '#00B4AB',
            'HTML' => '#e34c26',
            'CSS' => '#563d7c',
            'Shell' => '#89e051',
            'Vue' => '#41b883',
            'React' => '#61dafb',
        );
        
        return isset($colors[$language]) ? $colors[$language] : '#cccccc';
    }
}

// Initialize the plugin
WP_GitHub_Koellner::get_instance();
