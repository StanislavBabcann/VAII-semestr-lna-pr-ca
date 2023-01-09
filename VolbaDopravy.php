<?php
session_start();

include "LogginManager.php";
include "Database.php";
include "OutputFormator.php";


$loginManager = new LogginManager();
$db = new Database();

$meno = $_SESSION['ordMeno'];
$priezvisko = $_SESSION['ordPriezvisko'];
$mail = $_SESSION['ordMail'];
$mesto = $_SESSION['ordMesto'];
$ulica = $_SESSION['ordUlica'];
$idNakupujuceho = $_SESSION['ordId'];

echo $meno;
echo $priezvisko;
echo $idNakupujuceho;
echo $mesto;


if (isset($_GET['odosliObjednavku'])) {

    $datum = date("Y m d");
    $cas = date("h i a");
    $nazovSuboru = $meno." ".$priezvisko." ".$datum."; ".$cas;
    $directory = 'objednavky';

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
        $nazovProduktu = $produkt["nazovProduktu"];

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
    header("location: index.php");
    die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name = "viewport" content ="with=device-width, initial-scale=1.0">
    <title>Supplement engineer</title>
    <link rel="stylesheet" href="css/MainPage.css">
    <meta charset="UTF-8">


</head>

<script type="text/javascript">

    function getDate() {
        const d = new Date();
        d.setTime(d.getTime() + (2*60*1000));
        let expires = "expires="+ d.toUTCString();

        return expires;

    }

    function setDoprava(str) {
        let expires = getDate();

        document.cookie = "doprava" + "=" + str + ";" + expires + ";path=/";
    }

    function setPlatba(str) {
        let expires = getDate();

        document.cookie = "platba" + "=" + str + ";" + expires + ";path=/";
    }

</script>

<section class = "header" >

    <?php

    $loginManager->setLayout();

    ?>

    <div class = "transportation">
        <h1>Type of transport</h1>

        <form method="get">
            <input type="radio" id="radioKurier" name="radioDoprava" value="Kuriér GLS" checked="checked" onchange="setDoprava(this.value)">
            <label for="radioKurier">Kuriér GLS                        1,90€</label>
            <p>Vaša zásielka bude doručená do 24 hodín</p>

            <input type="radio" id="radioOsobny" name="radioDoprava" value="Osobný odber v Žiline" onchange="setDoprava(this.value)">
            <label for="radioOsobny">Osobný odber v Žiline      ZADARMO</label>
            <p>Osobný odber na adrese Za Plavárňou 3, Žilina</p>


        </form>


    </div>

    <div class = "payment">
        <h1>Type of payment</h1>

        <form method="get">
            <input type="radio" id="radioDobierka" name="radioPlatba" value="dobierka" checked="checked" onchange="setPlatba(this.value)">
            <label for="radioDobierka">Platba dobierkou               1,00 €</label>
            <p>(možné platiť aj kartou)</p>

            <input type="radio" id="radioNaUcet" name="radioPlatba" value="prevodom na účet" onchange="setPlatba(this.value)">
            <label for="radioNaUcet">Na účet</label>

            <input type="radio" id="radioKarta" name="radioPlatba" value="kartou online" onchange="setPlatba(this.value)">
            <label for="radioKarta">Kartou online</label>
            <p>(cez platobnú bránu Stripe)</p>



        </form>

    </div>

    <div class = "makeOrder">
        <form>
        <input type="submit" name="odosliObjednavku" value="MAKE ORDER">
        </form>


    </div>







    <?php
    include_once "sideCategories.php";

    ?>

</section>


</body>
</html>

