<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Newsbeiträge erstellen</title>

  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

  <!-- Template background -->
  <link rel="stylesheet" href="css_Daten/background.css">

</head>

<body>

  <?php include "Commons/header.php"; ?>

  <?php
  $uploadDir = "uploads/";
  //$file = $_FILES["file"];

  if (!file_exists($uploadDir)) {
    mkdir($uploadDir);
  }

  //echo "<pre>";print_r($_FILES);"</pre";

  //$testupload = move_uploaded_file($file["tmp_name"])

  if (
    $_SERVER["REQUEST_METHOD"] === "POST"
    && isset($_FILES["file"])
  ) {
    if (move_uploaded_file(
      $_FILES["file"]["tmp_name"],
      $uploadDir . $_FILES["file"]["name"]
    )) {
      echo "Datei wurde erfolgreich\n hochgeladen!";
      echo "<br>";
    } else {
      echo "Fehler beim Upload!\n";
    }
  }

  //move_uploaded_file($file["tmp_name"], "uploads/".$file["name"]);

  ?>

  <div class="text-center container-fluid">
    <div class="row">
      <div class="col">
      </div>
      <div class="col-3">

        <h1>Newsbeiträge erstellen</h1>
        <img src="Images/Kastanie_transparent.png" alt="" width="144" height="114">

        <h4><label for="file">Bitte hier Daten hochladen</label></h4>
        <form enctype="multipart/form-data" method="POST">
          <input type="file" id="file"><br>
          <button class="w-100 btn btn-lg btn-primary btn-brown" type="submit">Upload</button>
        </form>
        
        <div style="text-align: left">
        <p><h5>Vorhandene Dateien:</h5></p>
        <ul>

          <?php
          if (file_exists($uploadDir)) {
            $files = scandir($uploadDir);
            //          echo "<pre>";print_r($files);"</pre>";
            //          0 und 1 überspringen, da (. und ..)
            //          i = 2; $i < $files.length; $i++
            for ($i = 2; isset($files[$i]); $i++) {
              echo "<li>" . $files[$i] . "</li>";
            }
            if (count($files) == 2) {
              echo "<li>Keine Files vorhanden ...</li>";
            }
          }
          ?>

        </ul>
        </div>

      </div>
      <div class="col">

      </div>
    </div>
  </div>

  <?php include "Commons/footer.php"; ?>

</body>

</html>