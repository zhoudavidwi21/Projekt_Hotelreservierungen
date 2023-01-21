<?php include "./Commons/sessions.php"; ?>

<?php require_once('db/dbaccess.php'); ?>

<?php
//Nur Admins können Newsbeiträge erstellen
if (isset($_SESSION['role']) && $_SESSION['role'] !== "admin") {
  header('Refresh:1; url=index.php?site=error');
  exit();
}
?>

<?php
$titleErr = $fileErr = $bodyErr = $altErr = "";
$title = $filepath = $body = $alt = "";


//Post Newsbeiträge nur wenn mind. Titel und Text vorhanden
if (
  $_SERVER["REQUEST_METHOD"] === "POST"
) {

  //Überprüfung ob Titel vorhanden
  if (empty($_POST['title'])) {
    $titleErr = '<p class="red">ACHTUNG - Bitte geben Sie einen Titel ein!</p>';
  } elseif (preg_match('/[\[<>]/', $_POST['title'])) {
    $titleErr = '<p class="red">ACHTUNG - Titel enthält unzulässige Zeichen!</p>';
  } else {
    $title = htmlspecialchars($_POST['title']);
  }

  //Überprüfung ob Text vorhanden
  if (empty($_POST['body'])) {
    $bodyErr = "Bitte geben Sie einen Text ein!";
  } elseif (preg_match('/[\[<>]/', $_POST['body'])) {
    $bodyErr = "Der Text enthält unzulässige Zeichen!";
  } else {
    $body = nl2br(htmlspecialchars($_POST['body']));
  }
}


$uploadDir = "Uploads/";
$thumbnailDir = "thumbnails/";
$thumbnailPath = $uploadDir . $thumbnailDir;
//Überprüfung ob Uploads Ordner existiert, wenn nicht wird er erstellt
if (!file_exists($uploadDir)) {
  mkdir($uploadDir);
}
if (!file_exists($thumbnailPath)) {
  mkdir($thumbnailPath, 0777, true);
}

//Erlaubte Dateiformate
$allowed = array('png', 'jpg', 'jpeg', 'gif');

//Überprüfung ob Datei hochgeladen wurde
if (
  $_SERVER["REQUEST_METHOD"] === "POST"
  && !empty($_FILES["file"]["name"])
) {

  $filename = $_FILES["file"]["name"];
  $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

  //folgender Teil überprüft, ob Datei vom richtigen Typ ist
  if (!in_array($ext, $allowed)) {
    $fileErr = "<p class='red'> ACHTUNG - es werden nur Bilddateien mit, *."
      . implode(", *.", $allowed) .
      " als Dateiendung akzeptiert! </p><br />";
  } else {
    //folgender Teil schränkt auf Größe ein
    if ($_FILES['file']['size'] > 10000000) {
      $fileErr = "<p class='red'> ACHTUNG - Datei zu groß - max. 10 MByte sind erlaubt! </p>";
    } else {
      //folgender Teil überprüft, ob Datei schon vorhanden ist
      if (file_exists($uploadDir . $_FILES['file']['name'])) {
        $fileErr = "<p class='red'> ACHTUNG - die Datei " . $filename . " ist schon vorhanden! </p>";
      } else {
        $filepath = $uploadDir . $filename;
        if (
          move_uploaded_file(
            $_FILES['file']['tmp_name'],
            $uploadDir . $_FILES['file']['name']
          )
          && createThumbnail($filename, $filepath, $ext, $thumbnailPath)
        ) {
          echo "<p class='green'>Die Datei ";
          echo $_FILES['file']['name'];
          echo " wurde erfolgreich hochgeladen! </p><br />";
          echo "<br>";
        } else {
          $fileErr = "<p class='red'> Fehler beim Hochladen! </p><br />";
        }
      }
    }
  }
}

//Überprüfung ob Alt-Text vorhanden wenn ein Bild hochgeladen wurde
if (
  $_SERVER["REQUEST_METHOD"] === "POST"
  && !empty(trim(($_FILES["file"]["name"])))
) {

  //Überprüfung ob Alt vorhanden
  if (empty($_POST['alt'])) {
    $altErr = '<p class="red">ACHTUNG - Bitte geben Sie einen Alt-Text ein!</p>';
  } elseif (preg_match('/[\[<>]/', $_POST['alt'])) {
    $altErr = '<p class="red">ACHTUNG - Alt-Text erhält unzulässige Zeichen!</p>';
  } else {
    $alt = htmlspecialchars($_POST['alt']);
  }
}

