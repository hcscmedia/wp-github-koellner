# Visual Demonstration

This document describes how the plugin looks and behaves when installed on a WordPress site.

## Admin Interface

### Settings Page (Einstellungen → GitHub Projekte)

```
┌─────────────────────────────────────────────────────────────┐
│ GitHub Projekte Einstellungen                                │
├─────────────────────────────────────────────────────────────┤
│                                                               │
│ GitHub API Einstellungen                                     │
│ Gib deinen GitHub-Benutzernamen ein, um deine Projekte      │
│ anzuzeigen. Ein Personal Access Token ist optional, aber     │
│ empfohlen für höhere API-Limits.                            │
│                                                               │
│ GitHub Benutzername                                          │
│ [________________________]                                    │
│ Dein GitHub-Benutzername (z.B. "hcscmedia")                 │
│                                                               │
│ GitHub Personal Access Token (optional)                      │
│ [••••••••••••••••]                                           │
│ Token ist gespeichert. Feld leer lassen, um es zu behalten  │
│                                                               │
│ Cache-Zeit (in Stunden)                                      │
│ [1  ]                                                         │
│ Wie lange sollen die GitHub-Daten zwischengespeichert       │
│ werden? (Standard: 1 Stunde)                                 │
│                                                               │
│ [Änderungen speichern]                                       │
│                                                               │
├─────────────────────────────────────────────────────────────┤
│ Verwendung                                                    │
│ Verwende den folgenden Shortcode, um deine GitHub-Projekte  │
│ anzuzeigen:                                                  │
│ [github_projects]                                            │
│                                                               │
│ Shortcode-Optionen:                                          │
│ • [github_projects limit="6"]                                │
│ • [github_projects sort="updated"]                           │
│ • [github_projects type="owner"]                             │
└─────────────────────────────────────────────────────────────┘
```

## Frontend Display

### Desktop View (3 Spalten)

```
┌──────────────────┐  ┌──────────────────┐  ┌──────────────────┐
│ my-awesome-repo  │  │ wordpress-theme  │  │ react-app        │
│ Öffentlich       │  │ Öffentlich       │  │ Privat           │
├──────────────────┤  ├──────────────────┤  ├──────────────────┤
│ A cool project   │  │ Custom WP theme  │  │ React dashboard  │
│ that does...     │  │ with modern...   │  │ application...   │
│                  │  │                  │  │                  │
│ ◉ JavaScript     │  │ ◉ PHP            │  │ ◉ TypeScript     │
│ ⭐ 42  🔀 12     │  │ ⭐ 15  🔀 3      │  │ ⭐ 8   🔀 2      │
│ 👁️ 38  🐛 5     │  │ 👁️ 12           │  │ 👁️ 6   🐛 1     │
│                  │  │                  │  │                  │
│ 📜 MIT License   │  │ 📜 GPL-2.0       │  │ 📜 Apache-2.0    │
│                  │  │                  │  │                  │
│ [react] [node]   │  │ [wordpress]      │  │ [react] [tsx]    │
│                  │  │ [theme] [css]    │  │ [dashboard]      │
├──────────────────┤  ├──────────────────┤  ├──────────────────┤
│ Aktualisiert     │  │ Aktualisiert     │  │ Aktualisiert     │
│ vor 2 Tagen      │  │ vor 1 Woche      │  │ vor 3 Stunden    │
└──────────────────┘  └──────────────────┘  └──────────────────┘
```

### Tablet View (2 Spalten)

```
┌────────────────────────────┐  ┌────────────────────────────┐
│ my-awesome-repo            │  │ wordpress-theme            │
│ Öffentlich                 │  │ Öffentlich                 │
├────────────────────────────┤  ├────────────────────────────┤
│ A cool project that does   │  │ Custom WordPress theme     │
│ amazing things...          │  │ with modern design...      │
│                            │  │                            │
│ ◉ JavaScript               │  │ ◉ PHP                      │
│ ⭐ 42  🔀 12               │  │ ⭐ 15  🔀 3                │
│                            │  │                            │
│ [react] [node] [api]       │  │ [wordpress] [theme]        │
├────────────────────────────┤  ├────────────────────────────┤
│ Aktualisiert vor 2 Tagen   │  │ Aktualisiert vor 1 Woche   │
└────────────────────────────┘  └────────────────────────────┘
```

