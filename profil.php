<?php include "./Commons/sessions.php"; ?>
<?php
if ($_SESSION['role'] === "guest") {
    header('location: ./error.php');
    exit();
}
?>

<?php
$passwordHash = "test1234";
$successfullyChanged = false;

if (isset($_POST["submit"]) && isset($_POST["oldPassword"])) {
    if (password_verify($_POST["oldPassword"], $passwordHash)){
        //Überprüfung der Daten ob sie änderbar sind (Passwort Länge, Benutzernamen Verfügbarkeit
        //und Email Verifizierung)


        //Daten in der Datenbank ändern (die die gesetzt sind)


        $successfullyChanged = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
</head>

<body>
    <?php include "Commons/header.php"; ?>

    <div class="text-center container-fluid">
        <h2 class="mt-5">Hallo
            <?php echo $_SESSION["username"]; ?>!
        </h2>
        <form method="POST">

            <!-- Block Email Start -->
            <div class="row mb-1">
                <div class="col">
                </div>
                <div class="col-sm-6 col-md-5 col-lg-3">
                    <label for="oldEmail" class="d-flex justify-content-start">E-Mail Adresse</label>
                    <input class="form-control" id="oldEmail" type="email" value="some sql data"
                        aria-label="Disabled input example" disabled readonly>
                </div>
                <div class="col">
                </div>
            </div>
            <div class="row mb-5">
                <div class="col">
                </div>
                <div class="col-sm-6 col-md-5 col-lg-3">
                    <label for="newEmail" class="d-flex justify-content-start">Neue E-Mail Adresse</label>
                    <input class="form-control" id="newEmail" type="email">
                </div>
                <div class="col">
                </div>
            </div>
            <!-- Block Email Ende -->

            <!-- Block Benutzername Start -->

            <div class="row mb-1">
                <div class="col">
                </div>
                <div class="col-sm-6 col-md-5 col-lg-3">
                    <label for="oldUsername" class="d-flex justify-content-start">Benutzername</label>
                    <input class="form-control" id="oldUsername" type="text" value="some sql data"
                        aria-label="Disabled input example" disabled readonly>
                </div>
                <div class="col">
                </div>
            </div>
            <div class="row mb-5">
                <div class="col">
                </div>
                <div class="col-sm-6 col-md-5 col-lg-3">
                    <label for="newUsername" class="d-flex justify-content-start">Neuer Benutzername</label>
                    <input class="form-control" id="newUsername" type="text">
                </div>
                <div class="col">
                </div>
            </div>
            <!-- Block Benutzername Ende -->


            <!-- Block Passwort Start -->
            <div class="row mb-1">
                <div class="col">
                </div>
                <div class="col-sm-6 col-md-5 col-lg-3">
                    <label for="oldPassword" class="d-flex justify-content-start">Passwort</label>
                    <input class="form-control" id="oldPassword" name="oldPassword" type="password">
                </div>
                <div class="col">
                </div>
            </div>
            <div class="row mb-5">
                <div class="col">
                </div>
                <div class="col-sm-6 col-md-5 col-lg-3">
                    <label for="newPassword" class="d-flex justify-content-start">Neues Passwort</label>
                    <input class="form-control" id="newPassword" name="newPassword" type="password">
                </div>
                <div class="col">
                </div>
            </div>
            <!-- Block Passwort Ende -->

            

            <div>
                <button class="btn btn-sonstige" type="submit" name="submit" value="true">Ändern</button>
            </div>
        </form>
    </div>
</body>

</html>