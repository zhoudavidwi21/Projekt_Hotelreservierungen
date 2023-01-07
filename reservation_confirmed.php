<?php include "./Commons/sessions.php"; ?>

<div class="text-center container-fluid">
    <div class="row justify-content-md-center">
        <div class="col-sm-6 col-md-5 col-lg-4">
            <img class="mb-4" src="./Images/Kastanie_transparent.png" alt="Kastanien Logo" width="144" height="114">

            <h1 class="h3 mb-3 fw-normal">Reservierung bestätigen</h1>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Beschreibung</th>
                        <th scope="col">Preis</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Zimmer Nummer</th>
                        <td>
                            <?php if (isset($_SESSION['resRoom'])) {
                                echo $_SESSION['resRoom'];
                            } ?>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Frühstück</th>
                        <td>
                            <?php if (isset($_SESSION['resBreakfast'])) {
                                if ($_SESSION['resBreakfast'] == "true") {
                                    echo "Ja";
                                } else {
                                    echo "Nein";
                                }
                            } ?>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Parkplatz</th>
                        <td>
                            <?php if (isset($_SESSION['resParking'])) {
                                if ($_SESSION['resParking'] == "true") {
                                    echo "Ja";
                                } else {
                                    echo "Nein";
                                }
                            } ?>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Haustier</th>
                        <td>
                            <?php if (isset($_SESSION['resPet'])) {
                                if ($_SESSION['resPet'] == "true") {
                                    echo "Ja";
                                } else {
                                    echo "Nein";
                                }
                            } ?>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Anreisedatum</th>
                        <td>
                            <?php if (isset($_SESSION['resArrival'])) {
                                $date1 = date_create($_SESSION['resArrival']);
                                echo date_format($date1, "d.m.Y");
                            } ?>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Abreisedatum</th>
                        <td>
                            <?php if (isset($_SESSION['resDeparture'])) {
                                $date2 = date_create($_SESSION['resDeparture']);
                                echo date_format($date2, "d.m.Y");
                            } ?>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Anzahl der Nächte</th>
                        <td>
                            <?php if (isset($_SESSION['resDeparture'])) {
                                $diff = date_diff($date1, $date2, true);
                                echo $diff->format("%a");
                                
                            } ?>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Gesamtpreis</th>
                        <td colspan="2">
                            
                            <?php 
                            $roomTotal = 50 * $diff->format("%a");
                            $serviceTotal = 0;
                            if (isset($_SESSION['resBreakfast']) && $_SESSION['resBreakfast'] == "true") {
                                $serviceTotal += 1000 * $diff->format("%a");
                            }
                            if (isset($_SESSION['resParking']) && $_SESSION['resParking'] == "true") {
                                $serviceTotal += 500 * $diff->format("%a");
                            }
                            $sum = $roomTotal + $serviceTotal;
                            echo '<p class=fw-bold>' . $sum . "€" . '</p>';
                            ?>
                            
                        </td>
                    </tr>
                </tbody>
            </table>

            <a href="index.php?site=zimmer_reservieren" class="btn btn-secondary">Zurück</a>
            <a href="" class="btn btn-sonstige">Bestätigen</a>
        </div>
    </div>
</div>