<div style="text-align: left">
    <p>
    <h5>Vorhandene Dateien:</h5>
    </p>
    <ul>
        <?php

            if (file_exists($uploadDir)) {
                $files = scandir($uploadDir);
                //          echo "<pre>";print_r($files);"</pre>";
                //          0 und 1 überspringen, da (. und ..)
                //          i = 2; $i < $files.length; $i++
                for ($i = 2; isset($files[$i]); $i++) {
                    //               echo "<li>" . $files[$i] . "</li>";
                }
                if (count($files) == 2) {
                    echo "Keine Files vorhanden ...";
                    //                echo "<li>Keine Files vorhanden ...</li>";
                    //                echo "<p class='red' <li>Keine Files vorhanden ...</li>";
                }
            }

            $uploadDir = openDir('Uploads/');
            while ($files = readDir($uploadDir)) {
                if ($files != "." && $files != ".." && $files != "thumbnails") {
                    echo "<a href=\"Uploads/$files\" target= blank>$files</a><br />";
                    echo " --> ";
                    echo "<a href=\"Uploads/$files\"download>Download</a><br />";
                    echo "<img src='Uploads/$files' width='200px' height='200px'><br />";
                    echo ("<br />");
                }
            }
            closeDir($uploadDir);

            ?>
    </ul>
</div>