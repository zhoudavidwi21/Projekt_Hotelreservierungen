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
?>

<div class="text-center container-fluid">
    <div class="row justify-content-md-center">
        <div class="col-sm-6 col-md-5 col-lg-4">
            <img class="mb-4" src="./Images/Kastanie_transparent.png" alt="Kastanien Logo" width="144" height="114">

            <h1 class="h3 mb-3 fw-normal">Reservierung bestätigen</h1>

            <div class="table-responsive">
                <div class="table-wrapper">

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Beschreibung</th>
                                <th scope="col">Preis</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">Zimmer Nummer</th>
                                <td>
                                    <?php if (isset($_SESSION['resRoom'])) {
                                        echo $_SESSION['resRoom'];
                                    } ?>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Anreisedatum</th>
                                <td>
                                    <?php if (isset($_SESSION['resArrival'])) {
                                        $date1 = date_create($_SESSION['resArrival']);
                                        echo date_format($date1, "d.m.Y");
                                    } ?>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Abreisedatum</th>
                                <td>
                                    <?php if (isset($_SESSION['resDeparture'])) {
                                        $date2 = date_create($_SESSION['resDeparture']);
                                        echo date_format($date2, "d.m.Y");
                                    } ?>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Anzahl der Nächte</th>
                                <td>
                                    <?php if (isset($_SESSION['resDeparture'])) {
                                        $diff = date_diff($date1, $date2, true);
                                        echo $diff->format("%a");
                                    } ?>
                                </td>
                                <td>
                                    <?php
                                    $query = "SELECT * FROM rooms WHERE roomNumber = '$_SESSION[resRoom]'";
                                    $result = $db_obj->query($query);
                                    $row = $result->fetch_assoc();
                                    $roomPrice = floatval($row['roomPrice']);
                                    echo number_format($roomPrice * $diff->format("%a"), 2, ",", ".") . "€";
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Frühstück</th>
                                <td>
                                    <?php if (isset($_SESSION['resBreakfast'])) {
                                        if ($_SESSION['resBreakfast'] == "true") {
                                            echo "Ja";
                                        } else {
                                            echo "Nein";
                                        }
                                    } ?>
                                </td>
                                <td>
                                    <?php
                                    $query = "SELECT * FROM services WHERE serviceName = 'breakfast'";
                                    $result = $db_obj->query($query);
                                    $row = $result->fetch_assoc();
                                    $breakfastPrice = floatval($row['servicePrice']);
                                    echo number_format($breakfastPrice * $diff->format("%a"), 2, ",", ".") . "€";
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Parkplatz</th>
                                <td>
                                    <?php if (isset($_SESSION['resParking'])) {
                                        if ($_SESSION['resParking'] == "true") {
                                            echo "Ja";
                                        } else {
                                            echo "Nein";
                                        }
                                    } ?>
                                </td>
                                <td>
                                    <?php
                                    $query = "SELECT * FROM services WHERE serviceName = 'parking'";
                                    $result = $db_obj->query($query);
                                    $row = $result->fetch_assoc();
                                    $parkingPrice = floatval($row['servicePrice']);
                                    echo number_format($parkingPrice * $diff->format("%a"), 2, ",", ".") . "€";
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Haustier</th>
                                <td>
                                    <?php if (isset($_SESSION['resPet'])) {
                                        if ($_SESSION['resPet'] == "true") {
                                            echo "Ja";
                                        } else {
                                            echo "Nein";
                                        }
                                    } ?>
                                </td>
                                <td>
                                    <?php
                                    $query = "SELECT * FROM services WHERE serviceName = 'pet'";
                                    $result = $db_obj->query($query);
                                    $row = $result->fetch_assoc();
                                    $parkingPrice = floatval($row['servicePrice']);
                                    echo number_format($parkingPrice * $diff->format("%a"), 2, ",", ".") . "€";
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Gesamtpreis</th>
                                <td colspan="2">
                                    <?php
                                    $roomTotal = $roomPrice * $diff->format("%a");
                                    $serviceTotal = 0;
                                    if (isset($_SESSION['resBreakfast']) && $_SESSION['resBreakfast'] == "true") {
                                        $serviceTotal += $breakfastPrice * $diff->format("%a");
                                    }
                                    if (isset($_SESSION['resParking']) && $_SESSION['resParking'] == "true") {
                                        $serviceTotal += $parkingPrice * $diff->format("%a");
                                    }
                                    $sum = $roomTotal + $serviceTotal;
                                    echo '<p class=fw-bold>' . number_format($sum, 2, ",", ".") . "€" . '</p>';
                                    $_SESSION['resTotal'] = $sum;

                                    $result->free();
                                    $db_obj->close();
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <a href="index.php?site=zimmer_reservieren" class="btn btn-secondary">Zurück</a>

                <a href="index.php?site=zimmer_reservierung_bestaetigen" class="btn btn-sonstige">
                    Bestätigen
                </a>
            </div>
        </div>
    </div>
</div>