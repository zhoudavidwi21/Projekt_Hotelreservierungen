<?php
session_start(); //muss zu beginn von jeder session stehen
//Zur Ausgabe von den Session Parametern:
/* echo "<pre>";
print_r($_SESSION);
"</pre>"; */
//--------------------------------------------

//Login hardcoded Rolle Admin
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  if (
    isset($_POST["username"])
    && isset($_POST["password"])
    && (
      $_POST["username"] === "admin"
      && $_POST["password"] === "admin"
    )
  ) {
    $_SESSION["username"] = $_POST["username"];
    $_SESSION["role"] = "admin";
  }
}

if (
  $_SERVER["REQUEST_METHOD"] === "POST" 
  && isset($_POST["logout"]) 
  && $_POST["logout"] === "true"
){
  session_unset();
  session_destroy();
  header("Location:" .$_Server["HTTP_REFERER"]);
  $_SESSION = array();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
    crossorigin="anonymous"></script>
  <title>Anmeldung</title>

  <!-- Template background -->
  <link rel="stylesheet" href="css_Daten/background.css">


</head>

<body>

  <?php include "Commons/header.php"; ?>

  <div class="text-center container-fluid">
    <div class="row">
      <div class="col">
      </div>
      <div class="col-3">

        <main class="form-signin w-100 m-auto">
          <?php if (!isset($_SESSION["username"])) { ?>
          <form method="POST">
            <img class="mb-4" src="./Images/\Kastanie_transparent.png" alt="" width="144" height="114">
            <h1 class="h3 mb-3 fw-normal">Bitte hier anmelden ...</h1>

            <div class="form-floating">
              <input type="text" class="form-control" id="floatingInput" placeholder="Benutzername" name="username">
              <label for="floatingInput">Benutzername</label>
            </div>
            <div class="form-floating">
              <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
              <label for="floatingPassword">Passwort</label>
            </div>

            <div class="checkbox mt-3 mb-3">
              <label>
                <input type="checkbox" value="remember-me"> Angaben speichern
              </label>
            </div>

            <div class="d-grid gap-1">
              <!-- <div class="d-grid gap-1 col-6 mx-auto"> - kleiner und zentriert, geht auch mit m-auto -->
              <button class="w-100 btn btn-lg btn-primary btn-brown" type="submit">anmelden</button>
              <a class="w-100 btn btn-lg btn-outline-primary btn-brown-outline" href="./register.php"
                role="button">registrieren</a>
            </div>
          </form>
          <?php } else { ?>
          <h2>Hello
            <?php echo $_SESSION["username"]; ?>
          </h2>
          <form method="POST">
            <input type="hidden" name="logout" value="true">
            <button>Logout</button>
          </form>
          <?php } ?>
        </main>

      </div>
      <div class="col">

      </div>
    </div>
  </div>

  <?php include "Commons/footer.php"; ?>

</body>

</html>