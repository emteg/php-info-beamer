php-info-beamer ist eine Applikation, mit der eine Slide Show mit aktuellen Informationen angezeigt werden kann. php-info-beamer basiert auf PHP und SQL im Backend und HTML5 mit JavaScript im Frontend. php-info-beamer besteht aus 2 zusemmengehörenden Komponenten: dem Frontend im Projekt beamer zur Anzeige und dem Backend im Projekt beamercontrol.

Jede Folie ist Teil eines Moduls, das unterschiedliche Daten laden und anzeigen kann. Wie der Name schon sagt, kann man diese Module beliebig im Backend ein- und ausschalten. Mit relativ geringem Aufwand kann man neue Module programmieren.

Zur Verwendung auf einem Webserver checkt man am besten beide Projekte getrennt in den htdocs-Ordner aus:
https://github.com/emteg/beamercontrol.git
https://github.com/emteg/beamer.git

Wenn man trotzdem dieses Sammelprojekt auschecken möchte, muss man nach dem Auschecken diese beiden Commands ausführen, um die Unterprojekte von git zu holen:
git submodule init
git submodule update
Mehr Infos gibt es hier:
https://git-scm.com/book/de/v1/Git-Tools-Submodule

Dieses Github-Projekt dient vor allem zum Sammeln beider Unterprojekte. Für das Setup und die Konfiguration bitte die Readme-Dateien beider Projekte beachten. Beim ersten Setup ist es empfehlenswert, zuerst beamercontrol auszuchecken und zum laufen zu brigen, weil das Frontend in beamer wesentlich weniger Einstellungen verlangt.

Slide Show erstellen

Im Browser /beamercontrol öffen, anmelden und im Menüpunkt Playlist Module hinzufügen. Diese werden nacheinander angezeigt. Bestimmte Module wie Textseite oder Bildseite zeigen jedes mal eine andere Unterseite an, die im entsprechenden Menüpunkt angelegt werden können.

Slide Show anzeigen

Im Browser /beamer öffnen, slide show wird sofort abgespielt. Fullscreen-Modus aktivieren und eventuell mit CTRL+MOUSEWHEEL Schriftgröße anpassen.
Manche Module haben in der linken oberen Ecke +/- Buttons. Damit kann man die Anzahl der anzuzeigenden Elemente in diesem Modul für diesen Client einstellen. Erzeugt ein cookie.

Einzelne Folie anzeigen

Man kann auch genau ein Modul anzeigen lassen. Dazu im Browser /beamer/view.php aufrufen und die gewünschte Folie aus dem Menü wählen. Die Folie aktualisiert sich so oft, wie im Backend eingestellt (bei Textseiten u.ä. wird auch durch die Textseiten durchgewechselt), allerdings wir nie das Modul gewechselt.
