<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Header</title>

      <!-- Template background -->
  <link rel="stylesheet" href="css_Daten/button.css">
</head>

<body>

  <!-- Header - Navbar -->
  <nav class="navbar navbar-expand-sm">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">
        <img src="../Images/Kastanie_transparent.png" alt="Kastanie Logo" width="77" height="57">
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
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Menü
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="register.php">registrieren</a></li>
              <li><a class="dropdown-item" href="login.php">anmelden</a></li>
              <li><a class="dropdown-item" href="reservieren.php">Zimmer reservieren</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="kulinarik.php">Restaurant/Kulinarik</a></li>
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
          <li class="nav-item">
            <a class="nav-link disabled">Disabled</a>
          </li>
        </ul>
        <div class="d-flex gap-1">
          <a class="btn btn-primary btn-brown" href="login.php" role="button">anmelden</a>
          <a class="btn btn-brown-outline btn-outline-primary" href="register.php" role="button">registrieren</a>

        </div>

        <!--        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        -->
      </div>
    </div>
  </nav>

    
</body>
</html>