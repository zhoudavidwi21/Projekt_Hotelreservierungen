<?php
#########################################
#Belegungsplan  			#
#©2017 Daniel ProBer alias HackMeck	#
#https://www.hackmeck.de		#
#GERMANY				#
#					#
#Mail: daproc@gmx.net			#
#Paypal: daproc@gmx.net			#
#					#
#Zeigt einen Kalender mit 		#
#Belegung für ein Objekt an.		#
#z.B. Ferienwohnung 			#
#########################################

/* 	Belegungsplan ist Freie Software: Sie können ihn unter den Bedingungen
  der GNU General Public License, wie von der Free Software Foundation,
  Version 2 der Lizenz weiterverbreiten und/oder modifizieren.

  Belegungsplan wird in der Hoffnung, dass er nützlich sein wird, aber
  OHNE JEDE GEWÄHRLEISTUNG, bereitgestellt; sogar ohne die implizite
  Gewährleistung der MARKTFÄHIGKEIT oder EIGNUNG FÜR EINEN BESTIMMTEN ZWECK.
  Siehe die GNU General Public License für weitere Details.

  Sie sollten eine Kopie der GNU General Public License zusammen mit diesem
  Programm erhalten haben. Wenn nicht, siehe <http://www.gnu.org/licenses/>
 */

$controll = $remote;
if ($controll != 24519) {
    echo 'Kein Zugriff!';
    exit();
}
$obj = $_GET['objekt'];
?>
<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="UTF-8">
        <title>Export</title>
    </head>
    <body>
        <?php
        $sql = "SELECT name, export_uri FROM objekt WHERE id = '" . $obj . "'";
        $db_erg = mysqli_query($db_link, $sql);
        while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {
            $obj_name = $zeile['name'];
            $exp_uri = $zeile['export_uri'];
        }
        if (file_exists("ical/" . $exp_uri)) {
            unlink("ical/" . $exp_uri);
        }
        $kb_ical = fopen('ical/' . $exp_uri, 'a') or die('Datei kann nicht gespeichert werden!');
        echo '<a href="ical/' . $exp_uri . '">Download</a><br><br>';
        $path = $_SERVER['REQUEST_URI'];
        $path = explode('/', $path);
        $a = count($path);
        $ordner = $path[$a - 2];
        $link = $_SERVER['REQUEST_URI'];
        $teile = explode('/', $link);
        $key = array_search($ordner, $teile);
        echo '<p>';
        echo 'Folgende Zeile können sie bei anderen Programmen als Import-Pfad angeben:<br>';
        echo '<textarea class="pfad" rows="1" cols="100">';
        echo 'http://';
        echo $_SERVER['SERVER_NAME'] . '/';
        for ($i = 1; $i <= $key; $i++) {
            echo $teile[$i] . '/';
        }
        echo 'ical/' . $exp_uri;
        echo '</textarea></p>';
        fwrite($kb_ical, "BEGIN:VCALENDAR");
        echo "BEGIN:VCALENDAR<br>";
        fwrite($kb_ical, "\r\nVERSION:2.0");
        echo "VERSION:2.0<br>";
        fwrite($kb_ical, "\r\nPRODID:-//Belegungsplan//hackmeck.bplaced.de//DE");
        echo "PRODID:-//Belegungsplan//hackmeck.bplaced.de//DE<br>";
        fwrite($kb_ical, "\r\nCALSCALE:GREGORIAN");
        echo "CALSCALE:GREGORIAN<br>";
        mysqli_set_charset($db_link, 'utf8');
        $sql = "SELECT 
			times.datean, 
			times.dateab,
			times.user,
			times.objekt_id,
			objekt.name,
			booking.id,
			booking.times_id,
                        guests.nname,
                        guests.email
		FROM 
			times 
		LEFT JOIN 
			objekt ON times.objekt_id = objekt.id 
		LEFT JOIN 
			booking ON times.user = booking.guest_id
                LEFT JOIN 
			guests ON times.user = guests.id        
		WHERE 
			times.confirmed = '1' AND times.objekt_id = '" . $obj . "'			
		ORDER BY 
			datean";
        $db_erg = mysqli_query($db_link, $sql);
        if (!$db_erg) {
            die('Ungültige Abfrage: ' . mysqli_error($db_erg));
        }
        while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {
            $datean = $zeile['datean'];
            $dateab = $zeile['dateab'];
            $times_id = $zeile['times_id'];
            $obj_id = $zeile['objekt_id'];
            $guest_id = $zeile['user'];
            $obj_name = $zeile['name'];
            $book_id = $zeile['id'];
            $guest_name = $zeile['nname'];
            $guest_mail = $zeile['email'];
            fwrite($kb_ical, "\r\nBEGIN:VEVENT");
            echo "BEGIN:VEVENT<br>";
            fwrite($kb_ical, "\r\nUID:" . date('Ymd') . "T" . date('His') . "Z-" . $guest_mail);
            echo "UID:" . date('Ymd') . "T" . date('His') . "Z-" . $guest_mail . "<br>";
            fwrite($kb_ical, "\r\nDTSTAMP:" . date('Ymd') . "T" . date('His') . "Z");
            echo "DTSTAMP:" . date('Ymd') . "T" . date('His') . "Z<br>";
            fwrite($kb_ical, "\r\nDTSTART:" . date('Ymd', strtotime($datean)) . "T000000Z");
            echo "DTSTART:" . date('Ymd', strtotime($datean)) . "T000000Z<br>";
            fwrite($kb_ical, "\r\nDTEND:" . date('Ymd', strtotime($dateab)) . "T000000Z");
            echo "DTEND:" . date('Ymd', strtotime($dateab)) . "T000000Z<br>";
            fwrite($kb_ical, "\r\nLOCATION:" . $obj_name);
            echo "LOCATION:" . $obj_name . "<br>";
            fwrite($kb_ical, "\r\nSUMMARY:Belegung von " . $guest_name);
            echo "SUMMARY:Belegung von " . $guest_name . "<br>";
            fwrite($kb_ical, "\r\nEND:VEVENT");
            echo "END:VEVENT<br>";
        }
        fwrite($kb_ical, "\r\nEND:VCALENDAR");
        echo "END:VCALENDAR<br>";
        fclose($kb_ical);
        echo '<a href="ical/' . $exp_uri . '">Download</a>';
        ?>
    </body>
</html>






