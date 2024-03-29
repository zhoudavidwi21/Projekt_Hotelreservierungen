<?php include "Commons/sessions.php"; ?>

<?php include "Commons/register_validation.php"; ?>

<?php require_once('db/dbaccess.php'); ?>

<?php
if (isset($_POST["submit"])) {
  if (
    $genderErr == "" && $companyErr == "" && $firstnameErr == "" && $lastnameErr == "" && $emailErr == "" && $usernameErr == ""
    && $passwordErr == "" && $passwordCheckErr == "" && $agreeDatenschutzErr == "" && $agreeAgbsErr == ""
  ) {
    //Funktion kommt nur hier rein wenn keine Fehler aufgetreten sind
    //Datenbankverbindung erstellt
    $db_obj = new mysqli($host, $dbUser, $dbPassword, $database);
    if ($db_obj->connect_error) {
      echo 'Connection error: ' . $db_obj->connect_error;
      exit();
    }
    $sql = "INSERT INTO `users`
    (`username`, `email`, `password`, `gender`, `companyName`, `firstName`, `lastName`) 
    VALUES (?, ?, ?, ?, ?, ?, ?)";

    //Passwort hashen
    $password = password_hash($password, PASSWORD_DEFAULT);

    //SQL-Statement erstellen
    $stmt = $db_obj->prepare($sql);

    $stmt->bind_param("sssssss", $username, $email, $password, $gender, $company, $firstname, $lastname);

    if ($stmt->execute()) {
      //close the statement
      $stmt->close();
      //close the connection
      $db_obj->close();
      header('Refresh:0; url=index.php?site=register_confirmed');
      exit();
    } else {
      echo '<p class="red"> Registrierung fehlgeschlagen! </p>';
    }
  } else {
    $_SESSION['regGender'] = $gender;
    $_SESSION['regCompany'] = $company;
    $_SESSION['regFirstname'] = $firstname;
    $_SESSION['regLastname'] = $lastname;
    $_SESSION['regUsername'] = $username;
  }
}
?>

