<?php
//Nur angemeldete Nutzer können Zimmer reservieren
if (isset($_SESSION['role']) && $_SESSION['role'] === "guest") {
    header('location: ./error.php');
    exit();
}
?>

<?php

$roomErr = $arrivalDateErr = $departureDateErr = "";
$room = $arrivalDate = $departureDate = "";

$services = array(
    "breakfast" => false,
    "parking" => false,
    "pet" => false
);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //Zimmer muss ausgewählt sein
    if ((isset($_POST['room']) && $_POST['room']) == "") {
        $roomErr = "Sie müssen ein Zimmer auswählen!";
    } else {
        $room = $_POST["room"];
    }

    if (isset($_POST['arrivalDate']) && isset($_POST['departureDate'])) {
        if ($_POST['arrivalDate'] >= $_POST['departureDate']) {
            $departureDateErr = "Das Abreisedatum muss nach dem Anreisedatum liegen!";
        }
    }

    if ((isset($_POST['arrivalDate']) && $_POST['arrivalDate']) == "") {
        $arrivalDateErr = "Sie müssen ein Anreisedatum auswählen!";
    } else {
        $arrivalDate = $_POST["arrivalDate"];
    }

    if ((isset($_POST['departureDate']) && $_POST['departureDate']) == "") {
        $departureDateErr = "Sie müssen ein Abreisedatum auswählen!";
    } else {
        $departureDate = $_POST["departureDate"];
    }

    if (isset($_POST['breakfast'])) {
        $services['breakfast'] = true;
    }

    if (isset($_POST['parking'])) {
        $services['parking'] = true;
    }

    if (isset($_POST['pet'])) {
        $services['pet'] = true;
    }

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

?>