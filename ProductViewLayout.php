<?php

include "LogginManager.php";
include "Database.php";
include "DostupneBalenie.php";
include "DostupnaPrichutPreBalenie.php";


ob_start();

session_start();



$db = new Database();

$aktualneIdProduktu = $_SESSION['currentProductId'];
$infoAboutCurrentProduct = $db->dajInfoOProdukte($aktualneIdProduktu);

$nazovProduktu = $infoAboutCurrentProduct["nazovProduktu"];
$cestaKObrazku = $infoAboutCurrentProduct["cestaKObrazku"];



$warning = "";


$vyrobca = $infoAboutCurrentProduct["vyrobca"];
$podKategoria = $infoAboutCurrentProduct["podKategoria"];
$hlavnaKategoria = $infoAboutCurrentProduct["hlavnaKategoria"];
$lomitko = " >> ";

$hlavnyNadpis = $infoAboutCurrentProduct["hlavnyNadpis"];
$popisProduktu = $infoAboutCurrentProduct["popisProduktu"];

$arrayOfBalenia = $db->dajDostupneBalenia($aktualneIdProduktu);

$defaultCena = $db->dajCenuProduktuPodlaBalenia($aktualneIdProduktu,$arrayOfBalenia[0]->balenie)[0];

$defalutPrichute = $db->dajPrichuteProduktu($aktualneIdProduktu);



$benefity = $infoAboutCurrentProduct["keyBenefits"];

$arrayOfBenefity = null;
if (!is_null($benefity)) {
    $arrayOfBenefity = explode("\n", $benefity);
}

$recomendedDosage = $infoAboutCurrentProduct["dosage"];

$nutricneHodnoty = $infoAboutCurrentProduct["nutricneHodnoty"];


$arrayNutricnych = explode("\n", $nutricneHodnoty);

$zlozenieProduktu = $infoAboutCurrentProduct["zlozenie"];

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
    $_SESSION['filterBy'] = "manufacturer";
    $_SESSION['choosenCategorySES'] = $vyrobca;
    header("location: ProductsLayout.php");
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
    header("location: ProductsLayout.php");
    die();
}


