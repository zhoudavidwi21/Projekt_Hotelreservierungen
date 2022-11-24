<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  <title>Registrierung</title>

  <!-- Template background -->
  <link rel="stylesheet" href="css_Daten/background.css">

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
              <select class="form-select" aria-label="Default select example" id="anrede">
                <option selected>Anrede auswählen *</option>
                <option value="firma">Firma</option>
                <option value="herr">Herr</option>
                <option value="frau">Frau</option>
                <option value="divers">Divers</option>
              </select>
            </div>
            <div class="form-floating">
              <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
              <label for="floatingInput">Firmenname (optional)</label>
            </div>
            <div class="form-floating">
              <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" required>
              <label for="floatingInput">Vorname *</label>
            </div>
            <div class="form-floating">
              <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" required>
              <label for="floatingInput">Nachname *</label>
            </div>
            <div class="form-floating">
              <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
              <label for="floatingInput">E-Mail Addresse *</label>
            </div>
            <div class="form-floating">
              <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" required>
              <label for="floatingInput">Benutzername *</label>
            </div>
            <br>
            <div class="form-floating">
              <input type="password" class="form-control" id="floatingPassword" placeholder="Password" required>
              <label for="floatingPassword">Passwort *</label>
            </div>
            <div class="form-floating">
              <input type="password" class="form-control" id="floatingPassword" placeholder="Password" required>
              <label for="floatingPassword">Passwort wiederholen *</label>
            </div>
            <div class="checkbox mt-3 mb-3">
              <label>
                <!-- value="remember me" notwendig? -->
                <input type="checkbox" name="Datenschutz" id="Datenschutz" value="remember-me" required>
                <label for="Datenschutz"><a href="datenschutz.html">Datenschutz</a> aktzeptieren *</label>
                <br>
                <input type="checkbox" name="AGBs" id="AGBs" required>
                <label for="AGBs"><a href="agbs.html">AGBs</a> aktzeptieren *</label>
              </label>
            </div>

            <div class="d-grid gap-1">
              <!-- <div class="d-grid gap-1 col-6 mx-auto"> - kleiner und zentriert, geht auch mit m-auto -->
              <button class="w-100 btn btn-lg btn-primary btn-brown" type="submit" formaction="register_confirmed.php">registrieren</button>

              <button class="w-100 btn btn-lg btn-outline-primary btn-brown-outline" type="reset">Eingaben löschen</button>
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