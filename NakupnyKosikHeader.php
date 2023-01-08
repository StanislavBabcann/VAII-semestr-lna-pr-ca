<?php

ob_start();
$loginManager = new LogginManager();

$db = new Database();

$outputFormator = new OutputFormator();

$basketManager = new BasketManager();

session_start();
$pouzivatel = $db->nacitajInfoUzivatela($_SESSION['sesMail']);
$idNakupujuceho = $_SESSION['ipcka'];

if ($_SESSION['logged'] == 1) {
    $pouzivatel = $db->nacitajInfoUzivatela($_SESSION['sesMail']);
    $idNakupujuceho = $pouzivatel->id;
}

$produktyKosiku = $db->dajProduktyNakupnehoKosika($idNakupujuceho);


if (isset($_GET['chosenProduct'])) {
    $chosen = $_GET['chosenProduct'];

    $_SESSION['currentProductId'] = $chosen;

    header("location: ProductViewLayout.php");
    die();
}

if (isset($_GET['deletedItem'])) {
    $chosen = $_GET['deletedItem'];

    $db->zmazPolozkuKosiku($chosen);


    header("location: NakupnyKosik.php");
    die();
}

if (isset($_GET['deleteBasket'])) {
    $db->vyprazdniKosik($idNakupujuceho);
    header("location: NakupnyKosik.php");
    die();
}

if (isset($_GET['makeOrderBtn'])) {

    $_SESSION['ordId'] = $idNakupujuceho;
    $_SESSION['idUzivatela'] = $idNakupujuceho;
    $_SESSION['titulPreFormu'] = "Personal information";
    $_SESSION['titulPreButton'] = "Continue";
    header("location: editprofile.php");
    die();
}
