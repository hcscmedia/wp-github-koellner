# WP GitHub Köllner

Ein WordPress Plugin zum Anzeigen deiner GitHub-Projekte auf deiner WordPress-Website.

> 📖 **Für eine ausführliche Repository-Übersicht siehe [REPOSITORY-OVERVIEW.md](REPOSITORY-OVERVIEW.md)**

## Beschreibung

WP GitHub Köllner ist ein vollständiges, produktionsreifes WordPress Plugin, das deine GitHub-Repositories auf deiner WordPress-Website anzeigt. Es nutzt die GitHub API, um deine Projekte abzurufen und zeigt sie in einem ansprechenden Grid-Layout mit umfangreichen Informationen an.

## Features

- ✅ Anzeige von GitHub-Repositories über Shortcode
- ✅ Responsive Grid-Layout (1-3 Spalten)
- ✅ Caching-Mechanismus für optimale Performance
- ✅ Anpassbare Sortierung (nach Update, Erstellung, etc.)
- ✅ Unterstützung für GitHub Personal Access Token
- ✅ Umfangreiche Repository-Informationen:
  - Name und Beschreibung
  - Programmiersprache mit Farb-Indikator
  - Anzahl der Sterne, Forks und Watchers
  - Offene Issues
  - Repository-Lizenz
  - Topics/Tags
  - Letztes Update-Datum
  - Öffentlich/Privat Status
- ✅ Dark Mode Unterstützung
- ✅ Deutsche Benutzeroberfläche
- ✅ Sichere Token-Speicherung
- ✅ XSS-geschützte Ausgaben

## Installation

### Manuelle Installation

1. Lade den kompletten Ordner `wp-github-koellner` in das `/wp-content/plugins/` Verzeichnis deiner WordPress-Installation hoch
2. Aktiviere das Plugin über das 'Plugins' Menü in WordPress
3. Gehe zu Einstellungen → GitHub Projekte, um deine Einstellungen zu konfigurieren

### Installation über ZIP

1. Lade das Repository als ZIP-Datei herunter
2. Gehe zu Plugins → Installieren → Plugin hochladen
3. Wähle die ZIP-Datei aus und klicke auf "Jetzt installieren"
4. Aktiviere das Plugin nach der Installation

## Konfiguration

Nach der Aktivierung:

1. Gehe zu **Einstellungen → GitHub Projekte**
2. Gib deinen GitHub-Benutzernamen ein (z.B. "hcscmedia")
3. Optional: Füge einen GitHub Personal Access Token hinzu für höhere API-Limits
4. Stelle die Cache-Zeit ein (Standard: 1 Stunde)
5. Speichere die Einstellungen

### GitHub Personal Access Token (Optional)

Ein Personal Access Token ist optional, aber empfohlen, um höhere API-Limits zu erhalten:

1. Gehe zu GitHub → Settings → Developer settings → Personal access tokens → Tokens (classic)
2. Klicke auf "Generate new token (classic)"
3. Wähle den Scope `public_repo` (für öffentliche Repositories) oder `repo` (für alle Repositories)
4. Kopiere den generierten Token
5. Füge ihn in den Plugin-Einstellungen ein

## Verwendung

### Basis-Shortcode

```
[github_projects]
```

Dieser Shortcode zeigt deine GitHub-Projekte mit den Standard-Einstellungen an (10 Projekte, sortiert nach letztem Update).

### Shortcode-Optionen

#### Anzahl der Projekte begrenzen

```
[github_projects limit="6"]
```

Zeigt nur die ersten 6 Projekte an.

#### Sortierung ändern

```
[github_projects sort="created"]
```

Verfügbare Sortierungen:
- `updated` - Nach letztem Update (Standard)
- `created` - Nach Erstellungsdatum
- `pushed` - Nach letztem Push
- `full_name` - Alphabetisch nach Name

#### Repository-Typ festlegen

```
[github_projects type="public"]
```

Verfügbare Typen:
- `owner` - Alle eigenen Repositories (Standard)
- `public` - Nur öffentliche Repositories
- `private` - Nur private Repositories
- `member` - Repositories, bei denen du Mitglied bist

#### Kombinierte Optionen

```
[github_projects limit="8" sort="created" type="public"]
```

## Beispiele

### Beispiel 1: Die 3 neuesten öffentlichen Projekte

```
[github_projects limit="3" sort="created" type="public"]
```

### Beispiel 2: Top 5 nach Sterne (sortiert nach letztem Update)

```
[github_projects limit="5" sort="updated"]
```

### Beispiel 3: In eine WordPress-Seite einfügen

1. Erstelle eine neue Seite oder bearbeite eine bestehende
2. Füge den Shortcode im Content-Editor ein:
```
<h2>Meine GitHub-Projekte</h2>
[github_projects limit="9"]
```
3. Veröffentliche die Seite

## Styling

Das Plugin beinhaltet ein vorgefertigtes, modernes Design. Die Projekte werden in einem responsiven Grid angezeigt:

- **Desktop (>1024px)**: 3 Spalten
- **Tablet (769-1024px)**: 2 Spalten
- **Mobile (<769px)**: 1 Spalte

Das Design unterstützt automatisch Dark Mode basierend auf den Systemeinstellungen des Besuchers.

### Eigenes CSS

Du kannst das Styling über eigene CSS-Regeln anpassen. Hauptklassen:

- `.wp-github-koellner-container` - Haupt-Container
- `.github-projects-grid` - Grid-Container
- `.github-project-card` - Einzelne Projekt-Karte
- `.project-title` - Projekt-Titel
- `.project-description` - Projekt-Beschreibung
- `.project-meta` - Meta-Informationen (Sterne, Forks, Sprache)
- `.project-topics` - Topics/Tags
- `.project-footer` - Footer mit Update-Datum

## Caching

Das Plugin cached die GitHub API-Anfragen für die konfigurierte Zeit (Standard: 1 Stunde). Dies:

- Reduziert die Last auf die GitHub API
- Verbessert die Performance deiner Website
- Verhindert API-Rate-Limiting

Du kannst die Cache-Zeit in den Einstellungen anpassen (1-24 Stunden).

## Fehlerbehebung

### "Bitte konfiguriere deinen GitHub-Benutzernamen"

- Gehe zu Einstellungen → GitHub Projekte und gib deinen GitHub-Benutzernamen ein

### "GitHub API Fehler: HTTP 404"

- Überprüfe, ob dein GitHub-Benutzername korrekt geschrieben ist
- Stelle sicher, dass dein GitHub-Account öffentlich sichtbar ist

### "GitHub API Fehler: HTTP 403"

- Du hast das API-Rate-Limit erreicht
- Füge einen Personal Access Token in den Einstellungen hinzu

### Keine Projekte werden angezeigt

- Stelle sicher, dass du mindestens ein Repository auf GitHub hast
- Überprüfe den Repository-Typ (öffentlich/privat) in den Shortcode-Optionen

## Systemanforderungen

- WordPress 5.0 oder höher
- PHP 7.0 oder höher
- Aktive Internetverbindung für GitHub API-Zugriff

## Changelog

### Version 1.0.0
- Erste Version
- GitHub API Integration
- Shortcode-Unterstützung
- Responsive Design
- Caching-Mechanismus
- Admin-Einstellungen
- Dark Mode Unterstützung

## Support

Bei Fragen oder Problemen erstelle bitte ein Issue auf GitHub:
https://github.com/hcscmedia/wp-github-koellner/issues

## Lizenz

GPL-2.0+

## Credits

Entwickelt von HCSC Media