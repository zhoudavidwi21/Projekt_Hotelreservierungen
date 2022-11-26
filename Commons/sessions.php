<?php
//Muss auf jeder Seite vor der HTML sein
if (!isset($_SESSION)) {
  session_start(); //muss zu beginn von jeder session stehen
}

//Falls man noch nicht eingeloggt ist hat man noch keine Rolle --> Man kriegt dann die Rolle guest
if (!isset($_SESSION["role"])) {
  $_SESSION["role"] = "guest";
}

if ($_SESSION["role"] === "admin") {
  echo "Nur Admins können das lesen";
} elseif ($_SESSION["role"] === "user") {
  echo "Nur User können das lesen";
} else {
  echo "Sie sind nicht eingeloggt!";
}
?>