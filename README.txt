Dieses Projekt wurde in Zusammenarbeit von Martin Frischmann und David Zhou im Rahmen eines Webprojektes
aufgebaut.

Es wurde nur mittels HTML, CSS, und PHP aufgebaut.
In PHP wird GDImages als Extension zusätzlich noch benötigt zur Verarbeitung von hochgeladenen Bildern
in Thumbnails.

Sollte GDImages noch benötigt werden, dann bitte dem folgenden How-To Guide folgen:
https://www.geeksforgeeks.org/how-to-install-php-gd-in-windows/

Datenbank Zugangsdaten (übermittelte DB mittels Dump):
------------------------------------------------------
Inhalt db/dbaccess.php:
<?php
$host = 'localhost';
$dbUser = 'hkadmin';
$dbPassword = '2GrhVIjMGsPlSuRv';
$database = 'hotel_kastanie_db';
?>

phpMyAdmin-Zugangsdaten (reale Website):
----------------------------------------
Website: http://projekt-hotel.frischmann.or.at/index.php
http://frischmann.or.at.cloud9-vm133.server-routing.com/phpMyAdmin-frieywux1/

Inhalt db/dbaccess.php:
<?php
$host = '127.0.0.1:3306';
$dbUser = 'frieywux1';
$dbPassword = 'FE&Ux20wzXTL';
$database = 'usrdb_frieywux1';
?>

Die Online-Website wurde mit MariaDB realisiert, da MySQL den Server-Zeichensatz: cp1252 West European (latin1) 
voreingestellt hat und vermutlich deshalb alle Sonderzeichen, die aus der DB kommen, nicht dargestellt werden
(nur mit schwarzer Raute und Fragezeichen). Die DB-Rechte und phpMyAdmin sind in der Domain-Verwaltung stark 
eingeschränkt - macht das ganze daher etwas kompliziert. Ist aber schon in Arbeit (nur zur Info).

