﻿<?php
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

/*	Belegungsplan ist Freie Software: Sie können ihn unter den Bedingungen
    der GNU General Public License, wie von der Free Software Foundation,
    Version 2 der Lizenz weiterverbreiten und/oder modifizieren.

    Belegungsplan wird in der Hoffnung, dass er nützlich sein wird, aber
    OHNE JEDE GEWÄHRLEISTUNG, bereitgestellt; sogar ohne die implizite
    Gewährleistung der MARKTFÄHIGKEIT oder EIGNUNG FÜR EINEN BESTIMMTEN ZWECK.
    Siehe die GNU General Public License für weitere Details.

    Sie sollten eine Kopie der GNU General Public License zusammen mit diesem
    Programm erhalten haben. Wenn nicht, siehe <http://www.gnu.org/licenses/>
*/
	

/*$controll = $remote;
if($controll != 24519){
	echo 'Kein Zugriff!';
	exit();
}*/
//require_once ('../includes/beleg-config.php');
$db_link = mysqli_connect (
                     HOST, 
                     USER,
                     PASSWORD, 
                     DATABASE
                    );
$colors = "SELECT cal_month, cal_beleg, form_back, cal_back, back, font FROM color WHERE id = 1" ;
 
$db_erg = mysqli_query( $db_link, $colors );
if ( ! $db_erg )
{
  die('Ungültige Abfrage: ' . mysqli_error());
}
while ($zeile_c = mysqli_fetch_array( $db_erg, MYSQLI_ASSOC)){
	$cal_beleg = $zeile_c['cal_beleg'];
	$cal_month = $zeile_c['cal_month'];
	$form_back = $zeile_c['form_back'];
	$cal_back = $zeile_c['cal_back'];
	$back = $zeile_c['back'];
	$font = $zeile_c['font'];
}
?>
body{
    background-color: <?php echo $back; ?>;
	
}

input:focus, textarea:focus {
    background-color: <?php echo $form_back; ?>;
}
select:focus, textarea:focus {
    background-color: <?php echo $form_back; ?>;
}

table {
	color: <?php echo $font; ?>;
}
table, tr, td {
	border: 1px solid black;
	background-color: <?php echo $cal_back; ?>;
	border-radius: 3px 3px 3px 3px;
}
#monat {
	background-color: <?php echo $cal_month; ?>;
}
<?php
$sql = "SELECT datean, dateab FROM times WHERE (objekt_id = ".$objekt." AND YEAR(datean) = ".$jahr.") OR (objekt_id = ".$objekt." AND YEAR(dateab) = ".$jahr.") ORDER BY datean" ;
 
$db_erg = mysqli_query( $db_link, $sql );
if ( ! $db_erg )
{
  die('Ungültige Abfrage: ' . mysqli_error());
}
while ($zeile = mysqli_fetch_array( $db_erg, MYSQLI_ASSOC))
{
	$datean = new DateTime($zeile['datean']);
	$dateab = new DateTime($zeile['dateab']);
	for ($date = clone $datean; $date <= $dateab; $date->modify('+1 day')) {
		$datum_vergl = $date->format('Y-m-d');
		$datum = $date->format('n-j-Y');
		if($datum_vergl == $zeile['datean']){
			$datum = explode("-", $datum);
			$datum = $month[$datum[0]]."-".$datum[1]."-".$datum[2];
			echo "#".$datum."{background-image: linear-gradient(135deg, ".$cal_back." 50%, ".$cal_beleg." 50%)}\n";
		}elseif($datum_vergl == $zeile['dateab']){
			$datum = explode("-", $datum);
			$datum = $month[$datum[0]]."-".$datum[1]."-".$datum[2];
			echo "#".$datum."{background-image: linear-gradient(135deg, ".$cal_beleg." 50%, ".$cal_back." 50%)}\n";
		}else{
			$datum = explode("-", $datum);
			$datum = $month[$datum[0]]."-".$datum[1]."-".$datum[2];
			echo "#".$datum."{background-color: ".$cal_beleg.";}\n";
		}
		
	}
}
mysqli_free_result( $db_erg );
?>