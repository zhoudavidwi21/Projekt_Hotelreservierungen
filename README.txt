Dieses Projekt wurde in Zusammenarbeit von Martin Frischmann und David Zhou im Rahmen eines Webprojektes
aufgebaut.

Es wurde nur mittels HTML, CSS, und PHP aufgebaut.
In PHP wird GDImages als Extension zusätzlich noch benötigt zur Verarbeitung von hochgeladenen Bildern
in Thumbnails.

Sollte GDImages noch benötigt werden, dann bitte dem folgenden How-To Guide folgen:
https://www.geeksforgeeks.org/how-to-install-php-gd-in-windows/

Die Online-Website wurde mit MariaDB realisiert, da MySQL den Server-Zeichensatz: cp1252 West European (latin1) 
voreingestellt hat und vermutlich deshalb alle Sonderzeichen, die aus der DB kommen, nicht dargestellt werden
(nur mit schwarzer Raute und Fragezeichen). Die DB-Rechte und phpMyAdmin sind in der Domain-Verwaltung stark 
eingeschränkt - macht das ganze daher etwas kompliziert. Ist aber schon in Arbeit (nur zur Info).

