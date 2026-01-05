# WP GitHub Koellner - Installation & Usage Guide

## Quick Start

### Installation Steps

1. **Upload the Plugin**
   - Download or clone this repository
   - Upload the `wp-github-koellner` folder to `/wp-content/plugins/` directory
   - Or install via WordPress plugin upload (zip the folder first)

2. **Activate the Plugin**
   - Go to WordPress Admin → Plugins
   - Find "WP GitHub Koellner" 
   - Click "Activate"

3. **Configure Settings**
   - Go to Settings → GitHub Projects
   - Enter your GitHub username
   - Set cache time (optional, default is 6 hours)
   - Click "Save Settings"

### Using the Shortcode

#### Basic Usage
Add this shortcode to any page or post:
```
[github_projects]
```

#### With Parameters

**Limit repositories:**
```
[github_projects limit="5"]
```

**Show different user's repos:**
```
[github_projects username="octocat"]
```

**Combine parameters:**
```
[github_projects username="torvalds" limit="10"]
```

## Features

### Display Information
Each repository card shows:
- Repository name (linked to GitHub)
- Description
- Primary programming language
- Star count
- Fork count
- Last update date

### Responsive Design
- Desktop: Multi-column grid layout
- Mobile: Single column stacked layout
- Hover effects for better interaction

### Performance
- Caching system to reduce API calls
- Configurable cache duration (1-24 hours)
- Default cache: 6 hours

### Security
- Input validation for usernames
- XSS prevention with proper escaping
- Sanitization of all data
- Secure external links (rel="noopener noreferrer")

## Troubleshooting

### "Please configure your GitHub username" error
→ Go to Settings → GitHub Projects and enter your username

### No repositories showing
→ Check that:
1. Your GitHub username is correct
2. You have public repositories
3. Clear WordPress cache if using a caching plugin

### API rate limit errors
→ Increase cache time in settings to reduce API calls

## Customization

### Styling
Edit `/assets/css/style.css` to customize:
- Colors
- Layout spacing
- Card appearance
- Hover effects

### Code Modifications
Main plugin file: `wp-github-koellner.php`
- Modify API parameters (line ~214)
- Change default cache time (line ~250)
- Customize shortcode output (line ~270+)

## Requirements

- WordPress 5.0 or higher
- PHP 7.0 or higher
- Active internet connection
- Public GitHub repositories

## Support

For issues or questions:
- GitHub Issues: https://github.com/hcscmedia/wp-github-koellner/issues
- WordPress Support: Check plugin documentation

## License

GPL-2.0+ - Free to use and modify
