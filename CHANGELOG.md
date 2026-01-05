# Changelog

All notable changes to the WP GitHub Koellner plugin will be documented in this file.

## [1.0.0] - 2026-01-05

### Added
- Initial release of WP GitHub Koellner plugin
- Core plugin functionality to display GitHub repositories
- Shortcode `[github_projects]` with parameters:
  - `username` - Display repos from specific GitHub user
  - `limit` - Limit number of repositories displayed
- Admin settings page (Settings → GitHub Projects)
  - GitHub username configuration
  - Cache time configuration (1-24 hours)
- Responsive grid layout for repository cards
- Repository information display:
  - Name with link to GitHub
  - Description
  - Programming language
  - Star count
  - Fork count
  - Last update date
- Styling features:
  - Modern card-based design
  - Hover effects
  - Dark mode support
  - Mobile-responsive layout

### Security
- Input validation for GitHub usernames
- Server-side sanitization callbacks
- XSS prevention with proper escaping
- DateTime exception handling
- API error message sanitization
- Secure external links (rel="noopener noreferrer")
- Cache time validation (1-24 hours range)

### Performance
- WordPress transient-based caching system
- Configurable cache duration
- Default 6-hour cache to reduce API calls
- Efficient API usage (up to 100 repos per request)

### Documentation
- Comprehensive README with features and usage
- INSTALLATION.md with step-by-step guide
- Inline code documentation
- Demo HTML file for preview
- Screenshots directory with examples

### Technical Details
- WordPress 5.0+ compatible
- PHP 7.0+ compatible
- GitHub API v3 integration
- Singleton pattern implementation
- WordPress coding standards compliant
- GPL-2.0+ licensed

---

## Future Enhancements (Planned)

Potential features for future versions:
- [ ] GitHub API token support for higher rate limits
- [ ] Additional sorting options (stars, forks, name)
- [ ] Filter by repository topics/tags
- [ ] Customizable card templates
- [ ] Widget support
- [ ] Multi-language support (i18n)
- [ ] Repository search functionality
- [ ] Display private repos (with authentication)
