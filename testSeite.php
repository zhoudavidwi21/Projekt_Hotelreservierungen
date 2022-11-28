<?php include "Commons/sessions.php"; ?>

<?php
$uploadDir = "Uploads/";
$thumbnailDir = "thumbnails/";

$thumbnailPath = $uploadDir . $thumbnailDir;

if (!file_exists($uploadDir)) {
    mkdir($uploadDir);
}

if (!file_exists($thumbnailPath)) {
    mkdir($thumbnailPath, 0777, true);
}
//echo "<pre>";print_r($_FILES);"</pre";

//Erlaubte Dateiformate
$allowed = array('png', 'jpg', 'jpeg');

if (
    $_SERVER["REQUEST_METHOD"] === "POST"
    && isset($_FILES["file"])
) {
    //Liest den filenamen aus
    $filename = $_FILES['file']['name'];

    //speichert die Endung in $ext
    $ext = pathinfo($filename, PATHINFO_EXTENSION);

    //Checkt ob die gespeicherte $ext im $allowed array drin is, wenn mehr Formate erlaubt --> allowed array erweitern s. oben
    if (in_array($ext, $allowed)) {
        if (
            move_uploaded_file(
                $_FILES["file"]["tmp_name"],
                $uploadDir . $_FILES["file"]["name"]
            )
        ) {
            echo 'Datei erfolgreich hochgeladen';
        } else {
            echo 'Fehler beim Hochladen';
        }
    } else {
        echo 'Fehler: Bitte nur folgende Bildformate hochladen: ';
        //gibt alle erlaubten formate aus
        for ($i = 0; $i < count($allowed); $i++) {
            echo '.' . $allowed[$i] . ', ';
        }
        ;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css_Daten/album.css">
    <title>Album</title>
</head>

<body>
    <?php include "Commons/header.php"; ?>
    <main>

        <section class="text-center container">
            <div class="text-center container-fluid">
                <div class="row">
                    <div class="col">
                    </div>
                    <div class="col-sm-6 col-md-5 col-lg-8">

                        <h1>Bilder hochladen</h1>
                        <img src="Images/Kastanie_transparent.png" alt="" width="144" height="114">

                        <!--       <h4><label for="file">Bitte hier Daten hochladen</label></h4> -->
                        <form enctype="multipart/form-data" method="POST">
                            <div class="d-grid gap-1">
                                <label for="file" class="form-label">
                                    <h4>Bitte hier Daten hochladen</h4>
                                </label>
                                <input class="form-control" type="file" id="file" name="file" accept="image/*">
                                <p class="fw-lighter">
                                    Es wird empfohlen Bilder mit einem Verhältnis von 1:1 hochzuladen, da es sonst bei
                                    Thumbnails zu
                                    Verzerrungen kommen kann.
                                </p>
                                <button class="w-100 btn btn-lg btn-sonstige" type="submit">Upload</button>
                            </div>
                        </form>
                        <br>
                    </div>
                    <div class="col">

                    </div>
                </div>
            </div>
        </section>

        <div class="album py-5">
            <div class="container">
                <img src="" alt="">

                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    <?php
                    if (file_exists($thumbnailPath)) {
                        $files = scandir($thumbnailPath);
                        /*echo "<pre>";
                        print_r($files);
                        "</pre>";*/

                        for ($i = 2; isset($files[$i]); $i++) {
                            if ($files[$i] != "." && $files[$i] != "..") {
                                echo "<a href=\"Uploads/$files[$i]\" target= blank>$files[$i]</a><br />";
                                echo " --> ";
                                echo "<a href=\"Uploads/$files[$i]\"download>Download</a><br />";
                                echo ("<br />");
                            }
                            //               echo "<li>" . $files[$i] . "</li>";
                        }
                        if (count($files) == 2) {
                            echo "Keine Files vorhanden ...";
                            //                echo "<li>Keine Files vorhanden ...</li>";
                            //                echo "<p class='red' <li>Keine Files vorhanden ...</li>";
                        }
                    }

                    ?>
                    <div class="col">
                        <div class="card shadow-sm">
                            <img class="bd-placeholder-img card-img-top img-thumbnail" src="http://www.w3.org/2000/svg"
                                role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice"
                                focusable="false">
                            <title>Placeholder</title>
                            <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef"
                                dy=".3em">Thumbnail</text>


                            <div class="card-body">
                                <p class="card-text">This is a wider card with supporting text below as a natural
                                    lead-in to additional content. This content is a little bit longer.</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                        <button type="button" class="btn btn-sm btn-outline-secondary">Download</button>
                                    </div>
                                    <small class="text-muted">9 mins</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include "Commons/footer.php"; ?>
</body>

</html>