# Changelog

Alle bedeutenden Änderungen an diesem Projekt werden in dieser Datei dokumentiert.

Das Format basiert auf [Keep a Changelog](https://keepachangelog.com/de/1.0.0/),
und dieses Projekt folgt [Semantic Versioning](https://semver.org/lang/de/).

## [1.0.0] - 2025-01-05

### Hinzugefügt
- Erste Version des Plugins
- GitHub API Integration zum Abrufen von Repositories
- `[github_projects]` Shortcode mit anpassbaren Optionen:
  - `limit` - Anzahl der anzuzeigenden Projekte (1-100)
  - `sort` - Sortierung nach updated, created, pushed, oder full_name
  - `type` - Repository-Typ (owner, public, private, member)
- Admin-Einstellungsseite für:
  - GitHub-Benutzername
  - Personal Access Token (optional)
  - Cache-Zeit (1-24 Stunden)
- Responsive Grid-Layout mit 1-3 Spalten je nach Bildschirmgröße
- Anzeige von Repository-Informationen:
  - Name und direkter Link zum Repository
  - Beschreibung
  - Programmiersprache mit Farb-Indikator
  - Anzahl der Sterne und Forks
  - Topics/Tags
  - Letztes Update-Datum
  - Status (öffentlich/privat)
- Caching-Mechanismus zur Performance-Optimierung
- Dark Mode Unterstützung
- Bearer Authentication für GitHub API (empfohlene Methode)
- Eingabe-Validierung für Token und Limit-Parameter
- Sichere Token-Speicherung mit maskierter Anzeige
- Fehlerbehandlung für API-Anfragen
- Deutsche Benutzeroberfläche
- Umfangreiche Dokumentation:
  - README mit Installation und Verwendung
  - QUICKSTART Guide für schnellen Einstieg
  - SHORTCODE-EXAMPLES mit vielen Beispielen
  - CONTRIBUTING Guidelines
  - GPL-2.0+ Lizenz

### Sicherheit
- Eingabe-Sanitisierung für alle Benutzereingaben
- Ausgabe-Escaping für sichere HTML-Ausgabe
- Token-Validierung mit Format-Prüfung
- Sichere Token-Speicherung ohne Anzeige des tatsächlichen Werts
- Bounds-Checking für numerische Parameter

[1.0.0]: https://github.com/hcscmedia/wp-github-koellner/releases/tag/v1.0.0
