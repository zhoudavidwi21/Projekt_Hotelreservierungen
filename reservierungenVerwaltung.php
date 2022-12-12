<?php include "./Commons/sessions.php"; ?>
<?php
//Nur Admins können Reservierungen verwalten
if (isset($_SESSION['role']) && $_SESSION['role'] !== "admin") {
  header('location: ./error.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Reservierungen verwalten</title>

  <link href="./css_Daten/colors_MF.css" rel="stylesheet">

</head>

<body>

  <?php include "Commons/header.php"; ?>

  <!-- Reservierungen anzeigen -->

  <div class="text-center container-fluid">
    <div class="row">
      <div class="col">
      </div>
      <div class="col-10">

        <h1>Reservierungen verwalten</h1>
        <img src="Images/Kastanie_transparent.png" alt="" width="144" height="114">

        <p>
          In Arbeit !!!
        </p>

      </div>
      <div class="col">
      </div>
    </div>
  </div>
  <!-- Reservierungen verwalten -->


  <?php include "Commons/footer.php"; ?>

</body>

</html>