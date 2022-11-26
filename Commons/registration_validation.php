<?php

//Wenn ein angemeldeter Nutzer auf die Seite zugreifen will --> fehler
if($_SESSION['role'] != "guest"){
  header('location: ./error.php');
  exit();
}

$genderErr = $companyErr = $firstnameErr = $lastnameErr = $emailErr = $usernameErr = $passwordErr = $passwordCheckErr = $agreeDatenschutzErr = $agreeAgbsErr = $submitErr = "";

$gender = $company = $firstname = $lastname = $email = $username = $password = $passwordCheck = $agreeDatenschutz = $agreeAgbs = $submit = "";

if(!isset($_SESSION['regGender'])){
  $_SESSION['regGender'] = "";
}
if(!isset($_SESSION['regCompany'])){
  $_SESSION['regCompany'] = "";
}
if(!isset($_SESSION['regFirstname'])){
  $_SESSION['regFirstname'] = "";
}
if(!isset($_SESSION['regLastname'])){
  $_SESSION['regLastname'] = "";
}
if(!isset($_SESSION['regUsername'])){
  $_SESSION['regUsername'] = "";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  //Anrede muss ausgewählt sein
  if (($_POST["gender"]) == "") {
    $genderErr = "Sie müssen eine Anrede auswählen!";
  } else {
    $gender = input_data($_POST["gender"]);
  }

  //Wenn Anrede Firma ist muss ein Firmenname eingegeben werden
  if ($gender == "firma") {
    if ($_POST["company"] == "")
      $companyErr = "Sie haben keinen Firmennamen eingegeben!";
    else {
      $company = input_data($_POST["company"]);
    }
  }

  //Überprüfung ob Vorname vorhanden
  if (empty(trim($_POST["firstname"]))) {
    $firstnameErr = "Bitte geben Sie einen Vornamen ein!";
  } else {
    $firstname = input_data($_POST["firstname"]);

    //Überprüfung ob Vorname nur aus Buchstaben besteht
    if (!preg_match("/^[a-zA-Z]*$/", $firstname)) {
      $firstnameErr = "Bitte geben Sie nur Groß- und Kleinbuchstaben ein!";
    }
  }

  //Überprüfung ob Nachname vorhanden
  if (empty(trim($_POST["lastname"]))) {
    $lastnameErr = "Bitte geben Sie einen Nachnamen ein!";
  } else {
    $lastname = input_data($_POST["lastname"]);

    //Überprüfung ob Nachname nur aus Buchstaben besteht
    if (!preg_match("/^[a-zA-Z]*$/", $lastname)) {
      $lastnameErr = "Bitte geben Sie nur Groß- und Kleinbuchstaben ein!";
    }
  }

  //Überprüfung ob Email vorhanden
  if (empty(trim($_POST["email"]))) {
    $emailErr = "Bitte geben Sie eine E-Mail Adresse ein!";
  } else {
    $email = input_data($_POST["email"]);

    //Überprüfung ob Email zumindest "normale" Form hat.
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Bitte geben Sie eine gültige E-Mail Adresse ein!";
    }
  }

  //Überprüfung ob Benutzername vorhanden/nicht leerzeichen ist
  if (empty(trim($_POST["username"]))) {
    $usernameErr = "Bitte geben Sie einen Benutzernamen ein!";
  } else {
    $username = input_data($_POST["username"]);
    //Überprüfung ob Username unique
    $usernameIsUnique = isUsernameUnique($username);
    if (!$usernameIsUnique) {
      $usernameErr = "Dieser Benutzername ist leider schon vergeben";
    }
  }

  //Überprüfung ob Passwort vorhanden/nicht leerzeichen ist
  if (empty(trim($_POST["password"]))) {
    $passwordErr = "Bitte geben Sie ein Passwort ein!";
  } else {
    $password = input_data($_POST["password"]);

    //Passwort regex check
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number = preg_match('@[0-9]@', $password);
    //$uppercase = preg_match('@[^\w]@', $password); kann man auch, aber zu mühsam jetzt
    if (!$uppercase || !$lowercase || !$number || strlen($password) < 5) {
      $passwordErr = "Ihr Passwort muss mindestens 5 Zeichen lang sein und sollte einen Großbuchstaben, einen Kleinbuchstaben und eine Ziffer enthalten.";
    }
  }

  //Überprüfung ob Passwort vorhanden/nicht leerzeichen ist
  if (empty(trim($_POST["passwordCheck"]))) {
    $passwordCheckErr = "Sie müssen Ihr Passwort wiederholen!";
  } else {
    $passwordCheck = input_data($_POST["passwordCheck"]);

    //Passwort Wiederholung überprüfen
    if ($passwordCheck !== $password) {
      $passwordCheckErr = "Ihre Passwörter stimmen nicht überein!";
    }
  }
  //Überprüfung ob Datenschutz akzeptiert wurden
  if (empty($_POST["datenschutz"])) {
    $agreeDatenschutzErr = "Sie müssen den Datenschutz akzeptieren!";
  } else {
    $agreeDatenschutz = input_data($_POST["datenschutz"]);
  }

  //Überprüfung ob AGBs akzeptiert wurden
  if (empty($_POST["agbs"])) {
    $agreeAgbsErr = "Sie müssen den AGBs akzeptieren!";
  } else {
    $agreeAgbs = input_data($_POST["agbs"]);
  }

}

//Vereinheitlichts die Eingabe bevor sie eingespeichert wird. --> vlt nützlich für DB-Anbindung?
function input_data($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

//Ändert Klasse jenachdem ob es einen Error gibt oder nicht
function validityClass($error, string $name)
{
  if (isset($_POST[$name])) {
    if ($error != "") {
      echo "is-invalid";
    } else {
      echo "is-valid";
    }
  }
}

//Gibt das invalid Feedback mit einer Error Nachricht aus wenn es invalid ist
//$id muss das gleiche stehen wie bei aria-describedby
function invalidFeedback($error, string $id)
{
  if ($error != "") {
    echo '<div id="$id" class="invalid-feedback">';
    echo $error;
    "</div>";
  }
}

function isUsernameUnique($username)
{
  //Datenbank Check
  //Code

  //Vorerst hardcoded gegen user und admin
  if ($username == "user" || $username == "admin") {
    return false;
  } else {
    return true;
  }
}

/*
echo "<pre>";
print_r($_POST);
"</pre>";
*/

//Als Test Ausgaben

?>