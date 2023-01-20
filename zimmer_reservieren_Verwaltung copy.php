<?php include "./Commons/sessions.php"; ?>

<?php require_once('db/dbaccess.php'); ?>

<div class="text-center container-fluid">
  <div class="row">
    <div class="col">
    </div>
    <div class="col-10">

      <h1 class="h1 mb-3 fw-normal">Reservierungen verwalten</h1>

      <img src="Images/Kastanie_transparent.png" alt="Kastanie Logo" width="144" height="114">

    </div>
    <div class="col">

    </div>
  </div>

  <?php
  //Nur Admins können Reservierungen verwalten
  if (isset($_SESSION['role']) && $_SESSION['role'] !== "admin") {
    header('location: ./error.php');
    exit();
  }

  $db_obj = new mysqli($host, $dbUser, $dbPassword, $database);

  //Überprüfung ob Verbindung erfolgreich
  if ($db_obj->connect_error) {
    echo 'Connection error: ' . $db_obj->connect_error;
    exit();
  }

  $sql = "SELECT * FROM `reservations` ORDER BY `arrivalDate` ASC";
  $stmt = $db_obj->prepare($sql);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 0) {
    echo "<div class='alert alert-danger' role='alert'>
     Es wurden keine Reservierungen in der Datenbank gefunden.";
    $stmt->close();
    $db_obj->close();
  } else {

    for ($i = 1; $row = $result->fetch_assoc(); $i += 1) {

      $date_arr = date_create($row["arrivalDate"]);
      $date_dep = date_create($row["departureDate"]);
      $intervall = date_diff($date_arr, $date_dep, true);
      //echo $intervall->format("%a");

      echo " <hr class='featurette-divider'>";

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
          <p class='fs-5 lh-1'>Status der Reservierung :
            " . $row["reservationStatus"] . "
              
          </p>

        </div>
        ";
    }
  }
  ?>


</div>