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

if (isset($_COOKIE['loginCookie'])) {
  $sessionDuration = $_COOKIE['loginCookie'];
} else {
  $sessionDuration = 3600; // 1 hour
}

if (isset($_COOKIE['loginCookie']) && isset($_COOKIE['userId'])) {
  $_SESSION['userId'] = $_COOKIE['userId'];
  if($_SESSION['userId'] == 1){
    $_SESSION['username'] = 'admin';
    $_SESSION['role'] = 'admin';
  } elseif ($_SESSION['userId'] == 2) {
    $_SESSION['username'] = 'user';
    $_SESSION['role'] = 'user';
  }
}

if(isset($_SESSION['loginTime']) && time() >= $_SESSION['loginTime'] + $sessionDuration){
  header('Refresh: 1; url=Commons/logout.php');
}
?>