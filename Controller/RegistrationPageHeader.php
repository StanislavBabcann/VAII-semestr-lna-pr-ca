<?php

session_start();

include "../Model/Database.php";
include "InputValidator.php";


$mailErr = " " ;
$nameErr = " " ;
$lastErr = " " ;
$cityErr = " " ;
$ulicaErr = " " ;
$firstPasErr = " ";
$secondPasErr = " " ;

$regMeno = "";
$regLast = "";
$regMail = "";
$regMesto = "";
$regUlica = "";

$db = new Database();

if (isset($_GET['regPotvrdit'])) {
    $regMeno = $_REQUEST['regMeno'];
    $regLast = $_REQUEST['regPriezvisko'];
    $regMail = $_REQUEST['regMail'];
    $regMesto = $_REQUEST['regMesto'];
    $regUlica = $_REQUEST['regUlica'];
    $regHeslo = $_REQUEST['regHeslo'];
    $regHesloZnova = $_REQUEST['regHesloZnova'];



    $inpValidator = new InputValidator();

    $nameErr = $inpValidator->validateFirstName($regMeno);
    $lastErr = $inpValidator->validateLastName($regLast);
    $mailErr = $inpValidator->validateMail($regMail);
    $cityErr = $inpValidator->validateCity($regMesto);
    $ulicaErr = $inpValidator->validateStreet($regUlica);
    $firstPasErr = $inpValidator->checkFirstPassword($regHeslo);
    $secondPasErr = $inpValidator->checkSecondPassword($regHeslo, $regHesloZnova);



    if (strcmp($nameErr, " ") != 0 || strcmp($lastErr, " ") != 0 ||
        strcmp($mailErr, " ") != 0 || strcmp($cityErr, " ") != 0 ||
        strcmp($ulicaErr, " ") != 0 || strcmp($firstPasErr, " ") != 0 ||
        strcmp($secondPasErr, " ") != 0) {

    }
    else {
        $password = $_REQUEST['regHeslo'];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $newPouzivatel = new Pouzivatel();
        $newPouzivatel->setMeno($_REQUEST['regMeno']);
        $newPouzivatel->setPriezvisko($_REQUEST['regPriezvisko']);
        $newPouzivatel->setMail($_REQUEST['regMail']);
        $newPouzivatel->setMesto($_REQUEST['regMesto']);
        $newPouzivatel->setUlica($_REQUEST['regUlica']);
        $newPouzivatel->setHeslo($hashed_password);

        $_SESSION['sesMail'] = $newPouzivatel->getMail();


        $db->pridajPouzivatela($newPouzivatel);


        header("location: ../View/AccountStarter.php");
    }


}
