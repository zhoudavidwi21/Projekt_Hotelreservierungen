<?php include "./Commons/sessions.php"; ?>

<?php require_once('db/dbaccess.php'); ?>

<?php
//Nur Admins können Newsbeiträge erstellen
if (isset($_SESSION['role']) && $_SESSION['role'] !== "admin") {
    header('Refresh:1; url=index.php?site=error');
    exit();
}
}
?>

<?php
$usernameErr = "";
$gender = $company = $firstname = $lastname = $email = $username = $password = "";

//Datenbankverbindung
$db_obj = new mysqli($host, $dbUser, $dbPassword, $database);

//Fehlermeldung bei DB-Verbindungsfehler
if ($db_obj->connect_error) {
    echo 'Connection error: ' . $db_obj->connect_error;
    exit();
}

$sql = "SELECT * FROM `users` WHERE `userId` = ?";
$stmt = $db_obj->prepare($sql);
$stmt->bind_param("i", $_GET['userId']);

if ($stmt->execute()) {
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $gender = $row["gender"];
    $username = $row["username"];
    $company = $row["companyName"];
    $firstname = $row["firstName"];
    $lastname = $row["lastName"];
    $role = $row["role"];
    $email = $row["email"];
    $password = $row["password"];
    $stmt->close();
} else {
    echo "Error: " . $sql . "<br>" . $db_obj->error;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if any data has been changed
    $updated = false;


    if (
        isset($_POST['role'])
        && $_POST['role'] !== $role
        && !empty($_POST['role'])
    ) {
        $updated = true;
        $role = $_POST['role'];
    }

    if (
        isset($_POST['gender'])
        && $_POST['gender'] !== $gender
        && !empty($_POST['gender'])
    ) {
        $updated = true;
        $gender = $_POST['gender'];
    }

    if (
        isset($_POST['newCompany'])
        && $_POST['newCompany'] !== $company
        && !empty($_POST['newCompany'])
    ) {
        $updated = true;
        $company = input_data($_POST['newCompany']);
    }

    if (
        isset($_POST['newFirstname'])
        && $_POST['newFirstname'] !== $firstname
        && !empty($_POST['newFirstname'])
    ) {
        $updated = true;
        $firstname = input_data($_POST['newFirstname']);
    }

    if (
        isset($_POST['newLastname'])
        && $_POST['newLastname'] !== $lastname
        && !empty($_POST['newLastname'])
    ) {
        $updated = true;
        $lastname = input_data($_POST['newLastname']);
    }

    if (
        isset($_POST['newUsername'])
        && $_POST['newUsername'] !== $username
        && !empty($_POST['newUsername'])
    ) {
        //Überprüfung ob Username schon in der Datenbank vorhanden ist.
        if (!isUsernameUnique(input_data($_POST['newUsername']), $db_obj)) {
            $usernameErr = "Dieser Benutzername ist bereits vergeben!";
        } else {
            $updated = true;
            $username = input_data($_POST['newUsername']);
        }
    }

    if (
        isset($_POST['newEmail'])
        && $_POST['newEmail'] !== $email
        && !empty($_POST['newEmail'])
    ) {
        $updated = true;
        $email = input_data($_POST['newEmail']);
    }


    if (
        isset($_POST['newPassword'])
        && !empty($_POST['newPassword'])
    ) {
        $updated = true;
        $password = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);
    }


    $query = "UPDATE `users` SET `role` = ?, `gender` = ?, `companyName` = ?, `firstName` = ?, `lastName` = ?,
