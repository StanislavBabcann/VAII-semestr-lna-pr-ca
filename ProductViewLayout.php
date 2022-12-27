<?php

include "LogginManager.php";
include "Database.php";

ob_start();

session_start();

$db = new Database();

$aktualneIdProduktu = $_SESSION['currentProductId'];
$infoAboutCurrentProduct = $db->dajInfoOProdukte($aktualneIdProduktu);

$nazovProduktu = $infoAboutCurrentProduct["nazovProduktu"];
$cestaKObrazku = $infoAboutCurrentProduct["cestaKObrazku"];
$cenaProduktu = $infoAboutCurrentProduct["cena"];

$balenia = $infoAboutCurrentProduct["hmotnostiBaleni"];
$prichute = $infoAboutCurrentProduct["prichute"];

$vyrobca = $infoAboutCurrentProduct["vyrobca"];
$podKategoria = $infoAboutCurrentProduct["podKategoria"];
$hlavnaKategoria = $infoAboutCurrentProduct["hlavnaKategoria"];
$lomitko = " >> ";

$hlavnyNadpis = $infoAboutCurrentProduct["hlavnyNadpis"];
$popisProduktu = $infoAboutCurrentProduct["popisProduktu"];

$arrayOfBalenia = explode(",", $balenia);

$arrayOfPrichute = null;
if (!is_null($prichute)) {
    $arrayOfPrichute = explode(",", $prichute);
}

$benefity = $infoAboutCurrentProduct["keyBenefits"];

$arrayOfBenefity = null;
if (!is_null($benefity)) {
    $arrayOfBenefity = explode(";", $benefity);
}

$recomendedDosage = $infoAboutCurrentProduct["dosage"];

$nutricneHodnoty = $infoAboutCurrentProduct["nutricneHodnoty"];


$arrayNutricnych = explode(";", $nutricneHodnoty);

$zlozenieProduktu = $infoAboutCurrentProduct["zlozenie"];

$loginManager = new LogginManager();


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








?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name = "viewport" content ="with=device-width, initial-scale=1.0">
    <title>Supplement engineer</title>
    <link rel="stylesheet" href="css/MainPage.css">
    <meta charset="UTF-8">


</head>



<body>
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

        <div class="selectBox">
            <div class="selectPackBox">
                <select name="balenie">
                    <?php
                        foreach ($arrayOfBalenia as $jednoBalenie) {

                    ?>
                    <option value="select"><?php echo $jednoBalenie ?></option>
                    <?php } ?>


                </select>
            </div>

            <div class="selectFlavourBox">
                <?php if (!is_null($arrayOfPrichute)) { ?>
                <select name="prichut">
                    <?php
                    foreach ($arrayOfPrichute as $jednaPrichut) {

                    ?>
                    <option value="select"><?php echo $jednaPrichut ?></option>
                    <?php } ?>

                </select>

                <?php } ?>
            </div>
        </div>


        <h2><?php echo $cenaProduktu?></h2>
        <h3>Manufacturer:</h3>

        <a href="?chosenManu=1"> <?php echo $vyrobca?></a>



        <input type="number" value = 1 min="1">
        <input type="submit" value="Add to&#x00A;basket">



    </div>

    <div class="productDescription">

        <h1><?php echo $hlavnyNadpis?></h1>
        <p><?php echo $popisProduktu?></p>



    </div>

    <div class="keyBenefits">
        <?php if (!is_null($benefity)) {?>
        <h1>Key benefits</h1>
            <?php foreach ($arrayOfBenefity as $benefit) { ?>
                <p><?php echo "• ".$benefit?></p>

            <?php }?>

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

                $prvyStlpec = $riadok[0];
                $druhyStlpec = $riadok[1];

            ?>
            <tr>
                <th><?php echo $prvyStlpec?></th>
                <th><?php echo $druhyStlpec?></th>

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


