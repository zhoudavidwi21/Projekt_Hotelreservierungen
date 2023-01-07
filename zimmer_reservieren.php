<?php include "Commons/sessions.php"; ?>

<?php include "Commons/reservation_validation.php"; ?>

<?php

if (isset($_POST['booking'])) {
  if (
    $roomErr == "" && $arrivalDateErr == "" && $departureDateErr == ""
  ) {

    $_SESSION['resRoom'] = $room;
    $_SESSION['resArrival'] = $arrivalDate;
    $_SESSION['resDeparture'] = $departureDate;
    $_SESSION['resBreakfast'] = $services['breakfast'];
    $_SESSION['resParking'] = $services['parking'];
    $_SESSION['resPet'] = $services['pet'];

    header('Refresh:0; url=index.php?site=reservation_confirmed');
    ob_end_flush();
    exit();
  } else {
    $_SESSION['resRoom'] = $room;
    $_SESSION['resArrival'] = $arrivalDate;
    $_SESSION['resDeparture'] = $departureDate;
    $_SESSION['resBreakfast'] = $services['breakfast'];
    $_SESSION['resParking'] = $services['parking'];
    $_SESSION['resPet'] = $services['pet'];
  }
}
?>



<div class="text-center container-fluid">

  <div class="row justify-content-md-center">
    <div class="col-lg-2 col-md-3">

      <img class="mb-4" src="./Images/Kastanie_transparent.png" alt="Kastanien Logo" width="144" height="114">
      <h1>Zimmer reservieren</h1>

    </div>
  </div>

  <hr class="featurette-divider">


  <form method="POST">

    <div class="d-inline-flex">
      <div class="row">
        <div class="col-auto">
          <label for="room" hidden>Zimmer auswählen</label>
          <select class="form-select has-validation
          <?php validityClass($roomErr, "room"); ?>" name="room" id="room" aria-describedby="roomAvailable validationRoom">
            <option <?php if(empty($_SESSION['resRoom'])){
              echo "selected";
            } ?>>Zimmer auswählen</option>
            <option <?php if(isset($_SESSION['resRoom']) && $_SESSION['resRoom'] == "201"){
              echo "selected";
            } ?> value="201">Zimmer 201</option>
            <option <?php if(isset($_SESSION['resRoom']) && $_SESSION['resRoom'] == "202"){
              echo "selected";
            } ?> value="202">Zimmer 202</option>
            <option <?php if(isset($_SESSION['resRoom']) && $_SESSION['resRoom'] == "203"){
              echo "selected";
            } ?> value="203">Zimmer 203</option>
            <option <?php if(isset($_SESSION['resRoom']) && $_SESSION['resRoom'] == "301"){
              echo "selected";
            } ?> value="301">Zimmer 301</option>
            <option <?php if(isset($_SESSION['resRoom']) && $_SESSION['resRoom'] == "302"){
              echo "selected";
            } ?> value="302">Zimmer 302</option>
            <option <?php if(isset($_SESSION['resRoom']) && $_SESSION['resRoom'] == "303"){
              echo "selected";
            } ?> value="303">Zimmer 303</option>
            <option <?php if(isset($_SESSION['resRoom']) && $_SESSION['resRoom'] == "401"){
              echo "selected";
            } ?> value="401">Zimmer 401</option>
          </select>
          <?php invalidFeedback($roomErr, "validationRoom"); ?>
          <?php
          //Entfernen oder auslagern wenn Datenbank angeschlossen
          if (isset($_POST['room'])) {
            if ($_POST['room'] == "201") {

              echo
                '<div id="roomAvailable" class="form-text">
            <p class="text-dark fw-bold">
            Dieses Zimmer ist zu diesem Zeitraum verfügbar.
            </p>
            </div>';
            } else {
              echo
                '<div id="roomAvailable" class="form-text">
            <p class="text-dark fw-bold">
            Dieses Zimmer ist leider vom 07.01.2023 - 23.01.2023 bereits verbucht.
            </p>
            </div>';
            }
          }
          ?>
        </div>
      </div>
    </div>

    <div class="checkbox">
      <div class="grid gap-0 row-gap-3">

        <div class="row row-cols-1">
          <div class="p-2 g-col">
            <input class="form-check-input" type="checkbox" name="breakfast" id="breakfast" value="true" 
            <?php if (isset($_SESSION['breakfast']) && $_SESSION['breakfast'] == true) {
              echo "checked";
            }?>
            >
            <label class="form-check-label" for="breakfast">
              Frühstück inkludieren (1000€/Nacht)
            </label>
          </div>

          <div class="p-2 g-col">
            <input class="form-check-input" type="checkbox" name="parking" id="parking" value="true"
            <?php if (isset($_SESSION['parking']) && $_SESSION['parking'] == true) {
              echo "checked";
            }?>
            >
            <label class="form-check-label" for="parking">
              Parkplatz reservieren (500€/Nacht)
            </label>
          </div>

          <div class="p-2 g-col">
            <input class="form-check-input" type="checkbox" name="pet" id="pet" value="true"
            <?php if (isset($_SESSION['pet']) && $_SESSION['pet'] == true) {
              echo "checked";
            }?>
            >
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
        <input type="date" name="arrivalDate" id="arrivalDate" class="form-control mb-3 has-validation
        <?php validityClass($arrivalDateErr, "arrivalDate"); ?>" aria-describedby="validationArrival" 
        value="<?php echo $_SESSION['resArrival']; ?>" 
        required>
        <?php invalidFeedback($arrivalDateErr, "validationArrival"); ?>
      </div>
    </div>

      <div class="row justify-content-md-center">
        <div class="col-lg-1 col-md-3">
          <label for="departureDate">Abreisedatum</label>
          <input type="date" name="departureDate" id="departureDate" class="form-control mb-3 has-validation
          <?php validityClass($departureDateErr, "departureDate"); ?>" aria-describedby="validationDeparture"
          value="<?php echo $_SESSION['resDeparture']; ?>"
          required>
          <?php invalidFeedback($departureDateErr, "validationDeparture"); ?>
        </div>
      </div>

    <div class="row justify-content-md-center">
      <div class="col-auto mt-2">
        <button class="w-100 btn btn-lg btn-sonstige" type="submit" name="booking" value="true">Reservieren</button>
      </div>
    </div>
  </form>

</div>