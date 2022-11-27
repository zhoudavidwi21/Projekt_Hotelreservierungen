<?php
//Muss auf jeder Seite vor der HTML sein
if (!isset($_SESSION)) {
  session_start(); //muss zu beginn von jeder session stehen
}

//Falls man noch nicht eingeloggt ist hat man noch keine Rolle --> Man kriegt dann die Rolle guest
if (!isset($_SESSION["role"])) {
  $_SESSION["role"] = "guest";
}

//Zum Testen der Rolle
/*
if ($_SESSION["role"] === "admin") {
  echo "Nur Admins können das lesen";
} elseif ($_SESSION["role"] === "user") {
  echo "Nur User können das lesen";
} else {
  echo "Sie sind nicht eingeloggt!";
}
*/

//Logout Funktion 
if (
  $_SERVER["REQUEST_METHOD"] === "POST" 
  && isset($_POST["logout"]) 
  && $_POST["logout"] === "true"
){
  session_unset();
  session_destroy();
  header("Location: ./index.php");
  $_SESSION = array();
}
?>