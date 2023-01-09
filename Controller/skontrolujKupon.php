<?php
include "../Model/Database.php";

$db = new Database();
$kodKuponu = $_GET['q'];

$kupon = $db->dajKupon($kodKuponu);

$velkost = sizeof($kupon);



if ($velkost == 0) {
    echo "No such coupon.0";
} else {
    $kupon = $kupon[0];
    $zlava = $kupon->getPercentoZlavy();
    $pouzity = $kupon->getPouzity();

    if ($pouzity == 0) {
        echo "Coupon accepted.".$zlava;
    } else {
        echo "Coupon already used.0";
    }
}
