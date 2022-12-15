<?php
require_once('dbaccess.php');

if(isset($_POST["username"]) && !empty($_POST["username"])
 && isset($_POST["password"]) && !empty($_POST["password"])
&& isset($_POST["useremail"]) && !empty($_POST["useremail"])) {
    echo"<pre>" . '$_POST '.print_r($_POST, true)."</pre>";

    $_POST["password"] = password_hash($_POST["password"], PASSWORD_DEFAULT);
    echo"<pre>" . '$_POST '.print_r($_POST, true)."</pre>";


    $db_obj = new mysqli($host, $user, $password, $database);

    $sql = "INSERT INTO `users`(`username`, `password`, `useremail`) VALUES (?, ?, ?)";

    $uname = $_POST["username"];
    $pass = $_POST["password"];
    $mail = $_POST["useremail"];
    $stmt = $db_obj->prepare($sql);

    //"s" stands for string "i" for integer, d for double
    //followed by variables which will be bound to the parameters
    $stmt->bind_param("sss", $uname, $pass, $mail);

    if($stmt->execute()) {
        echo "New user created";
        //trigger forwarding to welcome page, get-started tutorial,
        //confirmation email with username (but withiout chosen password), etc.
    }
    else{
        echo "Error";
    }

    $stmt->close();
    $db_obj->close();
    header("Refresh: 1; URL = register.html");
}

?>