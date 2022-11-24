<?php
if (!isset($_SESSION["name"])) {
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

    <h2>Hello <?php echo $_SESSION["name"] ?></h2>
    <form method="GET">
        <input type="hidden" name="logout" value="true">
        <button>Logout</button>
    </form>


</body>

</html>