<?php

include "../Model/Database.php";

$db = new Database();


$id = $_GET['idecko'];
$balenie = $_GET['balenie'];

$prichute = $db->dajPrichutePodlaBalenia($id, $balenie);

foreach ($prichute as $prichut) {
    echo "<option>".$prichut->getPrichut()."</option>";
}
