<?php include "./Commons/sessions.php"; ?>

<?php require_once('db/dbaccess.php'); ?>

<?php
//Nur angemeldete Nutzer können Zimmer reservieren
if (isset($_SESSION['role']) && $_SESSION['role'] === "guest") {
    header('Refresh:1; url=index.php?site=error');
    exit();
}
?>

<?php
$emailErr = $usernameErr = $passwordErr = $passwordCheckErr = $oldPasswordErr = "";
$email = $username = $password = $passwordCheck = $oldPassword = "";
$successfullyChanged = false;

//Datenbankverbindung
$db_obj = new mysqli($host, $dbUser, $dbPassword, $database);

//Fehlermeldung bei DB-Verbindungsfehler
if ($db_obj->connect_error) {
    echo 'Connection error: ' . $db_obj->connect_error;
    exit();
}

$sql = "SELECT * FROM `users` WHERE `userId` = ? AND `deleted` = 0";
$stmt = $db_obj->prepare($sql);
$stmt->bind_param("i", $_SESSION['userId']);

if ($stmt->execute()) {
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $username = $row["username"];
    $email = $row["email"];
    $password = $row["password"];
    $stmt->close();
} else {
    echo "Error: " . $sql . "<br>" . $db_obj->error;
}

if ($successfullyChanged) {
    header('location: Commons/logout.php');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (password_verify($_POST['oldPassword'], $password)) {
        // Check if any data has been changed
        $updated = false;
        $query = "UPDATE `users` SET `email` = ?, `username` = ?, `password` = ? WHERE `userId` = ?";

        if (
            isset($_POST['newEmail'])
            && $_POST['newEmail'] !== $email
            && !empty($_POST['newEmail'])
        ) {
            //Überprüfung ob Email zumindest "normale" Form hat.
            if (!filter_var($_POST['newEmail'], FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Bitte geben Sie eine gültige E-Mail Adresse ein!";
            } else {
                $updated = true;
                $email = $_POST['newEmail'];
            }
        }

        if (
            isset($_POST['newUsername'])
            && $_POST['newUsername'] !== $username
            && !empty($_POST['newUsername'])
        ) {
            //Überprüfung ob Username schon in der Datenbank vorhanden ist.
            if (!isUsernameUnique($_POST['newUsername'], $db_obj)) {
                $usernameErr = "Dieser Benutzername ist bereits vergeben!";
            } else {
                $updated = true;
                $username = $_POST['newUsername'];
            }
        }

        if (
            isset($_POST['newPassword'])
            && password_hash($_POST['newPassword'], PASSWORD_DEFAULT) !== $password
            && !empty($_POST['newPassword'])
        ) {
            if (!passwordRegExCheck($_POST['newPassword'])) {
                $passwordErr = "Das Passwort muss mindestens 8 Zeichen lang sein," . "<br>" . "
                einen Großbuchstaben," . "<br>" . "
                einen Kleinbuchstaben " . "<br>" . "
                und eine Zahl enthalten!";
            } else {
                if ($_POST['newPassword'] == $_POST['newPasswordCheck']) {
                    $updated = true;
                    $password = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);
                } else {
                    $passwordCheckErr = "Die Passwörter stimmen nicht überein!";
                }
            }
        }

        // Update the user's information in the database
        if ($updated && $emailErr == "" && $usernameErr == "" && $passwordErr == "" && $passwordCheckErr == "") {
            $stmt = $db_obj->prepare($query);
            $stmt->bind_param("sssi", $email, $username, $password, $_SESSION['userId']);
            if ($stmt->execute()) {
                $successfullyChanged = true;
                $stmt->close();
                $db_obj->close();
                header('location: Commons/logout.php');
                exit();
            } else {
                $stmt->close();
                $db_obj->close();
                echo "Error: " . $query . "<br>" . $db_obj->error;
            }
        } else {
            echo "Es konnten keine Änderungen vorgenommen werden!";
        }
    } else {
        $oldPasswordErr = "Das eingegebene Passwort ist falsch!";
    }


}

