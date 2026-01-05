# Shortcode-Beispiele für WP GitHub Köllner

Dieses Dokument enthält verschiedene Beispiele zur Verwendung des `[github_projects]` Shortcodes.

## Grundlegende Verwendung

### Beispiel 1: Standardanzeige
```
[github_projects]
```
Zeigt die letzten 10 aktualisierten Repositories an.

### Beispiel 2: Begrenzte Anzahl
```
[github_projects limit="6"]
```
Zeigt nur 6 Repositories an - perfekt für eine Startseite oder Sidebar.

### Beispiel 3: Viele Projekte
```
[github_projects limit="20"]
```
Zeigt 20 Repositories an - gut für eine dedizierte Projekte-Seite.

## Sortierung

### Beispiel 4: Nach Erstellungsdatum
```
[github_projects sort="created"]
```
Zeigt die neuesten Repositories zuerst.

### Beispiel 5: Nach letztem Push
```
[github_projects sort="pushed"]
```
Zeigt Repositories sortiert nach dem letzten Push-Datum.

### Beispiel 6: Alphabetisch
```
[github_projects sort="full_name"]
```
Zeigt Repositories alphabetisch sortiert nach Name.

## Repository-Typen

### Beispiel 7: Nur öffentliche Repositories
```
[github_projects type="public"]
```
Zeigt nur öffentliche Repositories an.

### Beispiel 8: Nur private Repositories
```
[github_projects type="private"]
```
Zeigt nur private Repositories an (erfordert Personal Access Token mit entsprechenden Berechtigungen).

### Beispiel 9: Mitglieds-Repositories
```
[github_projects type="member"]
```
Zeigt Repositories an, bei denen du Mitglied bist (aber nicht Besitzer).

## Kombinierte Beispiele

### Beispiel 10: Top 5 neueste öffentliche Projekte
```
[github_projects limit="5" sort="created" type="public"]
```
Perfekt für eine "Meine neuesten Projekte" Sektion.

### Beispiel 11: Kürzlich aktualisierte Projekte
```
[github_projects limit="8" sort="updated" type="owner"]
```
Zeigt die 8 zuletzt aktualisierten eigenen Repositories.

### Beispiel 12: Archiv-Ansicht
```
[github_projects limit="30" sort="created"]
```
Zeigt eine umfangreiche Liste aller Projekte, sortiert nach Erstellungsdatum.

## Praktische Anwendungsfälle

### Portfolio-Seite
```html
<h2>Meine Open-Source Projekte</h2>
<p>Hier findest du eine Auswahl meiner öffentlichen GitHub-Projekte:</p>
[github_projects limit="9" type="public" sort="updated"]
```

### Entwickler-Blog Sidebar
```html
<h3>Aktuelle Projekte</h3>
[github_projects limit="3" sort="updated"]
```

### Projekt-Archiv Seite
```html
<h1>Alle meine Projekte</h1>
<p>Eine vollständige Liste meiner GitHub-Repositories:</p>
[github_projects limit="50" sort="full_name"]
```

### Startseite Highlight
```html
<section class="featured-projects">
  <h2>Featured Projects</h2>
  [github_projects limit="6" sort="updated" type="public"]
</section>
```

## Tipps

1. **Performance**: Verwende `limit`, um die Anzahl der angezeigten Projekte zu begrenzen. Dies verbessert die Ladezeit der Seite.

2. **Caching**: Das Plugin cached die GitHub API-Anfragen. Bei Änderungen an deinen Repositories kann es bis zu einer Stunde (oder der eingestellten Cache-Zeit) dauern, bis diese sichtbar sind.

3. **API-Limits**: Ohne Personal Access Token bist du auf 60 Anfragen pro Stunde limitiert. Mit Token erhöht sich das Limit auf 5000 Anfragen pro Stunde.

4. **Private Repositories**: Um private Repositories anzuzeigen, benötigst du einen Personal Access Token mit dem `repo` Scope.

5. **Responsive Design**: Das Plugin ist vollständig responsive. Auf mobilen Geräten werden die Projekte in einer Spalte angezeigt, auf Tablets in zwei und auf Desktop in drei Spalten.

## Fehlerbehandlung

Falls keine Projekte angezeigt werden:

1. Überprüfe, ob dein GitHub-Benutzername in den Einstellungen korrekt ist
2. Stelle sicher, dass du mindestens ein Repository des gewählten Typs hast
3. Überprüfe die Browser-Konsole auf JavaScript-Fehler
4. Aktiviere das WordPress-Debug-Log, um PHP-Fehler zu sehen
