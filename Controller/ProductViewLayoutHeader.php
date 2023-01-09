<?php

include "LogginManager.php";
include "../Model/Database.php";
include "../Model/DostupneBalenie.php";
include "../Model/DostupnaPrichutPreBalenie.php";

ob_start();

session_start();



$db = new Database();

$aktualneIdProduktu = $_SESSION['currentProductId'];
$infoAboutCurrentProduct = $db->dajInfoOProdukte($aktualneIdProduktu);

$nazovProduktu = $infoAboutCurrentProduct->getNazovProduktu();
$cestaKObrazku = $infoAboutCurrentProduct->getCestaKObrazku();



$warning = "";


$vyrobca = $infoAboutCurrentProduct->getVyrobca();
$podKategoria = $infoAboutCurrentProduct->getPodKategoria();
$hlavnaKategoria = $infoAboutCurrentProduct->getHlavnaKategoria();
$lomitko = " >> ";

$hlavnyNadpis = $infoAboutCurrentProduct->getHlavnyNadpis();
$popisProduktu = $infoAboutCurrentProduct->getPopisProduktu();

$arrayOfBalenia = $db->dajDostupneBalenia($aktualneIdProduktu);

$defaultCena = $db->dajCenuProduktuPodlaBalenia($aktualneIdProduktu,$arrayOfBalenia[0]->balenie)[0];

$defalutPrichute = $db->dajPrichuteProduktu($aktualneIdProduktu);



$benefity = $infoAboutCurrentProduct->getKeyBenefits();

$arrayOfBenefity = null;
if (!is_null($benefity)) {
    $arrayOfBenefity = explode("\n", $benefity);
}

$recomendedDosage = $infoAboutCurrentProduct->getDosage();

$nutricneHodnoty = $infoAboutCurrentProduct->getNutricneHodnoty();


$arrayNutricnych = explode("\n", $nutricneHodnoty);

$zlozenieProduktu = $infoAboutCurrentProduct->getZlozenie();

$loginManager = new LogginManager();


if (!isset($_COOKIE['balenie'])) {
    $_COOKIE["balenie"] = $arrayOfBalenia[0]->balenie;
}

if (!isset($_COOKIE['prichut'])) {
    $_COOKIE["prichut"] = $defalutPrichute[0]->getPrichut();
}

if (!isset($_COOKIE['pocetKusov'])) {
    $_COOKIE["pocetKusov"] = 1;
}




if (isset($_GET['chosenManu'])) {
    $_SESSION['filterBy'] = "vyrobca";
    $_SESSION['choosenCategorySES'] = $vyrobca;
    header("location: ../View/ProductsLayout.php");
    die();
}

if (isset($_GET['categoryFromProduct'])) {
    $chosen = $_GET['categoryFromProduct'];

    if ($chosen == 1) {
        $_SESSION['filterBy'] = "hlavna";
        $_SESSION['choosenCategorySES'] = $hlavnaKategoria;
    } else {
        $_SESSION['filterBy'] = "pod";
        $_SESSION['choosenCategorySES'] = $podKategoria;
    }
    header("location: ../View/ProductsLayout.php");
    die();
}


if (isset($_GET['addToBasketButton'])) {
    $idNakupujuceho = $_SESSION['ipcka'];
    if (isset($_GET['logged'])) {
        if ($_SESSION['logged'] == 1) {
            $pouzivatel = $db->nacitajInfoUzivatela($_SESSION['sesMail']);
            $idNakupujuceho = $pouzivatel->getId();
        }
    }




    $balenie = $_COOKIE["balenie"];


    $prichut = null;
    if (sizeof($defalutPrichute) != 0) {

        $prichut = $_COOKIE["prichut"];

    }



    $pocetKusov = $_COOKIE["pocetKusov"];

    $cenaProduktu = $defaultCena;
    if(isset($_COOKIE['cena'])) {
        $cenaProduktu = $_COOKIE["cena"];
    }

    $pocetNaSklade = $db->dajPocetProduktovNaSkladePodlaIdABalenia($aktualneIdProduktu, $balenie);




    if ($pocetKusov > $pocetNaSklade) {
        $warning = "Lack of items in stock";

    } else {
        $produktKosiku = new ProduktNakupnehoKosiku();

        $produktKosiku->setIdPouzivatela($idNakupujuceho);
        $produktKosiku->setIdProduktu($aktualneIdProduktu);
        $produktKosiku->setPocetKusov($pocetKusov);
        $produktKosiku->setBalenie($balenie);
        $produktKosiku->setPrichut($prichut);
        $produktKosiku->setCena($cenaProduktu);

        $_SESSION['nedostatok'] = 0;

        $db->pridajPolozkuDoProduktovNakupnehoKosika($produktKosiku);
    }


    setcookie("balenie", 1, time()-3600, "/");
    setcookie("prichut", 1, time()-3600, "/");
    setcookie("pocetKusov", 1, time()-3600, "/");
    setcookie("cena", 1, time()-3600, "/");

}
