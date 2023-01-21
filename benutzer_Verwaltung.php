<?php include "./Commons/sessions.php"; ?>

<?php require_once('db/dbaccess.php'); ?>

<?php
//Nur Admins können Benutzer verwalten
if (isset($_SESSION['role']) && $_SESSION['role'] !== "admin") {
  header('location: ./error.php');
  exit();
}
?>

<?php
$db_obj = new mysqli($host, $dbUser, $dbPassword, $database);

//Überprüfung ob Verbindung erfolgreich
if ($db_obj->connect_error) {
  echo 'Connection error: ' . $db_obj->connect_error;
  exit();
}
?>

<!-- Benutzer anzeigen -->
<div class="text-center container-fluid">
  <div class="row justify-content-md-center">
    <div class="col-sm-6 col-md-5 col-lg-4">
      <img class="mb-4" src="./Images/Kastanie_transparent.png" alt="Kastanien Logo" width="144" height="114">

      <h1 class="h3 mb-3 fw-normal">Benutzer verwalten</h1>

      <form action="">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">User ID</th>
              <th scope="col">Anrede</th>
              <th scope="col">Firmenname</th>
              <th scope="col">Vorname</th>
              <th scope="col">Nachname</th>
              <th scope="col">Benutzername</th>
              <th scope="col">Email</th>
              <th scope="col">Rolle</th>
              <th scope="col">Status</th>
              <th scope="col">Funktionen</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">4</th>
              <td>Herr</td>
              <td></td>
              <td>Frank</td>
              <td>Watson</td>
              <td>watsonFra</td>
              <td>frankWatson@gmail.com</td>
              <td>user</td>
              <td>Aktiv</td>
              <td>
                <a href="index.php?site=benutzer_bearbeiten&userId=4" class="btn btn-sonstige">Bearbeiten</a>
              </td>
              <td>
                <button type="button" class="btn btn-sonstige" data-bs-toggle="modal"
                  data-bs-target="#confirmDelete">Deaktivieren</button>
              </td>
              <td>
                <a href="index.php?site=reservierung&userId=4" class="btn btn-sonstige">Reservierungen anzeigen</a>
              </td>
            </tr>
          </tbody>
        </table>
      </form>

    </div>
  </div>
</div>

<div class="modal" id="confirmDelete" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Benutzer deaktivieren</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Sind Sie sich sicher, dass Sie den Benutzer deaktivieren wollen?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Nein</button>
        <button type="button" class="btn btn-primary">Ja</button>
      </div>
    </div>
  </div>
</div>

<!-- Benutzer verwalten -->