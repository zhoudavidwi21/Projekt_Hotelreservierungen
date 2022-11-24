<?php
$uploadDir = "uploads/";
//$file = $_FILES["file"];

if (!file_exists($uploadDir)){
    mkdir($uploadDir);
}

//echo "<pre>";print_r($file);"</pre";

//$testupload = move_uploaded_file($file["tmp_name"])

if (
$_SERVER["REQUEST_METHOD"] === "POST"
&& isset($_FILES["file"])
) {
    if (move_uploaded_file(
        $_FILES["file"]["tmp_name"],
        $uploadDir.$_FILES["file"]["name"]
    )
) {
    echo "Datei wurde erfolgreich hochgeladen!";
} else {
    echo "Fehler beim Upload!"; 
    }
}

//move_uploaded_file($file["tmp_name"], "uploads/".$file["name"]);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form enctype="multipart/form-data" method="POST">
        <label for="file">File</label>
        <input type="file" id="file" name="file">
        <button type="submit">Upload</button>
    </form>
    <ul>

    <?php
        if (!file_exists($uploadDir)) {
            $files = scandir($uploadDir);            
//          echo "<pre>";print_r($files);"</pre>";
//          0 und 1 überspringen, da (. und ..)
//          i = 2; $i < $files.length; $i++
            for ($i = 2; isset($files[$i]); $i++)
            {
                echo "<li>".$files[$i]."</li>";
            }
            if (count($files) == 2) {
                echo "<li>Keine Files vorhanden ...</li>";
            }
        }
    ?>
    </ul>
    
</body>
</html>