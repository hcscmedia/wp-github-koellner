# WP GitHub Koellner

A WordPress plugin that displays your GitHub projects on your website using a simple shortcode.

## Description

WP GitHub Koellner allows you to showcase your GitHub repositories on your WordPress site. The plugin fetches your public repositories from GitHub and displays them in a clean, responsive grid layout.

## Features

- 🚀 Easy to use shortcode: `[github_projects]`
- 🎨 Responsive and modern design
- ⚡ Caching system to reduce API calls
- 🔧 Configurable settings page
- 🌐 Support for multiple GitHub users
- 📊 Display repository stats (stars, forks, language)
- 🌙 Dark mode support

## Installation

1. Upload the `wp-github-koellner` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to Settings > GitHub Projects and configure your GitHub username
4. Use the `[github_projects]` shortcode in any page or post

## Configuration

After activating the plugin, go to **Settings > GitHub Projects** to configure:

- **GitHub Username**: Your GitHub username (required)
- **Cache Time**: How long to cache GitHub data (1-24 hours, default: 6 hours)

## Usage

### Basic Usage

Display all your public repositories:
```
[github_projects]
```

### Shortcode Parameters

**Limit the number of repositories:**
```
[github_projects limit="5"]
```

**Display repositories from a different user:**
```
[github_projects username="other_user"]
```

**Combine parameters:**
```
[github_projects username="octocat" limit="10"]
```

## Requirements

- WordPress 5.0 or higher
- PHP 7.0 or higher
- Active internet connection for GitHub API access

## Frequently Asked Questions

### Do I need a GitHub API token?

No, this plugin uses the public GitHub API which doesn't require authentication for public repositories.

### How often does the plugin fetch data from GitHub?

The plugin caches GitHub data for 6 hours by default (configurable from 1-24 hours) to reduce API calls and improve performance.

### Can I display repositories from multiple users?

Yes, you can use the `username` parameter in the shortcode to display repositories from different users on different pages.

### Is there a limit to the number of repositories displayed?

By default, the plugin fetches up to 100 repositories per user. You can use the `limit` parameter to display fewer repositories.

## Support

For issues, questions, or contributions, please visit:
https://github.com/hcscmedia/wp-github-koellner

## License

This plugin is licensed under the GPL-2.0+ License.

## Credits

Developed by HCS Media