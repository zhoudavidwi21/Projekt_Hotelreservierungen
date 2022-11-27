<?php include "./Commons/sessions.php"; ?>

<?php
//Zur Ausgabe von den Session Parametern:
/* echo "<pre>";
print_r($_SESSION);
"</pre>"; */
//--------------------------------------------

//Nur uneingeloggte User können auf Login zugreifen
if ($_SESSION['role'] !== "guest") {
  header('location: ./error.php');
  exit();
}

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
    header('Location: ./profil.php');
  } elseif (
    isset($_POST["username"])
    && isset($_POST["password"])
    && (
      $_POST["username"] === "user"
      && $_POST["password"] === "user"
    )
  ) {
    $_SESSION["username"] = $_POST["username"];
    $_SESSION["role"] = "user";
    header('Location: ./profil.php');
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Anmeldung</title>
</head>

<body>

  <?php include "Commons/header.php"; ?>

  <div class="text-center container-fluid">
    <div class="row">
      <div class="col">
      </div>
      <div class="col-sm-6 col-md-5 col-lg-3">

        <main class="form-signin w-100 m-auto">
          <?php if (!isset($_SESSION["username"])) { ?>
          <form method="POST">
            <img class="mb-4" src="./Images/Kastanie_transparent.png" alt="Kastanien Logo" width="144" height="114">
            <h1 class="h3 mb-3 fw-normal">Bitte hier anmelden ...</h1>


            <div class="form-floating">
              <input type="text" class="form-control has-validation
              <?php if (isset($_POST['username']) && $_SESSION['role'] === 'guest') {
              echo "is-invalid";
            } ?>" id="floatingInput" placeholder="Benutzername" name="username">
              <label for="floatingInput">Benutzername</label>

            </div>
            <div class="form-floating">
              <input type="password" class="form-control has-validation
              <?php if (isset($_POST['username']) && $_SESSION['role'] === 'guest') {
              echo "is-invalid";
            } ?>" id="floatingPassword" placeholder="Passwort" name="password" aria-describedby="validationLogin">
              <label for="floatingPassword">Passwort</label>
              <div id="validationLogin" class="invalid-feedback">
                Benutzername und Passwort stimmen nicht überein.
              </div>
            </div>

            <div class="checkbox mt-3 mb-3">
              <label>
                <input type="checkbox" value="remember-me"> Angaben speichern
              </label>
            </div>

            <div class="d-grid gap-1">
              <!-- <div class="d-grid gap-1 col-6 mx-auto"> - kleiner und zentriert, geht auch mit m-auto -->
              <button class="w-100 btn btn-lg btn-anmelden" type="submit">anmelden</button>
              <a class="w-100 btn btn-lg btn-registrieren" href="./register.php" role="button">registrieren</a>
            </div>
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