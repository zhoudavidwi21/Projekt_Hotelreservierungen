<?php
//Muss auf jeder Seite vor der HTML sein
if (!isset($_SESSION)) {
  session_start(); //muss zu beginn von jeder session stehen
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="refresh" content="5; URL=index.php">

  <title>Registrierung durchgeführt</title>
</head>


<body>

  <?php include "Commons/header.php"; ?>

  <div class="text-center container-fluid">
    <div class="row">
      <div class="col">
      </div>
      <div class="col-10">

        <h1 class="h1 mb-3 fw-normal">Herzlichen Dank für Ihre Registrierung!</h1>
        <img class="mb-4" src="./Images/\Kastanie_transparent.png" alt="" width="144" height="114">
        <br>

        <script type="text/javascript">
          (function() {
            var timeLeft = 5,
              cinterval;
            var timeDec = function() {
              timeLeft--;
              document.getElementById('countdown').innerHTML = timeLeft;
              if (timeLeft === 0) {
                clearInterval(cinterval);
                document.location.href = "index.php"
              }
            };
            cinterval = setInterval(timeDec, 1000);
          })();
        </script>

        Sie werden in <span id="countdown">5</span> Sekunden zur Startseite weitergeleitet.
        <br><br>

        Falls Sie nicht weitergeleitet werden, drücken Sie bitte auf diesen
        <a href="./index.php" class="link-primary">Link.</a>

      </div>
      <div class="col">

      </div>
    </div>
  </div>

  <?php include "Commons/footer.php"; ?>

</body>

</html>