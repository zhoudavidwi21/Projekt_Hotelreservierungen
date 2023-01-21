<?php include "./Commons/sessions.php"; ?>

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

$sql = "INSERT INTO `reservations` 
(`fk_userId`, `fk_roomId`, `arrivalDate`, `departureDate`, `totalPrice`) 
VALUES (?, ?, ?, ?, ?)";

//SQL-Statement erstellen
$stmt = $db_obj->prepare($sql);

$query = "SELECT roomId FROM rooms WHERE roomNumber = ". $_SESSION['resRoom'];

$userId = $_SESSION['userId'];
$roomId = $db_obj->query($query)->fetch_object()->roomId;
$arrivalDate = $_SESSION['resArrival'];
$departureDate = $_SESSION['resDeparture'];
$totalPrice = $_SESSION['resTotal'];

$stmt->bind_param("iisss", $userId, $roomId, $arrivalDate, $departureDate, $totalPrice);

if($stmt->execute()) {
    $stmt->close();
    $i = 1;
    foreach($_SESSION['resServices'] as $service => $value) {
        if($_SESSION['resServices'][$service] == "1"){
            $sql = "INSERT INTO `reservations_services` 
            (`fk_reservationId`, `fk_serviceId`) VALUES (?, ?)";
            $stmt = $db_obj->prepare($sql);
            $stmt->bind_param("ii", $reservationId, $serviceId);
            $reservationId = $db_obj->insert_id;
            $serviceId = $i;
            $stmt->execute();
            $stmt->close();
        }
        $i++;
    }
    $db_obj->close();
    header('Refresh:0; url=index.php?site=zimmer_reservierung_erfolgreich');
} else {
    echo "Fehler beim Speichern der Daten 
    Error: " . $sql . "<br>" . $db_obj->error;
}



?>