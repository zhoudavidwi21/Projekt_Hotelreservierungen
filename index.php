<?php include "./Commons/sessions.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Startseite</title>
</head>

<body>

  <?php include "./Commons/header.php"; ?>

  <main>
    <br>
    <div class="text-center container-fluid">

      <div class="row carousel">
        <div class="col">
        </div>
        <div class="col-lg-8">
          <!-- Carousel START -->
          <div id="carouselHotel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselHotel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselHotel" data-bs-slide-to="1" aria-label="Slide 2"></button>
              <button type="button" data-bs-target="#carouselHotel" data-bs-slide-to="2" aria-label="Slide 3"></button>
              <button type="button" data-bs-target="#carouselHotel" data-bs-slide-to="3" aria-label="Slide 4"></button>
            </div>
            <div class="carousel-inner">
              <div class="carousel-item active" data-bs-interval="10000">
                <img src="./Images/Hotel/Hotel_aussen_01.jpg" class="img-fluid d-block w-100" alt="Hotel von außen 01">
                <div class="carousel-caption d-none d-md-block">
                  <div class="bg-light text-dark" style="--bs-bg-opacity: 0.5;">
                    <h5 class="fs-1">Willkommen beim Hotel zur Kastanie!</h5>
                    <p class="lead fs-2">Jede Kastanie, ein kleiner Schatz.</p>
                  </div>
                </div>
                <div class="carousel-caption d-none d-sm-block d-md-none">
                  <div class="bg-light text-dark" style="--bs-bg-opacity: 0.5;">
                    <h5>Willkommen!</h5>
                  </div>
                </div>
              </div>
              <div class="carousel-item" data-bs-interval="7500">
                <img src="./Images/Zimmer/Zimmer_02.jpg" class="d-block w-100" alt="Hotel Zimmer">
                <div class="carousel-caption d-none d-md-block">
                </div>
              </div>
              <div class="carousel-item" data-bs-interval="7500">
                <img src="./Images/Hotel/Hotel_aussen_02.jpg" class="d-block w-100" alt="Hotel von außen 02">
                <div class="carousel-caption d-none d-md-block">
                </div>
              </div>
              <div class="carousel-item" data-bs-interval="7500">
                <img src="./Images/Hotel/Hotel_Wien.jpg" class="d-block w-100" alt="Hotel Zimmer">
                <div class="carousel-caption d-none d-md-block">
                </div>
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselHotel" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselHotel" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
          <!-- Carousel END -->
        </div><!-- /.col-10 -->
        <div class="col">
        </div>
      </div><!-- /.row carousel -->
    </div>

    <!-- Marketing messaging and featurettes
      ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing text-center container-fluid">


      <!-- Three columns of text below the carousel -->
      <br>
      <div class="row round-circle">
        <div class="col-lg-4">
          <img class="bd-placeholder-img rounded-circle" width="140" height="140" src="Images/Kulinarik/Kulinarik_01_quadratisch_140x140.jpg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false">
          <title>Kulinarik</title>
          <!-- <rect width="100%" height="100%" fill="#777"></rect><text x="50%" y="50%" fill="#777" dy=".3em">Mhhhmmmm ...</text>
          <h2 class="fw-normal">Kulinarik</h2> -->
          <p>Lassen Sie sich in unserem Restaurant kulinarisch verwöhnen ...</p>
          <p><a class="btn btn-sonstige" href="kulinarik.php">Kulinarik »</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <img class="bd-placeholder-img rounded-circle" width="140" height="140" src="Images/Wellness/Wellness_01_quadratisch_140x140.jpg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false">
          <title>Wellness</title>
          <!--  <rect width="100%" height="100%" fill="#777"></rect><text x="50%" y="50%" fill="#777" dy=".3em">Ahhhhhh ...</text>
          <h2 class="fw-normal">Wellness</h2> -->
          <p>Entspannen Sie sich unseren Wellness- und Spa-Bereich ...</p>
          <p><a class="btn btn-sonstige" href="wellness.php">Wellness »</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4 right">
          <img class="bd-placeholder-img rounded-circle" width="140" height="140" src="Images/Impressionen/Impressionen_01_quadratisch_140x140.jpg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false">
          <title>Impressionen</title>
          <!-- <rect width="100%" height="100%" fill="#777"></rect><text x="50%" y="50%" fill="#777" dy=".3em">Ohhhhh ...</text>
          <h2 class="fw-normal">Impressionen</h2> -->
          <p>Lassen Sie sich durch diese Impressionen verzaubern ...</p>
          <p><a class="btn btn-sonstige" href="impressionen.php">Impressionen »</a></p>
        </div><!-- /.col-lg-4 -->
      </div><!-- /.row -->


      <!-- START THE FEATURETTES -->

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading fw-normal lh-1">Restaurants und Weinkeller <br> <span class="text-muted">Wohlfühlen bis zum letzten Bissen und Tropfen!</span></h2>
          <p class="lead">Unsere Lokalitäten und der Weinkeller laden zu den verschiedensten Köstlichkeiten ein ...</p>
        </div>
        <div class="col-md-5">

          <div id="carouselExampleSlidesOnly" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active" data-bs-interval="2000">
                <img src="Images/Restaurant/Restaurant_01_600x400.jpg" class="d-block w-100" alt="">
              </div>
              <div class="carousel-item" data-bs-interval="2000">
                <img src="Images/Restaurant/Restaurant_02_600x400.jpg" class="d-block w-100" alt="">
              </div>
              <div class="carousel-item" data-bs-interval="2000">
                <img src="Images/Weinkeller/Weinkeller_02_600x400.jpg" class="d-block w-100" alt="">
              </div>
              <div class="carousel-item" data-bs-interval="2000">
                <img src="Images/Restaurant/Restaurant_03_600x400.jpg" class="d-block w-100" alt="">
              </div>
              <div class="carousel-item" data-bs-interval="2000">
                <img src="Images/Restaurant/Restaurant_04_600x400.jpg" class="d-block w-100" alt="">
              </div>
              <div class="carousel-item" data-bs-interval="2000">
                <img src="Images/Weinkeller/Weinkeller_03_600x400.jpg" class="d-block w-100" alt="">
              </div>
              <div class="carousel-item" data-bs-interval="2000">
                <img src="Images/Restaurant/Restaurant_05_600x400.jpg" class="d-block w-100" alt="">
              </div>
              <div class="carousel-item" data-bs-interval="2000">
                <img src="Images/Restaurant/Restaurant_06_600x400.jpg" class="d-block w-100" alt="">
              </div>
              <div class="carousel-item" data-bs-interval="2000">
                <img src="Images/Weinkeller/Weinkeller_04_600x400.jpg" class="d-block w-100" alt="">
              </div>
              <div class="carousel-item" data-bs-interval="2000">
                <img src="Images/Restaurant/Restaurant_07_600x400.jpg" class="d-block w-100" alt="">
              </div>
            </div>
          </div>

          <!--  
          <img class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" src="Images/Weinkeller/Weinkeller_04.jpg" role="img" aria-label="Placeholder: 140x140" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false">
            <title>Placeholder</title>
          <rect width="100%" height="100%" fill="#eee"></rect><text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text> -->
        </div>
      </div>

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7 order-md-2">
          <h2 class="featurette-heading fw-normal lh-1">Suiten und Zimmer <br><span class="text-muted">Träumen wie auf Wolken!</span></h2>
          <p class="lead">Ihr Aufenthalt wird zum einem absoluten Traum, aus dem Sie nicht mehr aufwachen wollen ...</p>
        </div>
        <div class="col-md-5 order-md-1">

        <div id="carouselExampleSlidesOnly" class="carousel slide carousel-fade" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="2000">
              <img src="Images/Zimmer/Zimmer_01_600x400.jpg" class="d-block w-100" alt="">
            </div>
            <div class="carousel-item" data-bs-interval="2000">
              <img src="Images/Zimmer/Zimmer_02_600x400.jpg" class="d-block w-100" alt="">
            </div>
            <div class="carousel-item" data-bs-interval="2000">
              <img src="Images/Zimmer/Zimmer_03_600x400.jpg" class="d-block w-100" alt="">
            </div>
            <div class="carousel-item" data-bs-interval="2000">
              <img src="Images/Zimmer/Zimmer_04_600x400.jpg" class="d-block w-100" alt="">
            </div>
            <div class="carousel-item" data-bs-interval="2000">
              <img src="Images/Zimmer/Zimmer_05_600x400.jpg" class="d-block w-100" alt="">
            </div>
            <div class="carousel-item" data-bs-interval="2000">
              <img src="Images/Zimmer/Zimmer_06_600x400.jpg" class="d-block w-100" alt="">
            </div>
            <div class="carousel-item" data-bs-interval="2000">
              <img src="Images/Zimmer/Zimmer_07_600x400.jpg" class="d-block w-100" alt="">
            </div>
            </div>
          </div>
          <!--         <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false">
            <title>Placeholder</title>
            <rect width="100%" height="100%" fill="#eee"></rect><text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text>
          </svg> -->
        </div>
      </div>
      <!--
      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading fw-normal lh-1">And lastly, this one. <span class="text-muted">Checkmate.</span>
          </h2>
          <p class="lead">And yes, this is the last block of representative placeholder content. Again, not really
            intended to be actually read, simply here to give you a better view of what this would look like with some
            actual content. Your content.</p>
        </div>
        <div class="col-md-5">
          <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false">
            <title>Placeholder</title>
            <rect width="100%" height="100%" fill="#eee"></rect><text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text>
          </svg>

        </div>
      </div>

      <hr class="featurette-divider">
      -->

      <!-- /END THE FEATURETTES -->

    </div><!-- /.container -->

  </main>

  <?php include "Commons/footer.php"; ?>


</body>

</html>