`email` = ?, `username` = ?, `password` = ? WHERE `userId` = ?";
    $stmt = $db_obj->prepare($query);
    $stmt->bind_param(
        "ssssssssi",
        $role,
        $gender,
        $company,
        $firstname,
        $lastname,
        $email,
        $username,
        $password, $_GET['userId']
    );

    // Update the user's information in the database
    if ($updated && $usernameErr == "") {
        if ($stmt->execute()) {
            $stmt->close();
            $db_obj->close();
            header('Refresh:0; url=index.php?site=admin_benutzer_Verwaltung');
            exit();
        } else {
            $stmt->close();
            $db_obj->close();
            echo "Error: " . $query . "<br>" . $db_obj->error;
        }
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
?>

<div class="text-center container-fluid">
    <h1 class="h1 mb-3 fw-normal">Benutzer bearbeiten</h1>
    <img class="mb-4" src="./Images/Kastanie_transparent.png" alt="Kastanien Logo" width="144" height="114">

    <hr class="featurette-divider">

    <h2 class="mt-5">Sie bearbeiten gerade das Profil von
        <?php echo $username; ?>!
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
                $usernameErr <br>
                </div>";
                ?>
            </div>

    <?php }
    } ?>

    <form method="POST">

        <!-- Block Rolle Start -->
        <div class="row mb-5">
            <div class="col">
            </div>
            <div class="col-sm-6 col-md-5 col-lg-3">
                <label for="role" class="d-flex justify-content-start">Aktuelle Rolle</label>
                <?php
                echo "
            <select class='form-select' name='role' aria-label='role select'>
            <option value='user'" . ($role == 'user' ? "selected" : "") . ">User</option>
            <option value='admin' " . ($role == 'admin' ? "selected" : "") . ">Admin</option>
            </select>
          ";
                ?>
            </div>
            <div class="col">
            </div>
        </div>
        <!-- Block Rolle Ende -->

        <!-- Block Anrede Start -->
        <div class="row mb-5">
            <div class="col">
            </div>
            <div class="col-sm-6 col-md-5 col-lg-3">
                <label for="gender" class="d-flex justify-content-start">Aktuelle Anrede</label>
                <?php
                echo "
            <select class='form-select' name='gender' aria-label='Gender select'>
            <option value='Firma'" . ($gender == 'Firma' ? "selected" : "") . ">Firma</option>
            <option value='Herr' " . ($gender == 'Herr' ? "selected" : "") . ">Herr</option>
            <option value='Frau' " . ($gender == 'Frau' ? "selected" : "") . ">Frau</option>
            <option value='Divers' " . ($gender == 'Divers' ? "selected" : "") . ">Divers</option>
            </select>
          ";
                ?>
            </div>
            <div class="col">
            </div>
        </div>
        <!-- Block Anrede Ende -->

        <!-- Block Firma Start -->
        <div class="row mb-1">
            <div class="col">
            </div>
            <div class="col-sm-6 col-md-5 col-lg-3">
                <label for="oldCompany" class="d-flex justify-content-start">Aktueller Firmaname</label>
                <input class="form-control" id="oldCompany" name="oldCompany" type="text"
                    value="<?php echo $company; ?>" aria-label="Disabled input company" disabled readonly>
            </div>
            <div class="col">
            </div>
        </div>
        <div class="row mb-5">
            <div class="col">
            </div>
            <div class="col-sm-6 col-md-5 col-lg-3">
                <label for="newCompany" class="d-flex justify-content-start">Neuen Firmennamen eingeben</label>
                <input class="form-control" id="newCompany" name="newCompany" type="text">
            </div>
            <div class="col">
            </div>
        </div>
        <!-- Block Firma Ende -->

        <!-- Block Vorname Start -->
        <div class="row mb-1">
            <div class="col">
            </div>
            <div class="col-sm-6 col-md-5 col-lg-3">
                <label for="oldFirstname" class="d-flex justify-content-start">Aktueller Vorname</label>
                <input class="form-control" id="oldFirstname" name="oldFirstname" type="text"
                    value="<?php echo $firstname; ?>" aria-label="Disabled input example" disabled readonly>
            </div>
            <div class="col">
            </div>
        </div>
        <div class="row mb-5">
            <div class="col">
            </div>
            <div class="col-sm-6 col-md-5 col-lg-3">
                <label for="newFirstname" class="d-flex justify-content-start">Neuen Vorname eingeben</label>
                <input class="form-control" id="newFirstname" name="newFirstname" type="text">
            </div>
            <div class="col">
            </div>
        </div>
        <!-- Block Vorname Ende -->

        <!-- Block Nachname Start -->
        <div class="row mb-1">
            <div class="col">
            </div>
            <div class="col-sm-6 col-md-5 col-lg-3">
                <label for="oldLastname" class="d-flex justify-content-start">Aktueller Nachname</label>
                <input class="form-control" id="oldLastname" name="oldLastname" type="text"
                    value="<?php echo $lastname; ?>" aria-label="Disabled input example" disabled readonly>
            </div>
            <div class="col">
            </div>
        </div>
        <div class="row mb-5">
            <div class="col">
            </div>
            <div class="col-sm-6 col-md-5 col-lg-3">
                <label for="newLastname" class="d-flex justify-content-start">Neuen Nachname eingeben</label>
                <input class="form-control" id="newLastname" name="newLastname" type="text">
            </div>
            <div class="col">
            </div>
        </div>
        <!-- Block Nachname Ende -->

        <!-- Block Benutzername Start -->
        <div class="row mb-1">
            <div class="col">
            </div>
            <div class="col-sm-6 col-md-5 col-lg-3">
                <label for="oldUsername" class="d-flex justify-content-start">Aktueller Benutzername</label>
                <input class="form-control" id="oldUsername" name="oldUsername" type="text" value="<?php echo $username; ?>" aria-label="Disabled input example" disabled readonly>
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

        <!-- Block Passwort Start -->
        <div class="row mb-5">
            <div class="col">
            </div>
            <div class="col-sm-6 col-md-5 col-lg-3">
                <label for="newPassword" class="d-flex justify-content-start">Neues Passwort eingeben</label>
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