<?php
require_once ('dbaccess.php');

if(isset($_POST["username"]) && !empty($_POST['username'])
&& isset($_POST["password"]) && !empty($_POST['password'])
&& isset($_POST["useremail"]) && !empty($_POST['useremail'])
) {
    echo "<pre>" . '$_POST' . print_r($_POST, true) . "</pre>";

    $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
    echo "<pre>" . '$_POST' . print_r($_POST, true) . "</pre>";

    $db_obj = new mysqli($host, $user, $password, $database);

    $sql = "INSERT INTO `users`(`username`, `password`, `useremail`) VALUES (?, ?, ?)";
    

    $uname = $_POST['username'];
    $pass = $_POST['password'];
    $mail = $_POST['useremail'];

    $stmt = $db_obj->prepare($sql);

    $stmt->bind_param("sss", $uname, $pass, $mail);

    if ($stmt->execute()) {
        echo "New user created";        
    }
    else {
        echo "Error";
    }

    //close the statement
    $stmt->close();
    //close the connection

    $db_obj->close();



}
