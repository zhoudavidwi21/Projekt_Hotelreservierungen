<?php include "./Commons/sessions.php"; ?>

<?php
//Nur Admins können Newsbeiträge erstellen
if (isset($_SESSION['role']) && $_SESSION['role'] === "guest") {
  header('location: ./error.php');
  exit();
}
?>

  <div class="text-center container-fluid">
    <div class="row">
      <div class="col">
      </div>
      <div class="col-10">

        <h1>Zimmer reservieren</h1>
        <img src="Images/Kastanie_transparent.png" alt="" width="144" height="114">

        <p>
          In Arbeit !!!
        </p>

      </div>
      <div class="col">
      </div>
    </div>
  </div>