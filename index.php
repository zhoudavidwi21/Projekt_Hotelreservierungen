<?php include "./Commons/sessions.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Startseite</title>
  <link rel="icon" type="image/x-icon" href="/Images/Kastanie_transparent_ico.ico">

</head>

<body>

  <?php include "./Commons/header.php"; ?>

  <main>

    <?php

    $path = '*.php';

    $validSites = glob($path);

    if (!isset($_GET['site'])) {
      include "startseite.php";
    } else {
      if (!in_array($_GET['site'] . '.php', $validSites)) {
        include "error.php";
      } else {
        $site = $_GET['site'];
        include "$site.php";
      }
    }


    ?>

  </main>

  <?php include "Commons/footer.php"; ?>


</body>

</html>