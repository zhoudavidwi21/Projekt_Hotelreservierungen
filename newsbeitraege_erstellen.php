<?php include "./Commons/sessions.php"; ?>
<?php
//Nur Admins können Newsbeiträge erstellen
if (isset($_SESSION['role']) && $_SESSION['role'] !== "admin") {
  header('location: ./error.php');
  exit();
}
?>

<?php
//Post Newsbeiträge nur wenn mind. Titel und Text vorhanden
$titleErr = $fileErr = $bodyErr = "";
$title = $file = $body = "";

if (
  $_SERVER["REQUEST_METHOD"] === "POST"
) {

  //Überprüfung ob Titel vorhanden
  if (empty($_POST['title'])) {
    $titleErr = '<p class="red">ACHTUNG - Bitte geben Sie einen Titel ein!</p>';
  } elseif (!preg_match('[<>]', $_POST['title'])) {
    $titleErr = '<p class="red">ACHTUNG - Titel erhält unzulässige Zeichen!</p>';
  } else {
    $title = htmlspecialchars($_POST['title']);
  }

  //Überprüfung ob Text vorhanden
  if (empty($_POST['body'])) {
    $bodyErr = "Bitte geben Sie einen Text ein!";
  } elseif (!preg_match('[<>]', $_POST['body'])) {
    $bodyErr = "Der Text erhält unzulässige Zeichen!";
  } else {
    $body = htmlspecialchars($_POST['body']);
  }
}

if (isset($_POST['submit']) && ($titleErr == "" && $fileErr == "" && $bodyErr == "")) {
  //header('Location: ./newsbeitraege.php');
  //exit();
}

$uploadDir = "Uploads/";
//$file = $_FILES["file"];

if (!file_exists($uploadDir)) {
  mkdir($uploadDir);
}
if (
  $_SERVER["REQUEST_METHOD"] === "POST"
  && isset($_FILES["file"])
) {

  //folgender Teil schränkt auf .gif,.jpeg,.jpg,.png ein
  $datei = $_FILES["file"]["name"];
  $dateityp = strtolower(pathinfo($datei, PATHINFO_EXTENSION));
  if (
    $dateityp != "gif" &&
    $dateityp != "jpeg" &&
    $dateityp != "jpg" &&
    $dateityp != "png"
  ) {
    $fileErr = "<p class='red'> ACHTUNG - es werden nur Bilddateien mit *.gif, *.jpeg, *.jpg oder *.png akzeptiert! </p><br />";
  } else {
    //folgender Teil schränkt auf Größe ein
    if ($_FILES['file']['size'] > 10000000) {
      $fileErr = "<p class='red'> ACHTUNG - Datei zu groß - max. 10 MByte sind erlaubt! </p>";
    } else {
      //folgender Teil überprüft, ob Datei schon vorhanden ist
      if (file_exists($uploadDir . $_FILES["file"]["name"])) {
        $fileErr = "<p class='red'> ACHTUNG - diese Datei ist schon vorhanden! </p>";
      } else {
        if (
          move_uploaded_file(
            $_FILES["file"]["tmp_name"],
            $uploadDir . $_FILES["file"]["name"]
          )
        ) {
          echo "<p class='green'>Die Datei ";
          echo $_FILES["file"]["name"];
          echo " wurde erfolgreich hochgeladen! </p><br />";
          echo "<br>";
        } else {
          $fileErr = "<p class='green'> Fehler beim Hochladen! </p><br />";
        }
      }
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Newsbeiträge erstellen</title>

  <link href="./css_Daten/colors_MF.css" rel="stylesheet">
</head>

<body>

  <?php
  echo "<pre>";
  print_r($_POST);
  echo "</pre>";
  ?>

  <?php include "Commons/header.php"; ?>

  

  <div class="text-center container-fluid">
    <div class="row">
      <div class="col">
      </div>
      <div class="col-sm-6 col-md-5 col-lg-3">

        <h1>Newsbeiträge erstellen</h1>
        <img src="Images/Kastanie_transparent.png" alt="" width="144" height="114">

        <form enctype="multipart/form-data" method="POST">
          <div class="d-grid gap-1">
            <div class="mb-3">
              <label for="title" class="form-label" hidden>Titel</label>
              <input type="text" class="form-control" name="title" id="title" placeholder="Titel" required>
              <?php if (!empty($titleErr)) {
                echo $titleErr;} ?>
            </div>

            <div>
              <label for="file" class="form-label">
              </label>
              <input class="form-control" type="file" id="file" name="file" accept="image/*">
              <?php if (!empty($fileErr)) {
                echo $fileErr;} ?>
              <p class="fw-lighter">
                Die Bilder (Format *.gif,*.jpeg, *.jpg oder *.png) mit einer maximalen Dateigröße von 10 MByte und im
                quadratischen Format (z.B. 600x600 Pixel) hochladen, da es sonst bei Thumbnails und anderen Bild-Größen
                zu
                Verzerrungen kommen kann.
              </p>
            </div>

            <div class="mb-3">
              <label for="body" class="form-label" hidden>Beitrag</label>
              <textarea class="form-control" id="body" name="body" rows="5"
                placeholder="Fügen Sie hier Ihren Beitrag hinzu." required></textarea>
                <?php if (!empty($bodyErr)) {
                echo $bodyErr;} ?>
            </div>

            <button class="w-100 btn btn-lg btn-sonstige" type="submit" name="submit" value="true">Beitrag
              erstellen</button>
          </div>
        </form>



      </div>
      <div class="col">

      </div>
    </div>
  </div>

  <?php include "Commons/footer.php"; ?>

</body>

</html>