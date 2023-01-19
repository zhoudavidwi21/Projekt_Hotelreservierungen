<?php
require_once('dbaccess.php'); //to retrieve connection info

$db_obj = new mysqli($host, $user, $password, $database);
if ($db_obj->connect_error) {
    echo 'Connection error: ' . $db_obj->connect_error;
    exit();
}

echo "<pre>" . print_r($_POST, true) . "</pre>";
echo "<pre>" . print_r($_FILES, true) . "</pre>";

if (!empty($_FILES['picture']['name'])) {
    $uniqueFileName = time() . "_" . $_FILES['picture']['name'];
    if (move_uploaded_file($_FILES['picture']['tmp_name'], 'upload/' . $uniqueFileName)) {
        $sql = "INSERT INTO `tickets`(`file_path`, `comment`, `user_id`) VALUES (?, ?, ?)";

        $stmt = $db_obj->prepare($sql);

        //"s" stands for string "i" for integer, d for double
        //followed by variables which will be bound to the parameters
        $stmt->bind_param("ssi", $filePath, $comment, $userID);

        $filePath = 'upload/' . $uniqueFileName;
        $comment = $_POST['comment'];
        $userID = 1;

        if ($stmt->execute()) {
            echo "New ticket created";
            //trigger forwarding to welcome page, get-started tutorial,
            //confirmation email with username (but withiout chosen password), etc.
        } else {
            echo "Error";
        }

        $stmt->close();
        $db_obj->close();
        header("Refresh: 1; URL = test.php");
    } else {
        echo "File not uploaded";
    }

}


?>