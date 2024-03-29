<?php include "./Commons/sessions.php"; ?>

<?php require_once('db/dbaccess.php'); ?>

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

//Login mit Datenbankabfrage
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  if (
    isset($_POST["username"])
    && isset($_POST["password"])
  ) {
    //Bereinigung der Eingabe, falls der Nutzer sich mit irgendwelchen besonderen Zeichen
    //registriert hat
    $_POST["username"] = trim(htmlspecialchars($_POST["username"]));

    //DB-Abfrage
    $db_obj = new mysqli($host, $dbUser, $dbPassword, $database);

    //Fehlermeldung bei DB-Verbindungsfehler
    if ($db_obj->connect_error) {
      echo 'Connection error: ' . $db_obj->connect_error;
      exit();
    }

    $sql = "SELECT * FROM `users` WHERE `username` = ? AND `deleted` = 0";
    $stmt = $db_obj->prepare($sql);
    $stmt->bind_param("s", $_POST["username"]);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
      echo "<div class='alert alert-danger' role='alert'>
       Dein Benutzername oder Passwort ist falsch.";
      $stmt->close();
      $db_obj->close();
    } else {
      //fetch_assoc returnt ein array als key-value-pair, 
      //fetch_array returnt potenziell ein array mit numerischen keys
      $row = $result->fetch_assoc();
      if (password_verify(trim($_POST["password"]), $row["password"])) {
        $_SESSION["userId"] = $row["userId"];
        $_SESSION["username"] = $row["username"];
        $_SESSION["role"] = $row["role"];
        $_SESSION['loginTime'] = time();
        $stmt->close();
        $db_obj->close();
        header('Location: ./index.php');
        exit();
      } else {
        echo "<div class='alert alert-danger' role='alert'>
        Dein Benutzername oder Passwort ist falsch.";
        $stmt->close();
        $db_obj->close();
      }
    }
  }
}

if (isset($_POST['remember']) && $_POST['remember'] == true) {
  $cookieDuration = 31536000; //valid for 1 year
  setcookie('userId', $_SESSION['userId'], time() + $cookieDuration, "/");
  setcookie('loginCookie', $cookieDuration, time() + $cookieDuration, "/");
}

?>

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
                <input type="checkbox" name="remember" value=true> Eingeloggt bleiben
              </label>
            </div>

            <div class="d-grid gap-1">
              <button class="w-100 btn btn-lg btn-anmelden" type="submit">anmelden</button>
              <a class="w-100 btn btn-lg btn-registrieren" href="index.php?site=register" role="button">registrieren</a>
            </div>
          </form>
        <?php } ?>
      </main>

    </div>
    <div class="col">
    </div>
  </div>
</div>