<?php include "./Commons/sessions.php"; ?>

<?php require_once('db/dbaccess.php'); ?>

<?php
//Nur Admins können Benutzer verwalten
if (isset($_SESSION['role']) && $_SESSION['role'] !== "admin") {
    header('Refresh:0; url=index.php?site=error');
    exit();
}

if (!isset($_GET['reservationId']) || empty($_GET['reservationId'])) {
    header('Refresh:0; url=index.php?site=error');
    exit();
}

if (!is_numeric($_GET['reservationId'])) {
    header('Refresh:0; url=index.php?site=error');
    exit();
}

if ($_GET['reservationId'] < 0) {
    header('Refresh:0; url=index.php?site=error');
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

//Überprüfung ob Status geändert wurde
if (isset($_POST['reservationStatus'])) {
    $reservationId = $_GET['reservationId'];
    $status = $_POST['reservationStatus'];

    $sql = "UPDATE `reservations` SET `reservationStatus` = '$status' WHERE `reservationId` = $reservationId";
    $stmt = $db_obj->prepare($sql);

    $stmt->execute();
    $stmt->close();
    $db_obj->close();
    header('Refresh:0; url=index.php?site=admin_zimmer_reservieren_Verwaltung');
    exit();
}
?>

<div class="text-center container-fluid">
    <div class="row justify-content-md-center">
        <div class="col-sm-6 col-md-5 col-lg-4">
            <div class="row">
                <div class="col">
                </div>
                <div class="col-10">

                    <h1 class="h1 mb-3 fw-normal">Reservierungsdetails ansehen</h1>

                    <img src="Images/Kastanie_transparent.png" alt="Kastanie Logo" width="144" height="114">

                </div>
                <div class="col">

                </div>
            </div>

            <main class="form-signin w-100 m-auto">
                <?php

                $reservationId = $_GET['reservationId'];

                $sql = "SELECT * FROM `reservations` where `reservationId` = $reservationId";
                $stmt = $db_obj->prepare($sql);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows === 0) {
                    echo "<div class='alert alert-danger' role='alert'>
                    Es wurden keine Reservierungen in der Datenbank gefunden.
                    </div>";
                    $stmt->close();
                    $db_obj->close();
                } else {

                    echo "<form method='POST' name='reservationManagement'>";

                    while ($row = $result->fetch_assoc()) {

                        $date_arr = date_create($row["arrivalDate"]);
                        $date_dep = date_create($row["departureDate"]);
                        $date_res = date_create($row["reservationDate"]);

                        // Anzahl der Nächte berechnen
                        $intervall = date_diff($date_arr, $date_dep, true);

                        //Zimmernummer auslesen
                        $roomId = $row["fk_roomId"];
                        $sqlRooms = "SELECT * FROM `rooms` WHERE `roomId` = $roomId";
                        $stmtRooms = $db_obj->prepare($sqlRooms);
                        $stmtRooms->execute();
                        $resultRooms = $stmtRooms->get_result()->fetch_assoc();
                        $roomNumber = $resultRooms["roomNumber"];

                        //Benutzer auslesen
                        $userId = $row["fk_userId"];
                        $sqlUsers = "SELECT * FROM `users` WHERE `userId` = $userId";
                        $stmtUsers = $db_obj->prepare($sqlUsers);
                        $stmtUsers->execute();
                        $resultUsers = $stmtUsers->get_result()->fetch_assoc();
                        $userGender = $resultUsers['gender'];
                        $userCompan = $resultUsers['companyName'];
                        $userFirstname = $resultUsers["firstName"];
                        $userLastname = $resultUsers["lastName"];

                        //Services auslesen
                        $services = array();
                        $sqlServices = "SELECT * FROM `reservations_services` WHERE `fk_reservationId` = $reservationId";
                        $stmtServices = $db_obj->prepare($sqlServices);
                        $stmtServices->execute();
                        $resultServices = $stmtServices->get_result();

                        if ($resultServices->num_rows !== 0) {
                            while ($rowServices = $resultServices->fetch_assoc()) {
                                switch ($rowServices['fk_serviceId']) {
                                    case 1:
                                        $services[] = "Frühstück";
                                        break;
                                    case 2:
                                        $services[] = "Parkplatz";
                                        break;
                                    case 3:
                                        $services[] = "Haustier";
                                        break;
                                }
                            }
                        }
                        echo "<hr class='featurette-divider'>";

                        echo "<div class='row'>
                        <h3 class='featurette-heading fw-normal lh-1'><br>
                        <span class='text-muted'>Reservierung " . $row["reservationId"] . " von Zimmer " . $roomNumber . "</span> 
                        </h3>
                        <p class='fs-5 lh-1'>Zeitraum von :
                        " . date_format($date_arr, "d.m.Y") . " bis " . date_format($date_dep, "d.m.Y") . "
                        <p class='fs-5 lh-1'>User Id: 
                        " . $userId . ", " . $userGender;

                        if ($userGender != "Firma") {
                            echo " " . $userFirstname . " " . $userLastname;
                        } else {
                            echo " " . $userCompany;
                        }

                        echo "
                        <p class='fs-6 lh-1'>Anzahl der Nächte: 
                        " . $intervall->format("%a") . "
                        <p class='fs-6 lh-1'>Services: 
                        " . implode(", ", $services) . "
                        <p class='fs-4 lh-1'>Preis gesamt:
                        " . number_format($row['totalPrice'], 2, ",") . " €
                        <p class='fs-6 lh-1'>Datum der Reservierung: 
                        " . date_format($date_res, "d.m.Y H:i") . "  
                        <p class='fs-5 lh-1'>Status der Reservierung :
                        </p>
                        <select
                        class='form-select' name='reservationStatus' aria-label='Reservation Status select'>
                        <option value='neu'" . ($row['reservationStatus'] == 'neu' ? "selected" : "") . ">neu</option>
                        <option value='bestätigt' " . ($row['reservationStatus'] == 'bestätigt' ? "selected" : "") . ">bestätigt</option>
                        <option value='storniert' " . ($row['reservationStatus'] == 'storniert' ? "selected" : "") . ">storniert</option>
                        </select>
                        </div>
                        ";


                        /*
                        // Daten abfragen
                        $sql = "SELECT reservationStatus FROM reservations";
                        // Daten an Formular übergeben
                        echo "<form method= GET action= reservationStatus>";
                        // Dropdown-Box erstellen und mit Werten füllen
                        echo "<p>Reservierungsstatus ändern: <select name = Reservierungsstatus ändern: >";
                        foreach ($pdo->query($sql) as $row) {
                        echo "<option value =" . $row['reservationStatus']."</option>";
                        }
                        echo "</select></p>";
                        // Auswahl übermitteln
                        echo "<input type= submit/ ><br />";
                        // Ausgabe der Auswahl
                        echo "Auswahl: ".$_POST["reservationStatus"];
                        */
                    }

                    echo "<a href='index.php?site=admin_zimmer_reservieren_Verwaltung' class='btn btn-secondary'>Zurück</a>";

                    echo "<button type='submit' class='btn btn-sonstige'>Ändern</button>";


                    echo "</form>";
                    $stmt->close();
                    $db_obj->close();
                }
                ?>
            </main>
        </div>
    </div>
</div>