if (isset($_GET['addToBasketButton'])) {
    $idNakupujuceho = $_SESSION['ipcka'];
    if ($_SESSION['logged'] == 1) {
        $pouzivatel = $db->nacitajInfoUzivatela($_SESSION['sesMail']);
        $idNakupujuceho = $pouzivatel->id;
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


?>

<!DOCTYPE html>
<html lang="en" xmlns="">
<head>
    <meta name = "viewport" content ="with=device-width, initial-scale=1.0">
    <title>Supplement engineer</title>
    <link rel="stylesheet" href="css/MainPage.css">
    <meta charset="UTF-8">



</head>



<body>




<script type="text/javascript">

    function getDate() {
        const d = new Date();
        d.setTime(d.getTime() + (2*60*1000));
        let expires = "expires="+ d.toUTCString();

        return expires;

    }

    function getOption() {
        selectElement = document.querySelector('#balenieBox');
        output = selectElement.value;

        const splitArray = output.split("|");

        prize = splitArray[0];
        weight = splitArray[1];

        var obj = new XMLHttpRequest();

        obj.open("GET", "home.txt", true);

        obj.send();

        obj.onreadystatechange = function() {

            document.getElementById("cenaProduktu").innerHTML = prize + " €";
        }


        let expires = getDate();

        document.cookie = "balenie" + "=" + weight + ";" + expires + ";path=/";
        document.cookie = "cena" + "=" + prize + ";" + expires + ";path=/";
    }

    function setFlavour() {
        let expires = getDate();

        selectElement = document.querySelector('#prichutBox');
        prichut = selectElement.value;

        document.cookie = "prichut" + "=" + prichut + ";" + expires + ";path=/";
    }

    function setPieces() {
        selectElement = document.querySelector('#pocetKusovBtn');
        pocet = selectElement.value;

        let expires = getDate();

        document.cookie = "pocetKusov" + "=" + pocet + ";" + expires + ";path=/";
    }
</script>





<section class = "header" >

    <?php

    $loginManager->setLayout();


    ?>

    <div class="navBeforeCategories">
        <a href="index.php"><?php echo "Main page"?></a>

        <p><?php echo $lomitko?></p>

        <a href="?categoryFromProduct=1"><?php echo $hlavnaKategoria?></a>

        <p><?php echo $lomitko?></p>

        <a href="?categoryFromProduct=2"><?php echo $podKategoria?></a>


    </div>

    <div class="productShowingLayout">
        <img src=<?php echo $cestaKObrazku ?>>

        <h1><?php echo $nazovProduktu?></h1>

        <div class="selectBox" >
            <div class="selectPackBox">

            <form id="balenieForm" method="post">
                <label for="balenieBox"></label>
                <select  form = "balenieForm" name="balenieBox" id="balenieBox"  onchange="getOption()" >
                    <?php

                        for ($i = 0; $i < sizeof($arrayOfBalenia); $i++) {
                    ?>
                    <option  value=<?php echo $db->dajCenuProduktuPodlaBalenia($aktualneIdProduktu,$arrayOfBalenia[$i]->balenie)[0]."|".$arrayOfBalenia[$i]->balenie?>><?php echo $arrayOfBalenia[$i]->balenie." g" ?></option>
                    <?php } ?>


                </select>
            </form>

            </div>

            <div class="selectFlavourBox">
                <?php if (sizeof($defalutPrichute) != 0) { ?>

                <form id="prichutForm" method="post">

                    <label for = "prichutBox"></label>
                        <select form = "prichutForm" name="prichutBox" id="prichutBox" onchange="setFlavour()">
                        <?php

                            for ($i = 0; $i < sizeof($defalutPrichute); $i++) {?>
                        <option value=<?php echo $defalutPrichute[$i]->getPrichut()?>><?php echo $defalutPrichute[$i]->getPrichut() ?></option>
                        <?php } ?>
                        </select>

                </form>



                <?php } ?>
            </div>
        </div>


        <h2 id="cenaProduktu"><?php echo $defaultCena." €"?> </h2>
        <h3>Manufacturer:</h3>

        <a href="?chosenManu=1"> <?php echo $vyrobca?></a>





        <form method="post">

            <input type="number" name="pocetKusovBtn" id="pocetKusovBtn" value = 1 min="1" onchange="setPieces()">

        </form>



        <form>
            <input type="submit" name="addToBasketButton" value="Add to&#x00A;basket">
        </form>


        <h4><?php echo $warning?></h4>



    </div>

    <div class="productDescription">

        <h1><?php echo $hlavnyNadpis?></h1>
        <p><?php echo $popisProduktu?></p>



    </div>

    <div class="keyBenefits">

        <h1>Key benefits</h1>
            <?php foreach ($arrayOfBenefity as $benefit) { ?>
                <p><?php echo "• ".$benefit?></p>

            <?php }?>


    </div>

    <div class="dosage">
        <h1>Recommended dosage</h1>
        <p><?php echo $recomendedDosage?></p>

    </div>

    <div class="nutricneHodnoty">
        <h1>Nutritional values</h1>
        <table class="tabulkaNutricnychHodnot">
            <?php foreach ($arrayNutricnych as $riadokNutricnych) {
                $riadok = explode("*", $riadokNutricnych);

            ?>
            <tr>
                <?php foreach ($riadok as $stlpec) { ?>
                <th><?php echo $stlpec?></th>

                <?php } ?>

            </tr>

            <?php
            }
            ?>

        </table>

    </div>

    <div class="zlozenie">
        <h1>Composition</h1>
        <p><?php echo $zlozenieProduktu?></p>

    </div>

    <div class="separator">

    </div>



    <?php
    include_once "sideCategories.php";

    ?>

</section>


</body>
</html>


