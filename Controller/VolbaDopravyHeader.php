<?php

session_start();

include "LogginManager.php";
include "../Model/Database.php";
include "OutputFormator.php";


$loginManager = new LogginManager();
$db = new Database();

$meno = $_SESSION['ordMeno'];
$priezvisko = $_SESSION['ordPriezvisko'];
$mail = $_SESSION['ordMail'];
$mesto = $_SESSION['ordMesto'];
$ulica = $_SESSION['ordUlica'];
$idNakupujuceho = $_SESSION['ordId'];


if (isset($_GET['odosliObjednavku'])) {

    $datum = date("Y m d");
    $cas = date("h i a");
    $nazovSuboru = $meno." ".$priezvisko." ".$datum."; ".$cas;
    $directory = '../objednavky';

    if ( !file_exists($directory) ) {
        mkdir($directory, 0744);
    }

    //file_put_contents ($directory."/".$nazovSuboru, 'Hello File');

    $produktyNakupujuceho = $db->dajProduktyNakupnehoKosika($idNakupujuceho);

    $vystup = "Meno: ".$meno."\n";
    $vystup = $vystup."Priezvisko: ".$priezvisko."\n";
    $vystup = $vystup."Emailova adresa: ".$mail."\n";
    $vystup = $vystup."Mesto: ".$mesto."\n";
    $vystup = $vystup."Ulica: ".$ulica."\n";
    $vystup = $vystup."\n";
    $vystup = $vystup."Objednane produkty:\n";

    $paddingNum = 30;
    $paddingNum2 = 15;
    $vystup = $vystup.str_pad("Nazov", $paddingNum).str_pad("Balenie", $paddingNum2).str_pad("Prichut", $paddingNum2).str_pad("Pocet kusov", $paddingNum2).str_pad("Cena", $paddingNum2).str_pad("Cena celkovo", $paddingNum2)."\n";




    $outFormator = new OutputFormator();

    $celkovaCena = 0.0;
    foreach ($produktyNakupujuceho as $jedenProdukt) {
        $idProduktu = $jedenProdukt->getIdProduktu();
        $hmotnost = $jedenProdukt->getBalenie();
        $prichut = $jedenProdukt->getPrichut();
        $cena = $jedenProdukt->getCena();
        $pocetKusov = $jedenProdukt->getPocetKusov();

        $celkovaCena += $cena * $pocetKusov;

        $cenaSpolu = $outFormator->editPrizeForMultipleItems($cena, $pocetKusov);
        $cena = $outFormator->editPrize($cena);

        $produkt = $db->dajInfoOProdukte($idProduktu);
        $nazovProduktu = $produkt->getNazovProduktu();

        $vystup = $vystup.str_pad($nazovProduktu, $paddingNum).str_pad(strval($hmotnost), $paddingNum2).str_pad(strval($prichut), $paddingNum2).str_pad(strval($pocetKusov), $paddingNum2).str_pad(strval($cena), $paddingNum2 + 2).str_pad(strval($cenaSpolu), $paddingNum2)."\n";




        $db->odoberVariantProduktuZoSkladu($idProduktu, $hmotnost);
    }

    $vystup = $vystup."\n";




    $doprava = "Kuriér GLS";
    if(isset($_COOKIE['doprava'])) {
        $doprava = $_COOKIE["doprava"];
    }

    $vystup = $vystup."Spôsob dopravy: ".$doprava."\n";

    $platba = "dobierka";

    if(isset($_COOKIE['platba'])) {
        $platba = $_COOKIE["platba"];
    }

    $vystup = $vystup."Spôsob platby: ".$platba."\n";

    $kodKuponu = null;
    $zlava = null;

    if(isset($_COOKIE['kodKuponu'])) {
        $kodKuponu = $_COOKIE["kodKuponu"];
        $zlava = $_COOKIE["kupon"];

        $vystup = $vystup."\n";

        $vystup = $vystup."Uplatneni kupon: ".$kodKuponu.", zlava: ".$zlava."%\n";
        $sumaSKuponom = $celkovaCena - ($celkovaCena / 100 * $zlava);
        $sumaSKuponom = $outFormator->editPrize($sumaSKuponom);
        $vystup = $vystup."Suma spolu po uplatneni kuponu: ".$sumaSKuponom;

        setcookie("kodKuponu", 1, time()-3600, "/");
        setcookie("kupon", 1, time()-3600, "/");
    }

    if ($kodKuponu != null) {
        $db->pouziKupon($kodKuponu);
    }





    $celkovaCenaSDph = $outFormator->editPrize($celkovaCena);

    $vystup = $vystup."\n";

    $vystup = $vystup."Suma spolu: ".$celkovaCenaSDph."\n";

    $celkovaCena = $celkovaCena * 0.8;

    $cenaBezDph = $outFormator->editPrize($celkovaCena);

    $vystup = $vystup."Suma spolu bez DPH: ".$cenaBezDph."\n";


    file_put_contents ($directory."/".$nazovSuboru, $vystup);

    $db->vyprazdniKosik($idNakupujuceho);
    $_SESSION['choosenCategorySES'] = "Best products";
    header("location: ../View/ProductsLayout.php");
    die();
}