//Vereinheitlichts die Eingabe bevor sie eingespeichert wird. --> vlt nützlich für DB-Anbindung?
function input_data($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function isUsernameUnique($username, $db_obj)
{
    //Überprüfung ob Username unique mittels prepared statement
    $sql = "SELECT * FROM `users` WHERE BINARY `username` = ?";
    $stmt = $db_obj->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    //Wenn es einen Eintrag gibt, dann ist der Username nicht unique
    if ($result->num_rows > 0) {
        $stmt->close();
        return false;
    } else {
        $stmt->close();
        return true;
    }

}

function passwordRegExCheck($password)
{
    //Passwort regex check
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number = preg_match('@[0-9]@', $password);
    //$uppercase = preg_match('@[^\w]@', $password); kann man auch, aber zu mühsam jetzt
    if (!$uppercase || !$lowercase || !$number || strlen($password) < 5) {
        return false;
    } else {
        return true;
    }
}
?>

<div class="text-center container-fluid">
    <h1 class="h1 mb-3 fw-normal">Profil bearbeiten</h1>
    <img class="mb-4" src="./Images/Kastanie_transparent.png" alt="Kastanien Logo" width="144" height="114">

    <h2 class="mt-5">Hallo
        <?php echo $_SESSION["username"]; ?>!
    </h2>

    <?php if (isset($_POST["submit"])) {
        if (isset($successfullyChanged) && $successfullyChanged) { ?>
            <div class="alert alert-success" role="alert">
                Änderungen erfolgreich!
            </div>

        <?php } else { ?>
            <div class="alert alert-danger" role="alert">
                Fehler bei den Änderungen!
                <br>
                <?php
                echo "<div class='alert alert-danger' role='alert'>
                Folgende Fehler sind aufgetreten: <br>
                $emailErr <br>
                $usernameErr <br>
                $passwordErr <br>
                $passwordCheckErr <br>
                $oldPasswordErr <br>
                </div>";
                ?>
            </div>

        <?php }
    } ?>

    <form method="POST">

        <!-- Block Email Start -->
        <div class="row mb-1">
            <div class="col">
            </div>
            <div class="col-sm-6 col-md-5 col-lg-3">
                <label for="oldEmail" class="d-flex justify-content-start">E-Mail Adresse</label>
                <input class="form-control" id="oldEmail" name="oldEmail" type="email" value="<?php echo $email; ?>"
                    aria-label="Disabled input example" disabled readonly>
            </div>
            <div class="col">
            </div>
        </div>
        <div class="row mb-5">
            <div class="col">
            </div>
            <div class="col-sm-6 col-md-5 col-lg-3">
                <label for="newEmail" class="d-flex justify-content-start">Neue E-Mail Adresse eingeben</label>
                <input class="form-control" id="newEmail" name="newEmail" type="email">
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
                <label for="oldUsername" class="d-flex justify-content-start">Aktueller Benutzername</label>
                <input class="form-control" id="oldUsername" name="oldUsername" type="text"
                    value="<?php echo $username; ?>" aria-label="Disabled input example" disabled readonly>
            </div>
            <div class="col">
            </div>
        </div>
        <div class="row mb-5">
            <div class="col">
            </div>
            <div class="col-sm-6 col-md-5 col-lg-3">
                <label for="newUsername" class="d-flex justify-content-start">Neuen Benutzername eingeben</label>
                <input class="form-control" id="newUsername" name="newUsername" type="text">
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
                <label for="oldPassword" class="d-flex justify-content-start">Altes Passwort eingeben</label>
                <input class="form-control" id="oldPassword" name="oldPassword" type="password">
            </div>
            <div class="col">
            </div>
        </div>
        <div class="row mb-5">
            <div class="col">
            </div>
            <div class="col-sm-6 col-md-5 col-lg-3">
                <label for="newPassword" class="d-flex justify-content-start">Neues Passwort eingeben</label>
                <input class="form-control" id="newPassword" placeholder="neues Passwort" name="newPassword"
                    type="password">
                <label for="newPasswordCheck" class="d-flex justify-content-start"></label>
                <input class="form-control" id="newPasswordCheck" placeholder="neues Passwort wiederholen"
                    name="newPasswordCheck" type="password">
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