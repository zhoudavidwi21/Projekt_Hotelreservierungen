<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kulinarik</title>

  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

  <!-- Template background -->
  <link rel="stylesheet" href="css_Daten/background.css">

</head>

<body>

  <?php include "Commons/header.php"; ?>

  <div class="text-center container-fluid">
    <div class="row">
      <div class="col">
      </div>
      <div class="col-10">

        <h1>Köstlichkeiten in unserem Restaurant ...</h1>

        <div id="carouselExampleSlidesOnly" class="carousel slide carousel-fade" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="2000">
              <img src="Images/Kulinarik/Kulinarik_01.jpg" class="d-block w-100" alt="">
            </div>
            <div class="carousel-item" data-bs-interval="2000">
              <img src="Images/Kulinarik/Kulinarik_02.jpg" class="d-block w-100" alt="">
            </div>
            <div class="carousel-item" data-bs-interval="2000">
              <img src="Images/Kulinarik/Kulinarik_03.jpg" class="d-block w-100" alt="">
            </div>
            <div class="carousel-item" data-bs-interval="2000">
              <img src="Images/Kulinarik/Kulinarik_04.jpg" class="d-block w-100" alt="">
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