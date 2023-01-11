<?php

include "../Controller/InputValidator.php";
include "../Model/Database.php";
include "../Controller/LogginManager.php";

$loginManager = new LogginManager();

session_start();

$db = new Database();

$mailErr = " " ;
$nameErr = " " ;
$lastErr = " " ;
$cityErr = " " ;
$ulicaErr = " " ;

$editMeno = null;
$editLast = null;
$editMail = null;
$editMesto = null;
$editUlica = null;
$staryMail = null;

$mode = $_SESSION['titulPreFormu'];

if (isset($_SESSION['logged'])) {
    $pouzivatel = $db->nacitajInfoUzivatela($_SESSION['sesMail']);

    if ($_SESSION['logged'] == 1) {
        $editMeno = $pouzivatel->getMeno();
        $editLast = $pouzivatel->getPriezvisko();
        $editMail = $pouzivatel->getMail();
        $editMesto = $pouzivatel->getMesto();
        $editUlica = $pouzivatel->getUlica();
        $staryMail = $pouzivatel->getMail();
    }
}


if (isset($_GET['potvrdit'])) {

    $editMeno = $_REQUEST['meno'];
    $editLast = $_REQUEST['priezvisko'];
    $editMail = $_REQUEST['mail'];
    $editMesto = $_REQUEST['mesto'];
    $editUlica = $_REQUEST['ulica'];



        $upravenyPouzivatel = new Pouzivatel();



        $inpValidator = new InputValidator();

        $nameErr = $inpValidator->validateFirstName($editMeno);
        $lastErr = $inpValidator->validateLastName($editLast);

        if ($_SESSION['titulPreFormu'] == "Edit profile") {
        if (strcmp($_SESSION['sesMail'], $editMail) != 0) {
            $mailErr = $inpValidator->validateMail($editMail);
        }} else {
            $mailErr = $inpValidator->validateMailForPersonal($editMail);
        }

        $cityErr = $inpValidator->validateCity($editMesto);
        $ulicaErr = $inpValidator->validateStreet($editUlica);


        if (strcmp($nameErr, " ") != 0 || strcmp($lastErr, " ") != 0 ||
            strcmp($mailErr, " ") != 0 || strcmp($cityErr, " ") != 0 ||
            strcmp($ulicaErr, " ") != 0) {


        } else {

            if ($_SESSION['titulPreFormu'] == "Edit profile") {
                $upravenyPouzivatel->setMeno($editMeno);
                $upravenyPouzivatel->setPriezvisko($editLast);
                $upravenyPouzivatel->setMail($editMail);
                $upravenyPouzivatel->setMesto($editMesto);
                $upravenyPouzivatel->setUlica($editUlica);
                $upravenyPouzivatel->setDruhyMail($staryMail);


                $db->upravInfoPouzivatela($upravenyPouzivatel);

                $_SESSION['sesMail'] = $editMail;

                header("location: ../View/AccountStarter.php");
                die();
            } else {
                $_SESSION['ordMeno'] = $editMeno;
                $_SESSION['ordPriezvisko'] = $editLast;
                $_SESSION['ordMail'] = $editMail;
                $_SESSION['ordMesto'] = $editMesto;
                $_SESSION['ordUlica'] = $editUlica;


                header("location: ../View/VolbaDopravy.php");
            }
            

        }


}