<?php include "./Commons/sessions.php"; ?>

<?php
//Nur Admins können Newsbeiträge erstellen
if (isset($_SESSION['role']) && $_SESSION['role'] == "guest") {
    header('Refresh:1; url=index.php?site=error');
    exit();
}
?>

<?php
unset($_SESSION['resRoom']);
unset($_SESSION['resArrival']);
unset($_SESSION['resDeparture']);
unset($_SESSION['resServices']['resBreakfast']);
unset($_SESSION['resServices']['resParking']);
unset($_SESSION['resServices']['resPet']);
unset($_SESSION['resServices']);
unset($_SESSION['resTotal']);
?>

<div class="text-center container-fluid">
    <div class="row">
        <div class="col">
        </div>
        <div class="col-10">

            <h1 class="h1 mb-3 fw-normal">Vielen Dank für Ihre Reservierung!</h1>
            <img class="mb-4" src="./Images/Kastanie_transparent.png" alt="" width="144" height="114">
            <br>

            <script type="text/javascript">
                (function() {
                    var timeLeft = 10,
                        cinterval;
                    var timeDec = function() {
                        timeLeft--;
                        document.getElementById('countdown').innerHTML = timeLeft;
                        if (timeLeft === 0) {
                            clearInterval(cinterval);
                            document.location.href = "index.php"
                        }
                    };
                    cinterval = setInterval(timeDec, 1000);
                })();
            </script>

            Sie werden in <span id="countdown">10</span> Sekunden zur Startseite weitergeleitet.
            <br><br>

            Falls Sie nicht weitergeleitet werden, drücken Sie bitte auf diesen
            <a href="./index.php" class="link-primary">Link.</a>

        </div>
        <div class="col">

        </div>
    </div>
</div>