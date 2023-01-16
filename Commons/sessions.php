<?php require_once('db/dbaccess.php'); ?>

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

  $db_obj = new mysqli($host, $dbUser, $dbPassword, $database);

  //Fehlermeldung bei DB-Verbindungsfehler
  if ($db_obj->connect_error) {
    echo 'Connection error: ' . $db_obj->connect_error;
    exit();
  }

  $sql = "SELECT * FROM `users` WHERE `username` = ? AND `deleted` = 0";
  $stmt = $db_obj->prepare($sql);
  $stmt->bind_param("s", $_SESSION['userId']);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 0) {
    $stmt->close();
    $db_obj->close();
    header('Refresh: 1; url=Commons/logout.php');
  } else {
    //fetch_assoc returnt ein array als key-value-pair, 
    //fetch_array returnt potenziell ein array mit numerischen keys
    $row = $result->fetch_assoc();
    $_SESSION["userId"] = $row["userId"];
    $_SESSION["username"] = $row["username"];
    $_SESSION["role"] = $row["role"];
    $_SESSION['loginTime'] = time();
    $stmt->close();
    $db_obj->close();
  }
}

if (isset($_SESSION['loginTime']) && time() >= $_SESSION['loginTime'] + $sessionDuration) {
  header('Refresh: 1; url=Commons/logout.php');
}
?>