//Lädt die Daten auf die Datenbank hoch
if (isset($_POST['upload']) && ($titleErr == "" && $fileErr == "" && $bodyErr == "" && $altErr == "")) {

  $db_obj = new mysqli($host, $dbUser, $dbPassword, $database);
  if ($db_obj->connect_error) {
    echo 'Connection error: ' . $db_obj->connect_error;
    exit();
  }

  $sql = "INSERT INTO `news`(`title`, `body`, `file_path`, `alt`, `fk_userId`) VALUES (?, ?, ?, ?, ?)";

  $stmt = $db_obj->prepare($sql);

  $userId = $_SESSION['userId'];

  $stmt->bind_param("ssssi", $title, $body, $filepath, $alt, $userId);


  if ($stmt->execute()) {
    $stmt->close();
    $db_obj->close();
    header('Refresh:1; url=index.php?site=newsbeitraege');
    exit();
  } else {
    $stmt->close();
    $db_obj->close();
    echo "<p class='red'>Fehler bei der Übertragung in die Datenbank!</p>";
  }
}

//Funktion zum Erstellen von Thumbnails
//Benötigt GD Library freigeschaltet
function createThumbnail($filename, $filepath, $ext, $thumbnailPath)
{
  // Get new sizes
  list($width, $height) = getimagesize($filepath);
  $newwidth = 200;
  $newheight = 200;

  // Load
  $thumb = imagecreatetruecolor($newwidth, $newheight);

  switch ($ext) {
    case 'png':
      $source = imagecreatefrompng($filepath);
      break;
    case 'gif':
      $source = imagecreatefromgif($filepath);
      break;
    case 'jpeg' || 'jpg':
      $source = imagecreatefromjpeg($filepath);
      break;
  }

  // Resize
  imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

  // Output
  switch ($ext) {
    case 'png':
      return imagepng($thumb, $thumbnailPath . 'thumb_' . $filename);
    case 'gif':
      imagegif($thumb, $thumbnailPath . 'thumb_' . $filename);
    case 'jpeg' || 'jpg':
      return imagejpeg($thumb, $thumbnailPath . 'thumb_' . $filename);
  }
}
?>

<div class="text-center container-fluid">

  <div class="row">
    <div class="col">
    </div>
    <h1 class="h1 mb-3 fw-normal">Newsbeiträge erstellen</h1>
    <div class="col">
    </div>
  </div>

  <div class="row">
    <div class="col">
    </div>
    <div class="col-sm-6 col-md-5 col-lg-3">

      <img class="mb-4" src="./Images/Kastanie_transparent.png" alt="Kastanien Logo" width="144" height="114">

      <form enctype="multipart/form-data" method="POST">
        <div class="d-grid gap-1">
          <div class="mb-3">
            <label for="title" class="form-label" hidden>Titel</label>
            <input type="text" class="form-control" name="title" id="title" placeholder="Titel" required>
            <?php if (!empty($titleErr)) {
              echo $titleErr;
            } ?>
          </div>

          <div>
            <label for="file" class="form-label">
            </label>
            <input class="form-control" type="file" id="file" name="file" accept="image/*">
            <?php if (!empty($fileErr)) {
              echo $fileErr;
            } ?>
            <p class="fw-lighter">
              Bitte die Bilder (Format *.gif,*.jpeg, *.jpg oder *.png) mit einer maximalen Dateigröße von 10 MByte
              hochladen!
            </p>
          </div>
          <div class="mb-3">
            <label for="alt" class="form-label" hidden>Titel</label>
            <input type="text" class="form-control" name="alt" id="alt" placeholder="Alt Beschreibung">
            <?php if (!empty($altErr)) {
              echo $altErr;
            } ?>
          </div>

          <div class="mb-3">
            <label for="body" class="form-label" hidden>Beitrag</label>
            <textarea class="form-control" id="body" name="body" rows="5" placeholder="Fügen Sie hier Ihren Beitrag hinzu." required></textarea>
            <?php if (!empty($bodyErr)) {
              echo $bodyErr;
            } ?>
          </div>

          <button class="w-100 btn btn-lg btn-sonstige" type="submit" name="upload" value="true">Beitrag
            erstellen</button>
        </div>
      </form>

      <hr class="featurette-divider">

      <div style="text-align: left">
        <p>
        <h5>Vorhandene Bilder:</h5>
        </p>
        <ul>
          <?php

          $uploadDir = "Uploads/";

          if (file_exists($uploadDir)) {
            $files = scandir($uploadDir);
            //          echo "<pre>";print_r($files);"</pre>";
            //          0 und 1 überspringen, da (. und ..)
            //          i = 2; $i < $files.length; $i++

            /*for ($i = 2; isset($files[$i]); $i++) {
            //               echo "<li>" . $files[$i] . "</li>";
            }*/

            if (count($files) == 3) {
              echo "Keine Files vorhanden ...";
            }
          }

          $uploadDir = openDir('Uploads/');

          while ($files = readDir($uploadDir)) {
            if ($files != "." && $files != ".." && $files != "thumbnails" && $files != "testfiles") {
              echo "<a href=\"Uploads/$files\" target= blank>$files</a><br />";
              echo " --> ";
              echo "<a href=\"Uploads/$files\"download>Download Originalgröße</a><br />";
              echo '<img src="Uploads/thumbnails/thumb_' . $files . '" width="200px" height="200px"><br />';
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