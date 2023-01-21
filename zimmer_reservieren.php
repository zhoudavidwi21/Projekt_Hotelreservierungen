<?php include "Commons/sessions.php"; ?>

<?php include "Commons/zimmer_reservieren_validation.php"; ?>

<?php require_once('db/dbaccess.php'); ?>

<?php

if (isset($_POST['booking'])) {
  if (
    $roomErr == "" && $arrivalDateErr == "" && $departureDateErr == ""
  ) {

    $_SESSION['resRoom'] = $room;
    $_SESSION['resArrival'] = $arrivalDate;
    $_SESSION['resDeparture'] = $departureDate;
    $_SESSION['resServices']['resBreakfast'] = $services['breakfast'];
    $_SESSION['resServices']['resParking'] = $services['parking'];
    $_SESSION['resServices']['resPet'] = $services['pet'];

    header('Refresh:0; url=index.php?site=zimmer_reservieren_confirmed');
    ob_end_flush();
    exit();
  } else {
    echo "<div class='alert alert-danger' role='alert'>
    Folgende Fehler sind aufgetreten: <br>
    " . $roomErr . " <br>
    " . $arrivalDateErr . " <br>
    " . $departureDateErr . " </div>";
  }
}

$sql = "SELECT * FROM `users` WHERE `userId` = ? AND `deleted` = 0";
$stmt = $db_obj->prepare($sql);
$stmt->bind_param("i", $_SESSION['userId']);
?>

<div class="text-center container-fluid">

    <h1 class="h1 mb-3 fw-normal">Zimmer reservieren</h1>


  <img class="mb-4" src="./Images/Kastanie_transparent.png" alt="Kastanien Logo" width="144" height="114">


  <div class="row justify-content-md-center">
    <div class="col-lg-2 col-md-3">
    </div>

    <h2 class="mt-5">Hallo
      <?php echo $_SESSION["username"]; ?>!
    </h2>

    <form method="POST">

      <div class="d-inline-flex">
        <div class="row">
          <div class="col-auto">
            <label for="room" hidden>Zimmer auswählen</label>
            <select class="form-select" name="room" id="room" aria-describedby="roomAvailable validationRoom">
              <option selected value="">Zimmer auswählen</option>

              <?php
              $db_obj = new mysqli($host, $dbUser, $dbPassword, $database);

              //Überprüfung ob Verbindung erfolgreich
              if ($db_obj->connect_error) {
                echo 'Connection error: ' . $db_obj->connect_error;
                exit();
              }

              $sql = "SELECT * FROM `rooms` ORDER BY `roomNumber` ASC";
              $stmt = $db_obj->prepare($sql);
              $stmt->execute();
              $result = $stmt->get_result();

              if ($result->num_rows === 0) {
                echo "<div class='alert alert-danger' role='alert'>
                    Es wurden keine Zimmer in der Datenbank gefunden.
                    </div>";
                $stmt->close();
                $db_obj->close();
              } else {
                while ($row = $result->fetch_assoc()) {
                  echo "<option " . (isset($_SESSION['resRoom']) && $_SESSION['resRoom'] == $row['roomNumber'] ? "selected" : "") .
                    "value='" . $row['roomNumber'] . "'> Zimmer " . $row['roomNumber'] . " (" . number_format($row['roomPrice'], 2, ",") . " €/pro Nacht)</option>";
                }
                $stmt->close();
                $db_obj->close();
              }
              ?>
            </select>

          </div>
        </div>
      </div>

      <div class="checkbox">
        <div class="grid gap-0 row-gap-3">

          <div class="row row-cols-1">
            <div class="p-2 g-col">
              <input class="form-check-input" type="checkbox" name="breakfast" id="breakfast" value="true"> <label class="form-check-label" for="breakfast">
                Frühstück inkludieren (10€/Nacht)
              </label>
            </div>

            <div class="p-2 g-col">
              <input class="form-check-input" type="checkbox" name="parking" id="parking" value="true">
              <label class="form-check-label" for="parking">
                Parkplatz reservieren (15€/Nacht)
              </label>
            </div>

            <div class="p-2 g-col">
              <input class="form-check-input" type="checkbox" name="pet" id="pet" value="true">
              <label class="form-check-label" for="pet">
                Haustier mitnehmen (Kostenlos)
              </label>
            </div>
          </div>

        </div>
      </div>

      <div class="row justify-content-md-center">
        <div class="col-lg-1 col-md-3">
          <label for="arrivalDate">Anreisedatum</label>
          <input type="date" name="arrivalDate" id="arrivalDate" class="form-control mb-3" aria-describedby="validationArrival" required>

        </div>
      </div>

      <div class="row justify-content-md-center">
        <div class="col-lg-1 col-md-3">
          <label for="departureDate">Abreisedatum</label>
          <input type="date" name="departureDate" id="departureDate" class="form-control mb-3" aria-describedby="validationDeparture" required>

        </div>
      </div>

      <div class="row justify-content-md-center">
        <div class="col-auto mt-2">
          <button class="w-100 btn btn-lg btn-sonstige" type="submit" name="booking" value="true">Reservieren</button>
        </div>
      </div>
    </form>

  </div>