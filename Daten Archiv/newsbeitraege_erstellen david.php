<?php include "./Commons/sessions.php"; ?>
<?php
//Nur Admins können Newsbeiträge erstellen
if (isset($_SESSION['role']) && $_SESSION['role'] !== "admin") {
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

  <title>Newsbeiträge erstellen</title>

  <link href="./css_Daten/colors.css" rel="stylesheet">

</head>

<body>

  <?php include "Commons/header.php"; ?>

  <?php
  $uploadDir = "Uploads/";
  $thumbnailDir = "Uploads/Thumbnails/";
  //$file = $_FILES["file"];

  if (!file_exists($uploadDir)) {
    mkdir($uploadDir);
    if (!file_exists($uploadDir . $thumbnailDir)) {
      mkdir($uploadDir . $thumbnailDir);
    }
  }
  // echo "<pre>";print_r($_FILES);"</pre";

  //$testupload = move_uploaded_file($file["tmp_name"])

  if (
    $_SERVER["REQUEST_METHOD"] === "POST"
    && isset($_FILES["file"])
  ) {
    if (
      move_uploaded_file(
        $_FILES["file"]["tmp_name"],
        $uploadDir . $_FILES["file"]["name"]
      )
    ) {
      echo
      'Datei erfolgreich hochgeladen';
    } else {
      echo
      'Fehler beim Hochladen';
    }
  }

  //move_uploaded_file($file["tmp_name"], "uploads/".$file["name"]);

  ?>

  <div class="text-center container-fluid">
    <div class="row">
      <div class="col">
      </div>
      <div class="col-sm-6 col-md-5 col-lg-3">

        <h1>Newsbeiträge erstellen</h1>
        <img src="Images/Kastanie_transparent.png" alt="" width="144" height="114">

        <!--       <h4><label for="file">Bitte hier Daten hochladen</label></h4> -->
        <form enctype="multipart/form-data" method="POST">
          <div class="d-grid gap-1">
            <label for="file" class="form-label">
              <h4>Bitte hier Daten hochladen</h4>
            </label>
            <input class="form-control" type="file" id="file" name="file" accept="image/*">
            <p class="fw-lighter">
              Die Bilder bitte im quadratischen Format (z.B. 600x600 Pixel) hochladen, da es sonst bei Thumbnails und anderen Größen zu Verzerrungen kommen kann.
            </p>
            <button class="w-100 btn btn-lg btn-sonstige" type="submit">Upload</button>
          </div>
        </form>

        <div style="text-align: left">
          <p>
          <h5>Vorhandene Dateien:</h5>
          </p>
          <ul>
            <?php

            if (file_exists($uploadDir)) {
              $files = scandir($uploadDir);
              //          echo "<pre>";print_r($files);"</pre>";
              //          0 und 1 überspringen, da (. und ..)
              //          i = 2; $i < $files.length; $i++
              for ($i = 2; isset($files[$i]); $i++) {
                //               echo "<li>" . $files[$i] . "</li>";
              }
              if (count($files) == 2) {
                echo "Keine Files vorhanden ...";
                //                echo "<li>Keine Files vorhanden ...</li>";
                //                echo "<p class='red' <li>Keine Files vorhanden ...</li>";
              }
            }

            $uploadDir = openDir('Uploads/');
            while ($files = readDir($uploadDir)) {
              if ($files != "." && $files != "..") {
                echo "<a href=\"Uploads/$files\" target= blank>$files</a><br />";
                echo "-->";
                echo "<a href=\"Uploads/$files\"download>Download</a><br />";
                echo ("<br />");
              }
            }
            closeDir($uploadDir);

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