### Mobile View (1 Spalte)

```
┌────────────────────────────────────┐
│ my-awesome-repo     [Öffentlich]   │
├────────────────────────────────────┤
│ A cool project that does amazing   │
│ things with JavaScript and Node    │
│                                    │
│ ◉ JavaScript  ⭐ 42  🔀 12         │
│                                    │
│ [react] [node] [api] [typescript]  │
├────────────────────────────────────┤
│ Aktualisiert vor 2 Tagen           │
└────────────────────────────────────┘

┌────────────────────────────────────┐
│ wordpress-theme     [Öffentlich]   │
├────────────────────────────────────┤
│ Custom WordPress theme with modern │
│ design and responsive layout       │
│                                    │
│ ◉ PHP  ⭐ 15  🔀 3                 │
│                                    │
│ [wordpress] [theme] [css]          │
├────────────────────────────────────┤
│ Aktualisiert vor 1 Woche           │
└────────────────────────────────────┘
```

## Color Scheme

### Light Mode
- **Background**: White (#ffffff)
- **Border**: Light gray (#e1e4e8)
- **Text**: Dark gray (#57606a)
- **Links**: Blue (#0969da)
- **Public Badge**: Light blue background (#ddf4ff)
- **Private Badge**: Light yellow background (#fff8c5)
- **Language Dots**: Colorful (depends on language)

### Dark Mode (automatically activated)
- **Background**: Dark gray (#161b22)
- **Border**: Medium gray (#30363d)
- **Text**: Light gray (#8b949e)
- **Links**: Light blue (#58a6ff)
- **Adjusted badge colors** for better dark mode contrast

## Interactive Elements

### Hover Effects
- Cards lift up slightly (translateY(-2px))
- Shadow increases for depth
- Links underline on hover

### Click Targets
- Project title links to GitHub repository
- All links open in new tab (target="_blank")
- Safe external links (rel="noopener noreferrer")

## Error States

### No Username Configured
```
┌─────────────────────────────────────────────────┐
│ ⚠ Bitte konfiguriere deinen GitHub-           │
│   Benutzernamen in den Einstellungen.         │
└─────────────────────────────────────────────────┘
```

### API Error
```
┌─────────────────────────────────────────────────┐
│ ⚠ GitHub API Fehler: HTTP 404                 │
└─────────────────────────────────────────────────┘
```

### No Repositories Found
```
┌─────────────────────────────────────────────────┐
│ ℹ Keine GitHub-Projekte gefunden.             │
└─────────────────────────────────────────────────┘
```

## Example Usage Scenarios

### Portfolio Homepage
```html
<h1>Welcome to my Portfolio</h1>
<p>Check out my latest projects:</p>

[github_projects limit="6" sort="updated" type="public"]
```

Result: Shows 6 most recently updated public repositories in a grid

### Developer Blog Sidebar
```html
<aside>
  <h3>My Projects</h3>
  [github_projects limit="3"]
</aside>
```

Result: Compact list of 3 projects in sidebar

### Full Projects Archive
```html
<h1>All My Projects</h1>
[github_projects limit="50" sort="full_name"]
```

Result: Large grid with up to 50 projects, alphabetically sorted

## Performance

### First Load (No Cache)
- API request to GitHub (~200-500ms)
- Parse and render (~50ms)
- Total: ~250-550ms

### Cached Load
- Retrieve from WordPress transients (~10ms)
- Parse and render (~50ms)
- Total: ~60ms

### CSS Loading
- Loaded only when shortcode is present
- Minified and optimized
- ~3KB gzipped

## Browser Compatibility

✅ Chrome 90+
✅ Firefox 88+
✅ Safari 14+
✅ Edge 90+
✅ Mobile Safari (iOS 13+)
✅ Chrome Mobile (Android 8+)

## Accessibility

- Semantic HTML structure
- Proper heading hierarchy
- Keyboard navigation support
- Screen reader friendly
- High contrast in dark mode
- Touch-friendly mobile design

## Summary

The plugin creates a beautiful, responsive display of GitHub repositories that:
- Looks professional and modern
- Works on all devices and screen sizes
- Provides relevant information at a glance
- Handles errors gracefully
- Performs efficiently with caching
- Matches WordPress design patterns
