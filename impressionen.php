<?php include "./Commons/sessions.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <title>Wellness</title>
</head>

<body>

  <?php include "commons/header.php"; ?>

  <div class="text-center container-fluid">
    <div class="row">
      <div class="col">
      </div>
      <div class="col-5">

        <h1>Einfach treiben lassen ...</h1>

        <div id="carouselExampleSlidesOnly" class="carousel slide carousel-fade" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="2000">
              <img src="Images/Impressionen/Impressionen_01_600square.jpg" class="d-block w-100" alt="">
            </div>
            <div class="carousel-item" data-bs-interval="2000">
              <img src="Images/Impressionen/Impressionen_02_600square.jpg" class="d-block w-100" alt="">
            </div>
            <div class="carousel-item" data-bs-interval="2000">
              <img src="Images/Impressionen/Impressionen_03_600square.jpg" class="d-block w-100" alt="">
            </div>
            <div class="carousel-item" data-bs-interval="2000">
              <img src="Images/Impressionen/Impressionen_05_600square.jpg" class="d-block w-100" alt="">
            </div>
          </div>
        </div>

      </div>
      <div class="col">

      </div>
    </div>
  </div>

  <?php include "Commons/footer.php"; ?>

</body>

</html>