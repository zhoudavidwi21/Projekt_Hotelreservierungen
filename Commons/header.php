<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap implementation -->
  <?php include "./Commons/bootstrap.php" ?>
  <!-- Template buttons -->
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
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Startseite</a>
          </li>

          <!-- Menü für alle Personen START -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Menü
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="kulinarik.php">Restaurant/Kulinarik</a></li>
              <li><a class="dropdown-item" href="zimmer_ansehen.php">Zimmer ansehen</a></li>
              <li><a class="dropdown-item" href="newsbeitraege.php">Newsbeiträge ansehen</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="datenschutz.php">Datenschutz</a></li>
              <li><a class="dropdown-item" href="agbs.php">AGBs</a></li>
              <li><a class="dropdown-item" href="hilfe_faqs.php">Hilfe/FAQs</a></li>
              <li><a class="dropdown-item" href="./impressum.php">Impressum</a></li>
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
          <li><a class="dropdown-item" href="zimmer_reservieren.php">Zimmer reservieren</a></li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <?php if ($_SESSION['role'] === "admin") { ?>
          <li><a class="dropdown-item" href="newsbeitraege_erstellen.php">Newsbeiträge erstellen</a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <?php } ?>

          
          <li>
            <form method="POST">
              <button class="dropdown-item" name="logout" value="true">Logout</button>
            </form>
          </li>
        </ul>
      </div>
      <!-- Menü für eingeloggte Personen END-->
      <?php } else { ?>
      <div class="d-flex gap-1">
        <a class="btn btn-anmelden" href="login.php" role="button">anmelden</a>
        <a class="btn btn-registrieren" href="register.php" role="button">registrieren</a>
      </div>
      <?php } ?>

    </div>

  </nav>


</body>

</html>