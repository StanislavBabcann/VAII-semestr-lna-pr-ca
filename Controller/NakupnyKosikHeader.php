<?php
include "LogginManager.php";
include "../Model/Database.php";
include "OutputFormator.php";
include "BasketManager.php";

ob_start();
$loginManager = new LogginManager();

session_start();

$db = new Database();
$outputFormator = new OutputFormator();
$basketManager = new BasketManager();
$idNakupujuceho = $_SESSION['ipcka'];

if (isset($_GET['logged'])) {
    if ($_SESSION['logged'] == 1) {
        $pouzivatel = $db->nacitajInfoUzivatela($_SESSION['sesMail']);
        $idNakupujuceho = $pouzivatel->getId();
    }
}

$produktyKosiku = $db->dajProduktyNakupnehoKosika($idNakupujuceho);


if (isset($_GET['chosenProduct'])) {
    $chosen = $_GET['chosenProduct'];

    $_SESSION['currentProductId'] = $chosen;

    header("location: ../View/ProductViewLayout.php");
    die();
}

if (isset($_GET['deletedItem'])) {
    $chosen = $_GET['deletedItem'];

    $db->zmazPolozkuKosiku($chosen);


    header("location: ../View/NakupnyKosik.php");
    die();
}

if (isset($_GET['deleteBasket'])) {
    $db->vyprazdniKosik($idNakupujuceho);
    header("location: ../View/NakupnyKosik.php");
    die();
}

if (isset($_GET['makeOrderBtn'])) {

    $_SESSION['ordId'] = $idNakupujuceho;
    $_SESSION['idUzivatela'] = $idNakupujuceho;
    $_SESSION['titulPreFormu'] = "Personal information";
    $_SESSION['titulPreButton'] = "Continue";
    header("location: ../View/editprofile.php");
    die();
}

if (isset($_GET['logged'])) {
    if ($_SESSION['logged'] == 1) {
        $pouzivatel = $db->nacitajInfoUzivatela($_SESSION['sesMail']);
        $idNakupujuceho = $pouzivatel->getId();
    }
}
$produktyKosiku = $db->dajProduktyNakupnehoKosika($idNakupujuceho);


if (isset($_GET['deleteBasket'])) {
    if ($_GET['deleteBasket'] == 1) {
        $db->vyprazdniKosik($idNakupujuceho);
    }
}