<div class="text-center container-fluid">
  <div class="row justify-content-md-center">

    <div class="col-sm-6 col-md-5 col-lg-4">

      <main class="form-signin w-100 m-auto">

        <img class="mb-4" src="./Images/Kastanie_transparent.png" alt="Kastanien Logo" width="144" height="114">

        <h1 class="h3 mb-3 fw-normal">Bitte hier registrieren ...</h1>
        <p>* Eingabe erforderlich</p>

        <hr class="featurette-divider">

        <form method="POST">
          <div class="mb-1">
            <label for="anrede" hidden>Anrede *</label>
            <select class="form-select has-validation
                <?php validityClass($genderErr, "gender"); ?>" aria-label="Default select example" id="anrede" name="gender" aria-describedby="validationGender">
              <option value="" <?php if ($_SESSION['regGender'] == "") {
                                  echo 'selected';
                                } ?>>Anrede auswählen *
              </option>
              <option value="firma" <?php if ($_SESSION['regGender'] == "firma") {
                                      echo 'selected';
                                    } ?>>Firma</option>
              <option value="herr" <?php if ($_SESSION['regGender'] == "herr") {
                                      echo 'selected';
                                    } ?>>Herr</option>
              <option value="frau" <?php if ($_SESSION['regGender'] == "frau") {
                                      echo 'selected';
                                    } ?>>Frau</option>
              <option value="divers" <?php if ($_SESSION['regGender'] == "divers") {
                                        echo 'selected';
                                      } ?>>Divers</option>
            </select>
            <?php invalidFeedback($genderErr, "validationGender"); ?>
          </div>

          <div class="form-floating">
            <input type="text" class="form-control has-validation
              <?php validityClass($companyErr, "company"); ?>" id="firmenname" placeholder="xyz GmbH" name="company" aria-describedby="validationCompany" value="<?php echo $_SESSION['regCompany']; ?>">
            <label for="firmenname">Firmenname (optional)</label>
            <?php invalidFeedback($companyErr, "validationCompany"); ?>
          </div>

          <div class="form-floating">
            <input type="text" class="form-control has-validation
              <?php validityClass($firstnameErr, "firstname"); ?>" id="vorname" placeholder="Vorname" name="firstname" aria-describedby="validationFirstname" value="<?php echo $_SESSION['regFirstname']; ?>" required>
            <label for="vorname">Vorname *</label>
            <?php invalidFeedback($firstnameErr, "validationFirstname"); ?>
          </div>

          <div class="form-floating">
            <input type="text" class="form-control has-validation
              <?php validityClass($lastnameErr, "lastname"); ?>" id="nachname" placeholder="Nachname" name="lastname" aria-describedby="validationLastname" value="<?php echo $_SESSION['regLastname']; ?>" required>
            <label for="nachname">Nachname *</label>
            <?php invalidFeedback($lastnameErr, "validationLastname"); ?>
          </div>

          <div class="form-floating">
            <input type="email" class="form-control has-validation
              <?php validityClass($emailErr, "email"); ?>" id="email" placeholder="E-Mail Adresse" name="email" aria-describedby="validationEmail" required>
            <label for="email">E-Mail Adresse *</label>
            <?php invalidFeedback($emailErr, "validationEmail"); ?>
          </div>

          <div class="form-floating">
            <input type="text" class="form-control has-validation
              <?php validityClass($usernameErr, "username"); ?>" id="benutzername" placeholder="Benutzername" name="username" aria-describedby="validationUsername" value="<?php echo $_SESSION['regUsername']; ?>" required>
            <label for="benutzername">Benutzername *</label>
            <?php invalidFeedback($usernameErr, "validationUsername"); ?>
          </div>

          <br>

          <div class="form-floating">
            <input type="password" class="form-control has-validation
              <?php validityClass($passwordErr, "password"); ?>" id="password" placeholder="Passwort" name="password" aria-describedby="validationPassword" required>
            <label for="password">Passwort *</label>
            <?php invalidFeedback($passwordErr, "validationPassword"); ?>
          </div>

          <div class="form-floating">
            <input type="password" class="form-control has-validation 
              <?php validityClass($passwordCheckErr, "passwordCheck"); ?>" id="passwortWiederholen" placeholder="Passwort wiederholen" name="passwordCheck" aria-describedby="validationPasswordCheck" required>
            <label for="passwortWiederholen">Passwort wiederholen *</label>
            <?php invalidFeedback($passwordCheckErr, "validationPasswordCheck"); ?>
          </div>

          <div class="checkbox mt-3 mb-3">
            <input type="checkbox" class="form-check-input has-validation
              <?php validityClass($agreeDatenschutzErr, "datenschutz"); ?>" name="datenschutz" id="Datenschutz" value="checked" aria-describedby="validationDatenschutz" required>
            <label class="form-check-label" for="Datenschutz"><a href="index.php?site=datenschutz" target="_blank">Datenschutz</a> akzeptieren *</label>
            <?php invalidFeedback($agreeDatenschutzErr, "validationDatenschutz"); ?>

            <br>

            <input type="checkbox" class="form-check-input has-validation
              <?php validityClass($agreeAgbsErr, "agbs"); ?>" name="agbs" id="AGBs" value="checked" aria-describedby="validationAgbs" required>
            <label class="form-check-label" for="AGBs"><a href="index.php?site=agbs" target="_blank">AGBs</a>
              akzeptieren *</label>
            <?php invalidFeedback($agreeAgbsErr, "validationAgbs"); ?>
          </div>

          <div class="d-grid gap-1">
            <!-- <div class="d-grid gap-1 col-6 mx-auto"> - kleiner und zentriert, geht auch mit m-auto -->
            <button class="w-100 btn btn-lg btn-registrieren" type="submit" name="submit" value="true">registrieren</button>
          </div>

        </form>


      </main>
    </div>
  </div>
</div>