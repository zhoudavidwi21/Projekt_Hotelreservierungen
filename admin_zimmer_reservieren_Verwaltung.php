<?php include "./Commons/sessions.php"; ?>

<?php require_once('db/dbaccess.php'); ?>

<?php
//Nur Admins können Benutzer verwalten
if (isset($_SESSION['role']) && $_SESSION['role'] !== "admin") {
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


<!-- Reservierungen anzeigen -->
<div class="text-center container-fluid">
  <div class="row justify-content-md-center">
    <div class="col-sm-3 col-md-7 col-lg-10">
      <img class="mb-4" src="./Images/Kastanie_transparent.png" alt="Kastanien Logo" width="144" height="114">

      <h1 class="h3 mb-3 fw-normal">Reservierungen verwalten</h1>

      <div class="table-responsive">
        <div class="table-wrapper">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Reservierungs ID</th>
                <th scope="col">Zimmer</th>
                <th scope="col">Firmenname</th>
                <th scope="col">Vorname</th>
                <th scope="col">Nachname</th>
                <th scope="col">Von</th>
                <th scope="col">Bis</th>
                <th scope="col">Gesamtpreis</th>
                <th scope="col">Reservierungsdatum</th>
                <th scope="col">Reservierungsstatus</th>
                <th scope="col">Funktionen</th>
              </tr>
            </thead>
            <tbody>

              <?php

              $sql = "SELECT * FROM reservations";
              $result = $db_obj->query($sql);

              while ($row = $result->fetch_assoc()) {
                $reservationId = $row['reservationId'];
                $roomId = $row['fk_roomId'];
                $userId = $row['fk_userId'];
                $reservationStatus = $row['reservationStatus'];
                $gesamtPreis = $row['totalPrice'];

                $date_arr = date_create($row["arrivalDate"]);
                $date_dep = date_create($row["departureDate"]);
                $date_res = date_create($row["reservationDate"]);

                //Zimmernummer auslesen
                $roomId = $row["fk_roomId"];
                $sqlRooms = "SELECT * FROM `rooms` WHERE `roomId` = $roomId";
                $stmtRooms = $db_obj->prepare($sqlRooms);
                $stmtRooms->execute();
                $resultRooms = $stmtRooms->get_result()->fetch_assoc();
                $zimmerNummer = $resultRooms["roomNumber"];
                $stmtRooms->close();

                //Benutzer auslesen
                $userId = $row["fk_userId"];
                $sqlUsers = "SELECT * FROM `users` WHERE `userId` = $userId";
                $stmtUsers = $db_obj->prepare($sqlUsers);
                $stmtUsers->execute();
                $resultUsers = $stmtUsers->get_result()->fetch_assoc();
                $userGender = $resultUsers['gender'];
                $firmenname = $resultUsers['companyName'];
                $vorname = $resultUsers["firstName"];
                $nachname = $resultUsers["lastName"];
                $stmtUsers->close();

                echo "<tr>";
                echo "<th scope='row'>$reservationId</th>";
                echo "<td>$zimmerNummer</td>";
                echo "<td>$firmenname</td>";
                echo "<td>$vorname</td>";
                echo "<td>$nachname</td>";
                echo "<td>" . date_format($date_arr, "d.m.Y") . "</td>";
                echo "<td>" . date_format($date_dep, "d.m.Y") . "</td>";
                echo "<td>" . number_format($row['totalPrice'], 2, ",", ".") . " €</td>";
                echo "<td>" . date_format($date_res, "d.m.Y H:i") . "</td>";
                echo "<td>$reservationStatus</td>";
                echo "<td>";
                echo "<a href='index.php?site=admin_zimmer_reservierung_details&reservationId=$reservationId' class='btn btn-sonstige'>Details</a>";
                echo "</td>";
                echo "</tr>";
              }
              $result->close();
              $db_obj->close();
              ?>
            </tbody>
          </table>

        </div>
      </div>
    </div>
  </div>
</div>