<?php include "./Commons/sessions.php"; ?>
<?php
//Nur Admins können Benutzer verwalten
if (isset($_SESSION['role']) && $_SESSION['role'] !== "admin") {
  header('location: ./error.php');
  exit();
}


?>

  <!-- Benutzer anzeigen -->
  <div class="text-center container-fluid">
    <div class="row">
      <div class="col">
      </div>
      <div class="col-10">

        <h1>Benutzer verwalten</h1>
        <img src="Images/Kastanie_transparent.png" alt="" width="144" height="114">

        <p>
          In Arbeit !!!
        </p>

      </div>
      <div class="col">
      </div>
    </div>
  </div>
  <!-- Benutzer verwalten -->