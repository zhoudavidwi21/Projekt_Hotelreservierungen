<?php include "./Commons/sessions.php"; ?>
<?php
if($_SESSION['role'] === "guest"){
    header('location: ./error.php');
    exit();
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
</head>

<body>
    <?php include "Commons/header.php"; ?>

    <div class="text-center container-fluid">
    <h2>Hallo
        <?php echo $_SESSION["username"]; ?>!
    </h2>
    <form method="POST">
        <input type="hidden" name="logout" value="true">
        <button class="btn btn-sonstige">Logout</button>
    </form>
    </div>
</body>

</html>