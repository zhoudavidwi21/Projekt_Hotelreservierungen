<?php
ob_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap implementation -->
  <?php include "Commons/bootstrap.php" ?>
  <!-- Template but./tons -->
  <link rel="stylesheet" href="css_Daten/button.css">
  <!-- Template background -->
  <link href="./css_Daten/background.css" rel="stylesheet">

  <title>Header</title>
</head>

<body>

  <!-- Header - Navbar -->
  <nav class="navbar navbar-expand-sm">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">
        <img src="Images\Kastanie_transparent.png" alt="Kastanie Logo" width="77" height="57">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Startseite</a>
          </li>

          <!-- Menü für alle Personen START -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Menü
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="index.php?site=unsere_geschichte">Unsere Geschichte</a></li>
              <li><a class="dropdown-item" href="index.php?site=newsbeitraege">Newsbeiträge ansehen</a></li>
              <li><a class="dropdown-item" href="index.php?site=kulinarik">Restaurant/Kulinarik</a></li>
              <li><a class="dropdown-item" href="index.php?site=zimmer_ansehen">Zimmer ansehen</a></li>
              <li><a class="dropdown-item" href="index.php?site=wellness">Wellness</a></li>
              <li><a class="dropdown-item" href="index.php?site=impressionen">Impressionen</a></li>

              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="index.php?site=datenschutz">Datenschutz</a></li>
              <li><a class="dropdown-item" href="index.php?site=agbs">AGBs</a></li>
              <li><a class="dropdown-item" href="index.php?site=hilfe_faqs">Hilfe/FAQs</a></li>
              <li><a class="dropdown-item" href="index.php?site=impressum">Impressum</a></li>
            </ul>
          </li>
          <!-- Menü für alle Personen END-->

      </div>
      <?php if (isset($_SESSION['role']) && ($_SESSION['role'] === "user" || $_SESSION['role'] === "admin")) { ?>

        <!-- Menü für eingeloggte Personen START-->
        <div class="d-flex gap-1 dropdown">
          <button class="btn btn-anmelden dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php echo $_SESSION['username']; ?>
          </button>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="index.php?site=profil_bearbeiten">Profil bearbeiten</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="index.php?site=zimmer_reservieren">Zimmer reservieren</a></li>

            <li><a class="dropdown-item" href="index.php?site=zimmer_reservieren_ansehen">Meine Reservierungen ansehen</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <?php if ($_SESSION['role'] === "admin") { ?>
              <li><a class="dropdown-item" href="index.php?site=admin_benutzer_Verwaltung">Benutzer verwalten</a></li>

              <li><a class="dropdown-item" href="index.php?site=admin_zimmer_reservieren_Verwaltung">Reservierungen verwalten</a></li>

              <li><a class="dropdown-item" href="index.php?site=newsbeitraege_erstellen">Newsbeiträge erstellen</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
            <?php } ?>

            <li><a class="dropdown-item" href="Commons/logout.php">Logout</a></li>

          </ul>
        </div>
        <!-- Menü für eingeloggte Personen END-->
      <?php } else { ?>
        <div class="d-flex gap-1">
          <a class="btn btn-anmelden" href="index.php?site=login" role="button">anmelden</a>
          <a class="btn btn-registrieren" href="index.php?site=register" role="button">registrieren</a>
        </div>
      <?php } ?>

    </div>

  </nav>


</body>

</html>