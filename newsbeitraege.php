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

  <title>Newsbeiträge</title>
</head>

<body>

  <?php include "Commons/header.php"; ?>

  <div class="text-center container-fluid">
    <div class="row">
      <div class="col">
      </div>
      <div class="col-10">

        <h1>Newsbeiträge</h1>
        <img src="Images/Kastanie_transparent.png" alt="" width="144" height="114">

        <p>
          Inhalt fehlt noch !!!
        </p>

      </div>
      <div class="col">

      </div>
    </div>
  </div>

  <?php include "Commons/footer.php"; ?>

</body>

</html>