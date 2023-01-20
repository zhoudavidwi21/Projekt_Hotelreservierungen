<?php include "Commons/sessions.php"; ?>

<?php require_once('db/dbaccess.php'); ?>

<?php
//Nur angemeldete Nutzer können Zimmer reservieren
if (isset($_SESSION['role']) && $_SESSION['role'] === "guest") {
    header('Refresh:1; url=index.php?site=error');
    exit();
}
?>

<?php

$db_obj = new mysqli($host, $dbUser, $dbPassword, $database);

//Überprüfung ob Verbindung erfolgreich
if ($db_obj->connect_error) {
    echo 'Connection error: ' . $db_obj->connect_error;
    exit();
}

$roomErr = $arrivalDateErr = $departureDateErr = "";
$room = $arrivalDate = $departureDate = "";

$services = array(
    "breakfast" => false,
    "parking" => false,
    "pet" => false
);

if (!isset($_SESSION['resRoom'])) {
    $_SESSION['resRoom'] = "";
}
if (!isset($_SESSION['resArrival'])) {
    $_SESSION['resArrival'] = "";
}
if (!isset($_SESSION['resDeparture'])) {
    $_SESSION['resDeparture'] = "";
}
if (!isset($_SESSION['resServices'])) {
    $_SESSION['resServices'] = array();
}
if (!isset($_SESSION['resServices']['resBreakfast'])) {
    $_SESSION['resServices']['resBreakfast'] = "";
}
if (!isset($_SESSION['resServices']['resParking'])) {
    $_SESSION['resServices']['resParking'] = "";
}
if (!isset($_SESSION['resServices']['resPet'])) {
    $_SESSION['resServices']['resPet'] = "";
}
if (!isset($_SESSION['resTotal'])) {
    $_SESSION['resTotal'] = "";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //Zimmer muss ausgewählt sein
    if ((isset($_POST['room']) && $_POST['room']) == "" || $_POST['room'] == "Zimmer auswählen") {
        $roomErr = "Sie müssen ein Zimmer auswählen!";
    } else {
        $room = $_POST["room"];
    }

    if (isset($_POST['arrivalDate']) && $_POST['arrivalDate'] < date("Y-m-d")) {
        $arrivalDateErr = "Das Anreisedatum muss in der Zukunft liegen!";
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

    if (!roomAvailable($room, $arrivalDate, $departureDate, $db_obj)) {
        $roomErr = "Dieses Zimmer ist in den folgenden Zeiträumen bereits verbucht: <br>
        " . getBookedDates($room, $db_obj);
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
        echo '<div id="$id" class="invalid-feedback mb-2">';
        echo $error;
        "</div>";
    }
}

function roomAvailable($room, $arrivalDate, $departureDate, $db_obj)
{
    $roomAvailable = true;
    $query = "SELECT roomId FROM rooms WHERE roomNumber = '$room'";

    $sql = "SELECT * FROM reservations 
    WHERE fk_roomId IN ($query) 
    AND reservationStatus = 'confirmed' 
    ORDER BY arrivalDate ASC";

    $stmt = $db_obj->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            //Wenn Ankunftsdatum zwischen den beiden Daten liegt
            if ($arrivalDate >= $row['arrivalDate'] && $arrivalDate <= $row['departureDate']) {
                $roomAvailable = false;
            }
            //Wenn Abreisedatum zwischen den beiden Daten liegt
            elseif ($departureDate >= $row['arrivalDate'] && $departureDate <= $row['departureDate']) {
                $roomAvailable = false;
            }
            //Wenn Ankunftsdatum und Abreisedatum außerhalb der beiden Daten liegen
            elseif ($arrivalDate <= $row['arrivalDate'] && $departureDate >= $row['departureDate']) {
                $roomAvailable = false;
            }
        }
    }
    return $roomAvailable;
}

function getBookedDates($room, $db_obj)
{
    $bookedDates = "";
    $query = "SELECT roomId FROM rooms WHERE roomNumber = '$room'";

    $sql = "SELECT * FROM reservations 
    WHERE fk_roomId IN ($query) 
    AND reservationStatus = 'confirmed' 
    ORDER BY arrivalDate ASC";

    $stmt = $db_obj->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        if ($row['arrivalDate'] >= date("Y-m-d")) {
            $arrivalDate = date_create($row['arrivalDate']);
            $departureDate = date_create($row['departureDate']);
            $bookedDates .= date_format($arrivalDate, "d.m.Y") . " - " . date_format($departureDate, "d.m.Y") . "<br>";
        }
    }
    return $bookedDates;
}

?>