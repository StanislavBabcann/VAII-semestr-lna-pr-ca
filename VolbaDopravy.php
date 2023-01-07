<?php
session_start();

include "LogginManager.php";
include "Database.php";


$loginManager = new LogginManager();
$db = new Database();

if (isset($_GET['odosliObjednavku'])) {


    $pouzivatel = $db->nacitajInfoUzivatela($_SESSION['sesMail']);
    $idNakupujuceho = $pouzivatel->id;
    $produktyNakupujuceho = $db->dajProduktyNakupnehoKosika($idNakupujuceho);

    foreach ($produktyNakupujuceho as $jedenProdukt) {
        $idProduktu = $jedenProdukt->getIdProduktu();
        $hmotnost = $jedenProdukt->getBalenie();

        $db->odoberVariantProduktuZoSkladu($idProduktu, $hmotnost);
    }
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


</script>

<section class = "header" >

    <?php

    $loginManager->setLayout();

    ?>

    <div class = "transportation">
        <h1>Type of transport</h1>

        <form>
            <input type="radio" id="radioKurier" name="radioDoprava" value="Kuriér GLS">
            <label for="radioKurier">Kuriér GLS                        1,90€</label>
            <p>Vaša zásielka bude doručená do 24 hodín</p>

            <input type="radio" id="radioOsobny" name="radioDoprava" value="Kuriér GLS">
            <label for="radioOsobny">Osobný odber v Žiline      ZADARMO</label>
            <p>Osobný odber na adrese Za Plavárňou 3, Žilina</p>


        </form>


    </div>

    <div class = "payment">
        <h1>Type of payment</h1>

        <form>
            <input type="radio" id="radioDobierka" name="radioPlatba" value="1">
            <label for="radioDobierka">Platba dobierkou               1,00 €</label>
            <p>(možné platiť aj kartou)</p>

            <input type="radio" id="radioNaUcet" name="radioPlatba" value="2">
            <label for="radioNaUcet">Na účet</label>

            <input type="radio" id="radioKarta" name="radioPlatba" value="3">
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

