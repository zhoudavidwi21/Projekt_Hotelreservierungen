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
    <title>Test Seite</title>
</head>
<body>
    <?php include "./Commons/header.php"; ?>
    <?php echo '<h1> TEST </h1>'; ?>
</body>
</html>