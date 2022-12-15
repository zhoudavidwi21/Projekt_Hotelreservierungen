<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="saveImage.php" method="post" enctype="multipart/form-data">
        <label for="picture">Picture</label>
        <input type="file" name="picture" id="picture">
        <br>
        <label for="comment">Comment</label>
        <input type="text" name="comment" id="comment">
        <button type="submit">Save Image</button>
    </form>
</body>
</html>