# Plugin-Struktur

Diese Datei beschreibt die Struktur und Organisation des WP GitHub Köllner Plugins.

## Datei-Übersicht

```
wp-github-koellner/
├── wp-github-koellner.php      # Haupt-Plugin-Datei
├── assets/
│   └── css/
│       └── style.css           # Frontend-Styling
├── examples/
│   └── SHORTCODE-EXAMPLES.md   # Beispiele für Shortcode-Verwendung
├── README.md                   # Hauptdokumentation
├── QUICKSTART.md              # Schnellstart-Anleitung
├── CHANGELOG.md               # Versionshistorie
├── CONTRIBUTING.md            # Beitragsrichtlinien
├── LICENSE                    # GPL-2.0+ Lizenz
└── .gitignore                # Git-Ausschlüsse
```

## Datei-Beschreibungen

### wp-github-koellner.php
Die Hauptdatei des Plugins, die folgende Komponenten enthält:

- **Plugin Headers**: WordPress-Plugin-Metadaten
- **WP_GitHub_Koellner Class**: Hauptklasse mit Singleton-Pattern
  - `add_admin_menu()`: Registriert Admin-Menü
  - `register_settings()`: Registriert Plugin-Einstellungen
  - `sanitize_token()`: Validiert und bereinigt GitHub-Token
  - `settings_page()`: Rendert Einstellungsseite
  - `fetch_github_repos()`: Ruft Repositories von GitHub API ab
  - `github_projects_shortcode()`: Verarbeitet Shortcode
  - `get_language_color()`: Liefert Farben für Programmiersprachen
  - `enqueue_styles()`: Lädt CSS-Dateien

### assets/css/style.css
Frontend-Stylesheet mit:

- Grid-Layout für Projekt-Karten
- Responsive Design (Mobile, Tablet, Desktop)
- Dark Mode Unterstützung
- Hover-Effekte und Animationen
- Styling für Badges, Meta-Informationen und Topics

### Dokumentation

- **README.md**: Vollständige Dokumentation mit Installation, Konfiguration und Verwendung
- **QUICKSTART.md**: 5-Minuten Schnellstart-Anleitung
- **CHANGELOG.md**: Versionshistorie und Änderungen
- **CONTRIBUTING.md**: Richtlinien für Beitragende
- **STRUCTURE.md**: Diese Datei - Übersicht der Plugin-Struktur

### Beispiele

- **examples/SHORTCODE-EXAMPLES.md**: Praktische Beispiele für verschiedene Shortcode-Konfigurationen

## WordPress-Integration

### Hooks & Actions

| Hook | Funktion | Beschreibung |
|------|----------|--------------|
| `admin_menu` | `add_admin_menu()` | Fügt Einstellungsseite hinzu |
| `admin_init` | `register_settings()` | Registriert Plugin-Einstellungen |
| `wp_enqueue_scripts` | `enqueue_styles()` | Lädt Frontend-Styles |

### Shortcode

| Shortcode | Attribute | Standardwert |
|-----------|-----------|--------------|
| `[github_projects]` | `limit` | 10 |
| | `sort` | updated |
| | `type` | owner |

### Optionen in der Datenbank

| Option | Beschreibung | Typ |
|--------|--------------|-----|
| `wp_github_koellner_username` | GitHub-Benutzername | string |
| `wp_github_koellner_token` | Personal Access Token | string (verschlüsselt) |
| `wp_github_koellner_cache_time` | Cache-Zeit in Stunden | integer (1-24) |

### Transients (Cache)

| Transient | Beschreibung | Gültigkeit |
|-----------|--------------|------------|
| `wp_github_koellner_repos_{hash}` | Gecachte Repository-Daten | Konfigurierbar (Standard: 1h) |

## API-Integration

### GitHub API Endpunkt
```
GET https://api.github.com/users/{username}/repos
```

### Parameter
- `sort`: updated, created, pushed, full_name
- `type`: owner, public, private, member
- `per_page`: 100 (maximal)

### Authentication
- Methode: Bearer Token
- Header: `Authorization: Bearer {token}`
- Ohne Token: 60 Requests/Stunde
- Mit Token: 5000 Requests/Stunde

## CSS-Klassen

### Container
- `.wp-github-koellner-container` - Haupt-Container
- `.github-projects-grid` - Grid-Layout

### Projekt-Karte
- `.github-project-card` - Einzelne Karte
- `.project-header` - Kopfzeile mit Titel
- `.project-title` - Projekt-Titel
- `.project-badge` - Status-Badge (public/private)
- `.project-description` - Beschreibung
- `.project-meta` - Meta-Informationen
- `.project-topics` - Topic-Tags
- `.project-footer` - Footer mit Datum

### Zustände
- `.wp-github-koellner-error` - Fehlermeldungen
- `.wp-github-koellner-empty` - Leere Ansicht

## Sicherheitsmaßnahmen

1. **Input Validation**: Alle Benutzereingaben werden validiert
2. **Output Escaping**: Alle Ausgaben werden escaped (`esc_html`, `esc_url`, `esc_attr`)
3. **Token Security**: Token werden maskiert gespeichert und nicht im HTML angezeigt
4. **Nonce Protection**: WordPress-Nonces für Formular-Übermittlung
5. **Direct Access Prevention**: `if (!defined('ABSPATH')) exit;`
6. **Sanitization**: Verwendung von WordPress-Sanitization-Funktionen

## Performance-Optimierungen

1. **Caching**: API-Antworten werden in WordPress-Transients gecacht
2. **Lazy Loading**: CSS wird nur geladen, wenn Shortcode verwendet wird
3. **Limit Parameter**: Begrenzung auf maximal 100 Projekte pro Anfrage
4. **Single Instance**: Singleton-Pattern verhindert mehrfache Initialisierung

## Browser-Kompatibilität

- Chrome (letzte 2 Versionen)
- Firefox (letzte 2 Versionen)
- Safari (letzte 2 Versionen)
- Edge (letzte 2 Versionen)
- Mobile Browser (iOS Safari, Chrome Android)

## Mindestanforderungen

- **WordPress**: 5.0+
- **PHP**: 7.0+
- **Extensions**: curl, json
- **Internetverbindung**: Erforderlich für GitHub API

## Entwicklung

### Testing
```bash
php -l wp-github-koellner.php  # Syntax-Check
php test-plugin.php            # Struktur-Tests
```

### Debugging
WordPress Debug-Mode aktivieren in `wp-config.php`:
```php
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
```

## Support

Bei Fragen oder Problemen:
- [GitHub Issues](https://github.com/hcscmedia/wp-github-koellner/issues)
- [Dokumentation](README.md)
- [Quickstart Guide](QUICKSTART.md)
