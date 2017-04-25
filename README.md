# PHP-Praktikum

PHP-Praktikum ist ein Client, in dem Mitteilungen mit Hashtags eingegeben werden können. Diese sollen auf einer Timeline übersichtlich dargestellt und bewertet werden können. Falls sich der Nutzer näher über ein bestimmtes "Thema" informieren möchte, kann er auf den entsprechenden Hashtag klicken und bekommt eine Übersicht aller Mitteilungen, die mit diesem Hashtag versehen sind. 
Es können sich auf der Plattform mehrere Nutzer anmelden und ihre Daten über eine Profilseite aktualisieren.

## Installation

1. Dateien des Ordners "php-praktikum" in Webserver-Verzeichnis entpacken
2. Datenbankverbindung durch Angabe von Datenbankhost, Datenbank-Nutzername und Datenbank-Passwort in der "includes/config.php" aufbauen
3. SQL-Skript in die angegebene Datenbank importieren
4. Registrieren oder mit den bereits registrierten Nutzern ... einloggen. Für diese Nutzer ist das Passwort ...

## Login-Modul
Das Login-Modul beinhaltet Funktionen zum Registrieren, Einloggen sowie eine Passwort-vergessen-Funktion, die das Passwort zurücksetzt. 

### Besonderheiten
Das Login-Modul hat einige Besonderheiten integriert:
- Anzeige für die Passwort-Sicherheit
- sichtbare Anzeige des Passwortes
- Uhr-Anzeige
- tageszeitbasierte Begrüßung
- zufällig ausgewählte Motivationssprüche inklusive passender Hintergrundbilder
- LocalStorage-Funktionalitäten

#### Anzeige für die Passwort-Sicherheit
Im Login-Modul ist eine Anzeige in Form einer Skala enthalten, die die Passwortsicherheit mittels einer Farbskala (rot und grün) sowie eines Textes anzeigt. Dieses ist bei der Registrierung und der Erneuerung des Passworts integriert. 

#### Anzeige des Passworts
Um die User Experience zu verbessern, wird auf eine doppelte Eingabe des Passwortes verzichtet. Stattdessen wird eine Möglichkeit integriert, das eingegebene Passwort als sichtbaren Text anzeigen zu lassen.

#### Uhr-Anzeige
Mittels JavaScript wird auf der Startseite die Uhrzeit sowie das Datum angezeigt.

#### Tageszeitbasierte Begrüßung
Auf Basis der Tageszeit wird der Nutzer mit 
`"Guten Morgen!"`,
`"Guten Tag!"`,
`"Guten Abend!"` und
`"Gute Nacht!`
begrüßt.

#### Motivationssprüche
Beim Aufrufen der Startseite werden aus sechs Motivationssprüchen ein Motivationsspruch sowie das passende Hintergrundbild ausgewählt und angezeigt.

#### LocalStorage-Funktionalitäten
Die JavaScript-Funktionen `saveLocalStorage()` und `loadLocalStorage()` beherbergen die Logik, um den Usernamen sowie das Profilbild im LocalStorage des Nutzers nach erfolgreichem Login zu speichern und beim nächstem Aufruf der Startseite nach erfolgter Eingabe der E-Mail-Adresse einen personalisierten Begrüßungstext sowie das entsprechende Profilbild anzuzeigen.

## Fehler Sammlung
### Email Aktivierung
Fehler bei der E-Mail Aktivierung. Die Flaschenpost ist wohl untergegangen…
Bei der Aktivierung der E-Mail ist ein Fehler aufgetreten.

### Login Fehler
Login fehlgeschlagen. Heute scheint es stürmisch zu sein. Versuche es später noch einmal.
Beim Login ist leider ein Fehler aufgetreten.

### Registrierung Fehler
Fehler bei Registrierung. Sie wurde von einem Wal verschluckt.
Bei der Registrierung ist ein Fehler aufgetreten.

### PW Reset Fehler
Fehler beim Passwortreset. Das neue Passwort hat sich leider in den Wellen aufgelöst.
Passwort konnte nicht zurückgesetzt werden.

### Weder Login noch Registrierung gedrückt
Login fehlgeschlagen. Es scheint ein Problem mit der Strömung zu geben.
Beim Login ist leider ein Fehler aufgetreten.

### Keine POST-Variablen
Login fehlgeschlagen. Nimm dich vor Strudeln in Acht und versuche es später noch einmal.
Beim Login ist leider ein Fehler aufgetreten.

### Konto blockiert
Konto blockiert. Wir räumen das Treibgut zur Seite so schnell wir können.
Es ist ein Fehler beim Login aufgetreten. Konto blockiert.

### Passwort Änderung
Fehler bei Passwortänderung. Dein neues Passwort hängt leider in einem Fischernetz fest.
Das Passwort konnte nicht geändert werden.

### 404
Seite konnte nicht gefunden werden. Anscheinend ist sie in Untiefen verloren gegangen.
Seite wurde nicht gefunden.
