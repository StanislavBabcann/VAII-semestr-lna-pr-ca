<?php

include "Database.php";

    $db = new Database();

    if (isset($_GET['prichutBox'])) {
        $result = $db->dajPrichuteProduktuPodlaHmotnosti($_GET['ide'], $_GET['prichutBox']);
        echo "pici";
        for ($i = 0; $i < sizeof($result); $i++) {
            ?>
                <option value=""><?=$result[$i]->prichut?></option>
            <?php
        }
    }
?>
