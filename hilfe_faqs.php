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
    
  <title>Hilfe/FAQs</title>
</head>


<body>

  <?php include "Commons/header.php"; ?>

  <div class="text-center container-fluid">
    <div class="row">
      <div class="col">
      </div>
      <div class="col-10">

        <h1>Hilfe/FAQs</h1>
        <h2>Anleitungen:</h2>
        <p>
          Wie registriere ich mich? <br>
          Alle mit * markierten Felder müssen eingeben werden. <br><br>
          Wie logge ich mich ein? <br>
          Mit Username und Passwort können Sie sich jederzeit auf unserer Seite einloggen.
        </p>


        <h2>FAQs:</h2>
        <p>
          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, veritatis esse. Ipsa deleniti nostrum corporis
          odit enim praesentium aspernatur maiores reiciendis qui et, atque, natus repellendus, modi porro eum velit.
        </p>

      </div>
      <div class="col">

      </div>
    </div>
  </div>

  <?php include "Commons/footer.php"; ?>

</body>

</html>