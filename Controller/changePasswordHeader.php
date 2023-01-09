<?php

include "../Model/Database.php";
include "../Controller/InputValidator.php";
session_start();

$db = new Database();
$mail = $_SESSION['sesMail'];


$firstPasErr = " ";
$secondPasErr = " " ;



if (isset($_GET['potvrZmenHesla'])) {


    $inpValidator = new InputValidator();

    $zmenaHeslo = $_REQUEST['changePassword'];
    $zmenaHesloZnova = $_REQUEST['changePassRe'];

    $firstPasErr = $inpValidator->checkFirstPassword($zmenaHeslo);
    $secondPasErr = $inpValidator->checkSecondPassword($zmenaHeslo, $zmenaHesloZnova);

    if (strcmp($firstPasErr, " ") != 0 || strcmp($secondPasErr, " ") != 0) {
    } else {
        $hashed_password = password_hash($zmenaHeslo, PASSWORD_DEFAULT);
        $db->zmenHesloPouzivatela($mail, $hashed_password);
        header("location: ../View/AccountStarter.php");
        die();
    }

}
