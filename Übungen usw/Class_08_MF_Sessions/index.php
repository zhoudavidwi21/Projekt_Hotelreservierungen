<?php

/*
$value1 = "something from somewhere";
$value2 = "time goes by";
setcookie("TestCookie", $value1);
echo $_COOKIE["TestCookie"];


/*
expire in 1 hour 
setcookie("test_cookie_time", $value2, time()+3600);
echo $_COOKIE["test_cookie_time"];


$_SESSION["name"] = "Martin";
echo $_SESSION["name"];
*/

session_start();

if (
    $_SERVER["REQUEST_METHOD"] ==="GET"
    && isset($_GET["logout"])
    && $_GET["logout"] === "true"
) {
    //unset($_SESSION["name"]);
    echo "<pre>";print_r($_SERVER);"</pre>";
    session_destroy();
    header("Location: " .$_SERVER["HTTP_REFERER"]);
    // header("Location: http://".$_SERVER["HTTP_HOST"]."webtech/sessions/index.php?error= forbidden");
    //header
    //die
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (
        isset($_POST["name1"])
        && isset($_POST["password1"])
        && $_POST["name1"] === "admin"
        && $_POST["password1"] === "admin"        
    ) {
        $_SESSION["name"] = $_POST["name1"];
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <?php if (!isset($_SESSION["name"])) { ?>
    <form method="POST">
        <br>
        <label for="name">Name</label>
        <input type="text" name="name1" id="name">
        <br>
        <label for="password">Password</label>
        <input type="passwor" name="password1" id="password">
        <br>
        <button type="submit">Login</button>
    </form>
    <?php } else { ?>
        <h2>Hello <?php echo $_SESSION["name"] ?></h2>
        <form method="GET">
            <input type="hidden" name ="logout" value="true">
            <button>Logout</button>
        </form>
    <?php } ?>
</body>
</html>