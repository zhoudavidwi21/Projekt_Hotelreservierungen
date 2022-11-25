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

  <title>Registrierung</title>
</head>

<body>

  <?php include "Commons/header.php"; ?>

  <div class="text-center container-fluid">
    <div class="row">
      <div class="col">
      </div>
      <div class="col-sm-6 col-md-5 col-lg-3">

        <main class="form-signin w-100 m-auto">
          <form>

            <img class="mb-4" src="./Images/\Kastanie_transparent.png" alt="" width="144" height="114">

            <h1 class="h3 mb-3 fw-normal">Bitte hier registrieren ...</h1>
            <p>* Eingabe erforderlich</p>

            <div class="mb-1">
              <!-- <label for="anrede">Anrede *</label> -->
              <select class="form-select" aria-label="Default select example" id="anrede" name="anrede">
                <option selected>Anrede auswählen *</option>
                <option value="firma">Firma</option>
                <option value="herr">Herr</option>
                <option value="frau">Frau</option>
                <option value="divers">Divers</option>
              </select>
            </div>
            <div class="form-floating">
              <input type="text" class="form-control" id="firmenname" placeholder="xyz GmbH" name="company">
              <label for="firmenname">Firmenname (optional)</label>
            </div>
            <div class="form-floating">
              <input type="text" class="form-control" id="vorname" placeholder="Vorname" name="firstname" required>
              <label for="vorname">Vorname *</label>
            </div>
            <div class="form-floating">
              <input type="text" class="form-control" id="nachname" placeholder="Nachname" name="lastname" required>
              <label for="nachname">Nachname *</label>
            </div>
            <div class="form-floating">
              <input type="email" class="form-control" id="email" placeholder="E-Mail Adresse" name="email" required>
              <label for="email">E-Mail Adresse *</label>
            </div>
            <div class="form-floating">
              <input type="text" class="form-control" id="benutzername" placeholder="Benutzername" name="username"
                required>
              <label for="benutzername">Benutzername *</label>
            </div>
            <br>
            <div class="form-floating">
              <input type="password" class="form-control" id="password" placeholder="Passwort" name="password" required>
              <label for="password">Passwort *</label>
            </div>
            <div class="form-floating">
              <input type="password" class="form-control" id="passwordWiederholen" placeholder="Password wiederholen"
                required>
              <label for="passwordWiederholen">Passwort wiederholen *</label>
            </div>
            <div class="checkbox mt-3 mb-3">
              <label>
                <!-- value="remember me" notwendig? -->
                <input type="checkbox" name="Datenschutz" id="Datenschutz" required>
                <label for="Datenschutz"><a href="datenschutz.html">Datenschutz</a> aktzeptieren *</label>
                <br>
                <input type="checkbox" name="AGBs" id="AGBs" required>
                <label for="AGBs"><a href="agbs.html">AGBs</a> aktzeptieren *</label>
              </label>
            </div>

            <div class="d-grid gap-1">
              <!-- <div class="d-grid gap-1 col-6 mx-auto"> - kleiner und zentriert, geht auch mit m-auto -->
              <button class="w-100 btn btn-lg btn-primary btn-brown" type="submit"
                formaction="register_confirmed.php">registrieren</button>

              <button class="w-100 btn btn-lg btn-outline-primary btn-brown-outline" type="reset">Eingaben
                löschen</button>
            </div>

          </form>
        </main>

      </div>
      <div class="col">

      </div>
    </div>
  </div>

  <?php include "Commons/footer.php"; ?>


</body>


</html>