<?php
$errors = [];
$errors["username"] = false;
$errors["Datenschutz"] = false;

echo "<pre>";
print_r($_SERVER);
"</pre>";

/*
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    echo "Hello World!";
    echo "<pre>";
    print_r($_GET);
    "</pre>";

    if(empty($_GET["username"])) {
        $errors["username"] = true;
    }
}
*/
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Hello World!";
    echo "<pre>";
    print_r($_POST);
    "</pre>";

    if (empty($_POST["username"])) {
        $errors["username"] = true;
    }

    if (!isset($_POST["Datenschutz"])) {
        $errors["Datenschutz"] = true;
    }
}
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
    <!--
    <form action="">
        <label for="username">Username</label>
        <br>
        <input type="text" id="username" name="username">
        <?php if (true) { ?>
            "hello w"
        <?php } ?>
        <br>
        <button type="submit">Submit Button</button>
    </form>
        -->
    <form action="" method="POST">
        <label for="username">Username</label>
        <br>
        <input type="text" id="username" name="username">
        <?php if ($errors["username"]) { ?>
        <?php } ?>
        <br>
        <button type="submit">Submit Button</button>
        <br>
        <input type="checkbox" name="Datenschutz" id="Datenschutz">
        <?php if ($errors["Datenschutz"]) { ?>
            Error
        <?php } ?>

        <label for="Datenschutz">Datenschutz</a> aktzeptieren *</label>
        <br>
        <input type="checkbox" name="AGBs" id="AGBs" required>
        <label for="AGBs"><a href="">AGBs</a> aktzeptieren *</label>

    </form>

</body>

</html>