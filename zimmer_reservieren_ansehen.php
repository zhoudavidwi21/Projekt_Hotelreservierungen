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

<h1 class="h1 mb-3 fw-normal">Zimmer Reservierungen ansehen</h1>

  <div class="row justify-content-md-center">
    <div class="col-lg-2 col-md-3">

      <img class="mb-4" src="./Images/Kastanie_transparent.png" alt="Kastanien Logo" width="144" height="114">

    </div>
  </div>


  <h2 class="mt-5">Hallo
    <?php echo $_SESSION["username"]; ?>! <br>
    <h4>Hier sehen Sie Ihre aktuellen Reservierungen ...</h4>
  </h2>

  <?php

  $db_obj = new mysqli($host, $dbUser, $dbPassword, $database);

  //Überprüfung ob Verbindung erfolgreich
  if ($db_obj->connect_error) {
    echo 'Connection error: ' . $db_obj->connect_error;
    exit();
  }

  $sql = "SELECT * FROM `reservations` WHERE `fk_userId` = ?";
  $stmt = $db_obj->prepare($sql);
  $stmt->bind_param("i", $_SESSION['userId']);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 0) {
    echo "<div class='alert alert-danger' role='alert'>
     Es wurden keine Reservierungen in der Datenbank gefunden.";
    $stmt->close();
    $db_obj->close();
  } else {

   // for ($i = 1; $row = $result->fetch_assoc(); $i += 1) {
      while ($row = $result->fetch_assoc()) {


      // Anzahl der Nächte berechnen
      $date_arr = date_create($row["arrivalDate"]);
      $date_dep = date_create($row["departureDate"]);
      $intervall = date_diff($date_arr, $date_dep, true);
      //echo $intervall->format("%a");

      echo "<hr class='featurette-divider'>";

      echo "
        <div class='row featurette'>
          <h3 class='featurette-heading fw-normal lh-1'><br>
            <span class='text-muted'>Reservierung " . $row["reservationId"] . " von Zimmer " . $row["fk_roomId"] . "</span> 
            </h3>
          <p class='fs-5 lh-1'>Zeitraum von :
            " . $row["arrivalDate"] . " bis " . $row["departureDate"] . "
          <p class='fs-6 lh-1'>Anzahl der Nächte: 
            " . $intervall->format("%a") . "         
          <p class='fs-4 lh-1'>Preis gesamt:
            " . number_format($row['totalPrice'], 2, ",") . " €
            <p class='fs-6 lh-1'>Datum der Reservierung: 
            " . $row["reservationDate"] . "  
          <p class='fs-5 lh-1'>Status der Reservierung :
            " . $row["reservationStatus"] . "
              
          </p>

        </div>
        ";
    }
    $stmt->close();
    $db_obj->close();
  }
  ?>


  </div>