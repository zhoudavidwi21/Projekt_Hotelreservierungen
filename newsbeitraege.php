<?php include "./Commons/sessions.php"; ?>

<?php require_once('db/dbaccess.php'); ?>

<div class="text-center container-fluid">
  <div class="row">
    <div class="col">
    </div>
    <div class="col-12">
      <h1 class="h1 mb-3 fw-normal">Unsere Newsbeiträge</h1>

      <img src="Images/Kastanie_transparent.png" alt="Kastanie Logo" width="144" height="114">

      <p>Die neuesten News finden sie ganz oben ...</p>
      <main>
        <div class="text-center container-fluid">

          <?php

          $db_obj = new mysqli($host, $dbUser, $dbPassword, $database);

          //Überprüfung ob Verbindung erfolgreich
          if ($db_obj->connect_error) {
            echo 'Connection error: ' . $db_obj->connect_error;
            exit();
          }

          $sql = "SELECT * FROM `news` ORDER BY `createdDate` DESC";
          $stmt = $db_obj->prepare($sql);
          $stmt->execute();
          $result = $stmt->get_result();

          if ($result->num_rows === 0) {
            echo "<div class='alert alert-danger' role='alert'>
   Es wurden keine Newsbeiträge in der Datenbank gefunden.";
            $stmt->close();
            $db_obj->close();
          } else {

            for ($i = 1; $row = $result->fetch_assoc(); $i++) {

              //Zeitformatierung
              $date = $row['createdDate']; //$row['createdDate'] ist ein String
              $date = new DateTime($date); //String wird in ein DateTime Objekt umgewandelt
          
              echo " <hr class='featurette-divider'>";

              if ($i % 2 == 0) {
                //Inhalt Formatierung Text rechts Bild links
                echo "
              <div class='row featurette'>
              <div class='col-md-7 order-md-2'>
                <h2 class='featurette-heading fw-semibold lh-1'><br>
                  <span>" . htmlspecialchars_decode($row['title']) . "</span>
                </h2>
                <p class='fs-6'>Veröffentlicht am:
                " . $date->format('d.m.Y') . "
                </p>
                <p class='lead'>"
                  . htmlspecialchars_decode($row['body']) .
                  "</p><br>
              </div>
              <div class='col-md-5 order-md-1'>
  
                <div id='carouselExampleSlidesOnly' class='carousel slide carousel-fade' data-bs-ride='carousel'>
                  <div class='carousel-inner'>
                    <div class='carousel-item active' data-bs-interval='2000'>
                      <img src='" . $row['file_path'] . "' class='d-block w-100' alt='". htmlspecialchars_decode($row['alt']) ."'>
                    </div>
  
                  </div>
                </div>
              </div>
            </div>
              ";
              } else {
                //Inhalt Formatierung Text links Bild rechts
                echo "
              <div class='row featurette'>
            <div class='col-md-7 order-md-1'> <br>
              <h2 class='featurette-heading fw-semibold lh-1'>
                <span>" . htmlspecialchars_decode($row['title']) . "</span>
              </h2>
              <p class='fs-6'>Veröffentlicht am:
                " . $date->format('d.m.Y') . "
              </p>
              <p class='lead'>"
                  . htmlspecialchars_decode($row['body']) .
                  "</p><br>
            </div>
            <div class='col-md-5 order-md-2'>

              <div id='carouselExampleSlidesOnly' class='carousel slide carousel-fade' data-bs-ride='carousel'>
                <div class='carousel-inner'>
                  <div class='carousel-item active' data-bs-interval='2000'>
                    <img src='" . $row['file_path'] . "' class='d-block w-100' alt='". htmlspecialchars_decode($row['alt']) ."'>
                  </div>

                </div>
              </div>
            </div>
          </div>
              ";
              }
            }
          }
          ?>

        
        </div>
      </main>

    </div>
    <div class="col">

    </div>
  </div>
</div>