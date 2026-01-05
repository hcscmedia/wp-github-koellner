# Schnellstart-Anleitung für WP GitHub Köllner

Diese Anleitung hilft dir, das Plugin in weniger als 5 Minuten zu installieren und einzurichten.

## Schritt 1: Installation

### Methode A: Manuelle Installation (empfohlen)

1. Lade den kompletten `wp-github-koellner` Ordner herunter
2. Verschiebe ihn nach `/wp-content/plugins/` auf deinem WordPress-Server
3. Der Pfad sollte sein: `/wp-content/plugins/wp-github-koellner/wp-github-koellner.php`

### Methode B: ZIP-Upload

1. Erstelle eine ZIP-Datei vom `wp-github-koellner` Ordner
2. Gehe zu WordPress Admin → Plugins → Installieren
3. Klicke auf "Plugin hochladen"
4. Wähle die ZIP-Datei und klicke "Jetzt installieren"

## Schritt 2: Plugin aktivieren

1. Gehe zu WordPress Admin → Plugins
2. Finde "WP GitHub Köllner" in der Liste
3. Klicke auf "Aktivieren"

## Schritt 3: Einstellungen konfigurieren

1. Gehe zu **Einstellungen → GitHub Projekte**
2. Trage deinen GitHub-Benutzernamen ein (z.B. "hcscmedia")
3. *Optional:* Füge einen Personal Access Token hinzu
4. Wähle die Cache-Zeit (Standard: 1 Stunde ist gut)
5. Klicke "Änderungen speichern"

## Schritt 4: Shortcode einfügen

### Auf einer Seite oder Beitrag:

1. Erstelle eine neue Seite oder bearbeite eine bestehende
2. Füge diesen Shortcode ein:

```
[github_projects]
```

3. Veröffentliche die Seite
4. Fertig! Deine GitHub-Projekte werden jetzt angezeigt

### In einem Widget:

1. Gehe zu Design → Widgets
2. Füge ein "Text" oder "HTML" Widget hinzu
3. Füge den Shortcode ein:

```
[github_projects limit="3"]
```

4. Speichern

## Bonus: Erweiterte Optionen

### Zeige nur 6 Projekte:
```
[github_projects limit="6"]
```

### Zeige die neuesten Projekte zuerst:
```
[github_projects sort="created"]
```

### Zeige nur öffentliche Projekte:
```
[github_projects type="public"]
```

### Kombiniert:
```
[github_projects limit="9" sort="updated" type="public"]
```

## Häufige Fragen

**Q: Wo bekomme ich einen GitHub Personal Access Token?**  
A: Gehe zu GitHub → Settings → Developer settings → Personal access tokens → Generate new token (classic) → Wähle `public_repo` Scope

**Q: Warum sehe ich keine Projekte?**  
A: 
- Überprüfe den GitHub-Benutzernamen in den Einstellungen
- Stelle sicher, dass du mindestens ein öffentliches Repository hast
- Warte bis zu einer Stunde (Cache-Zeit) nach dem Erstellen neuer Repositories

**Q: Kann ich das Design anpassen?**  
A: Ja! Du kannst eigenes CSS hinzufügen. Die Hauptklasse ist `.wp-github-koellner-container`

**Q: Funktioniert es mit Page Buildern wie Elementor?**  
A: Ja! Die meisten Page Builder unterstützen Shortcodes. Füge einfach ein Shortcode-Element hinzu und trage `[github_projects]` ein.

## Hilfe benötigt?

Schau in die [vollständige Dokumentation](README.md) oder erstelle ein [Issue auf GitHub](https://github.com/hcscmedia/wp-github-koellner/issues).

## Das war's! 🎉

Deine GitHub-Projekte sollten jetzt auf deiner WordPress-Seite zu sehen sein. Viel Erfolg!
