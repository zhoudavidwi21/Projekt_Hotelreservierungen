<?php include "./Commons/sessions.php"; ?>

<?php require_once('db/dbaccess.php'); ?>

<div class="text-center container-fluid">
  <div class="row">
    <div class="col">
    </div>
    <div class="col-10">

      <h1 class="h1 mb-3 fw-normal">Unsere Zimmer und Suiten</h1>

      <img src="Images/Kastanie_transparent.png" alt="Kastanie Logo" width="144" height="114">

      <h3 class="h3 mb-3 fw-normal">Allgemeines</h3>
      <p>Alle unsere Zimmer und Bäder sind komplett neu gestaltet. <br>
        Entrée mit geräumigem Schrank, Kofferablage und Zugang zum Privatbad. <br>
        Anspruchsvoll designte Bäder mit Flachdusche/WC oder Badewanne/WC, Fön, Kosmetikspiegel und Handtuchheizkörper.
        <br>
        Zimmer mit kostenfreiem W-LAN, individuell regulierbarer Klimaanlage,
        26" oder 32" Flachbild-TV (Sat-TV, mehrsprachig), Schreibtisch, Safe,
        Welcome-Tray (= Wasserkocher für Tee/Kaffee). <br>
        In der Lobby gibt es einen Getränke- und einen Snackautomaten.
      </p>
      <br>
      <h5 class="h5 mb-3 fw-normal">Die Bezeichnung EZ bedeutet Einzelzimmer und DZ bedeutet Doppelzimmer. </h5>
    </div>
    <div class="col">

    </div>
  </div>

  <?php

  $db_obj = new mysqli($host, $dbUser, $dbPassword, $database);

  //Überprüfung ob Verbindung erfolgreich
  if ($db_obj->connect_error) {
    echo 'Connection error: ' . $db_obj->connect_error;
    exit();
  }

  $sql = "SELECT * FROM `rooms` ORDER BY `roomNumber` ASC";
  $stmt = $db_obj->prepare($sql);
  $stmt->bind_param("s", $_POST["username"]);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 0) {
    echo "<div class='alert alert-danger' role='alert'>
     Es wurden keine Zimmer in der Datenbank gefunden.";
    $stmt->close();
    $db_obj->close();
  } else {

    for ($i = 1; $row = $result->fetch_assoc(); $i += 1) {

      echo " <hr class='featurette-divider'>";

      if ($i % 2 == 0) {
        echo "
        <div class='row featurette'>
        <div class='col-md-7 order-md-2'>
          <h2 class='featurette-heading fw-normal lh-1'><br>
            <span class='text-muted'>Zimmer " . $row["roomNumber"] . " - " . $row["roomType"] . " \"" . $row["roomName"] . "\"</span>
          </h2>
          <p class='lead'>" . $row["roomDescription"] . "</p>
          <h2 class='featurette-heading fw-normal lh-1'><br>
        </div>
        <div class='col-md-5 order-md-1'>
  
          <div id='carouselExampleSlidesOnly' class='carousel slide carousel-fade' data-bs-ride='carousel'>
            <div class='carousel-inner'>
              <div class='carousel-item active' data-bs-interval='2000'>
                <img src='Images/Zimmer/Zimmer_" . $row["roomNumber"] . "_600x400.jpg' class='d-block w-100' alt='Foto Hotel 1982'>
              </div>
  
              </div>
            </div>
          </div>
        </div>
        ";
      } else {
        echo "
        <div class='row featurette'>
        
          <div class='col-md-7 order-md-1'>
          <h2 class='featurette-heading fw-normal lh-1'><br>
            <span class='text-muted'>Zimmer " . $row["roomNumber"] . " - " . $row["roomType"] . " \"" . $row["roomName"] . "\"</span>
          </h2>
          <p class='lead'>" . $row["roomDescription"] . "</p>
          <h2 class='featurette-heading fw-normal lh-1'><br>
          </div>
        <div class='col-md-5 order-md-2'>
    
          <div id='carouselExampleSlidesOnly' class='carousel slide carousel-fade' data-bs-ride='carousel'>
            <div class='carousel-inner'>
              <div class='carousel-item active' data-bs-interval='2000'>
                <img src='Images/Zimmer/Zimmer_" . $row["roomNumber"] . "_600x400.jpg' class='d-block w-100' alt='Foto Hotel 2012'>
              </div>
            </div>
          </div>
        </div>
      </div>";
      }
    }
  }
  ?>

  <hr class="featurette-divider">

  <div class="row featurette">
    <div class="col-md-7 order-md-2">
      <h2 class="featurette-heading fw-normal lh-1"><br>
        <span class="text-muted">Zimmer 201 - EZ "Zum Torbogen"</span>
      </h2>
      <p class="lead">Hier kommt noch die Beschreibung ...</p>
      <h2 class="featurette-heading fw-normal lh-1"><br>
    </div>
    <div class="col-md-5 order-md-1">

      <div id="carouselExampleSlidesOnly" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active" data-bs-interval="2000">
            <img src="Images/Zimmer/Zimmer_03_600x400.jpg" class="d-block w-100" alt="Foto Hotel 1982">
          </div>

        </div>
      </div>
    </div>
  </div>

  <hr class="featurette-divider">

  <div class="row featurette">
    <div class="col-md-7 order-md-1">
      <h2 class="featurette-heading fw-normal lh-1"><br>
        <span class="text-muted">Zimmer 202 - DZ "Wilder Wald"</span>
      </h2>
      <p class="lead">Hier kommt noch die Beschreibung ...</p>
      <h2 class="featurette-heading fw-normal lh-1"><br>
    </div>
    <div class="col-md-5 order-md-2">

      <div id="carouselExampleSlidesOnly" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active" data-bs-interval="2000">
            <img src="Images/Zimmer/Zimmer_07_600x400.jpg" class="d-block w-100" alt="Foto Hotel 2012">
          </div>

        </div>
      </div>
    </div>
  </div>

  <hr class="featurette-divider">

  <div class="row featurette">
    <div class="col-md-7 order-md-2">
      <h2 class="featurette-heading fw-normal lh-1"><br>
        <span class="text-muted">Zimmer 203 - DZ "Himmlische Eiche"</span>
      </h2>
      <p class="lead">Hier kommt noch die Beschreibung ...</p>
      <h2 class="featurette-heading fw-normal lh-1"><br>
    </div>
    <div class="col-md-5 order-md-1">

      <div id="carouselExampleSlidesOnly" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active" data-bs-interval="2000">
            <img src="Images/Zimmer/Zimmer_04_600x400.jpg" class="d-block w-100" alt="Foto Hotel 1982">
          </div>

        </div>
      </div>
    </div>
  </div>

  <hr class="featurette-divider">

  <div class="row featurette">
    <div class="col-md-7 order-md-1">
      <h2 class="featurette-heading fw-normal lh-1"><br>
        <span class="text-muted">Zimmer 301 - Suite "Zum Donaublick"</span>
      </h2>
      <p class="lead">Hier kommt noch die Beschreibung ...</p>
      <h2 class="featurette-heading fw-normal lh-1"><br>
    </div>
    <div class="col-md-5 order-md-2">

      <div id="carouselExampleSlidesOnly" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active" data-bs-interval="2000">
            <img src="Images/Zimmer/Zimmer_01_600x400.jpg" class="d-block w-100" alt="Foto Hotel 2012">
          </div>

        </div>
      </div>
    </div>
  </div>

  <hr class="featurette-divider">

  <div class="row featurette">
    <div class="col-md-7 order-md-2">
      <h2 class="featurette-heading fw-normal lh-1"><br>
        <span class="text-muted">Zimmer 302 - Suite "Zum hölzernen Traum"</span>
      </h2>
      <p class="lead">Hier kommt noch die Beschreibung ...</p>
      <h2 class="featurette-heading fw-normal lh-1"><br>
    </div>
    <div class="col-md-5 order-md-1">

      <div id="carouselExampleSlidesOnly" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active" data-bs-interval="2000">
            <img src="Images/Zimmer/Zimmer_02_600x400.jpg" class="d-block w-100" alt="Foto Hotel 1982">
          </div>

        </div>
      </div>
    </div>
  </div>

  <hr class="featurette-divider">

  <div class="row featurette">
    <div class="col-md-7 order-md-1">
      <h2 class="featurette-heading fw-normal lh-1"><br>
        <span class="text-muted">Zimmer 303 - DZ "Rote Pracht"</span>
      </h2>
      <p class="lead">Hier kommt noch die Beschreibung ...</p>
      <h2 class="featurette-heading fw-normal lh-1"><br>
    </div>
    <div class="col-md-5 order-md-2">

      <div id="carouselExampleSlidesOnly" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active" data-bs-interval="2000">
            <img src="Images/Zimmer/Zimmer_05_600x400.jpg" class="d-block w-100" alt="Foto Hotel 2012">
          </div>

        </div>
      </div>
    </div>
  </div>

  <hr class="featurette-divider">

  <div class="row featurette">
    <div class="col-md-7 order-md-2">
      <h2 class="featurette-heading fw-normal lh-1"><br>
        <span class="text-muted">Zimmer 401 - Suite "Zur Kastanie"</span>
      </h2>
      <p class="lead">Hier kommt noch die Beschreibung ...</p>
      <h2 class="featurette-heading fw-normal lh-1"><br>
    </div>
    <div class="col-md-5 order-md-1">

      <div id="carouselExampleSlidesOnly" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active" data-bs-interval="2000">
            <img src="Images/Zimmer/Zimmer_06_600x400.jpg" class="d-block w-100" alt="Foto Hotel 1982">
          </div>

        </div>
      </div>
    </div>
  </div>

</div>