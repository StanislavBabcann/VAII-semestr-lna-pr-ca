<?php
include "LogginManager.php";
include "Database.php";
include "ProductForShowingOnPage.php";
include "ProductShowingManager.php";
$loginManager = new LogginManager();

if(!isset($_SESSION))
{
    session_start();
}

$db = new Database();
$productShowingManager = new ProductShowingManager();


$chosenCategory = $_SESSION['choosenCategorySES'];

$produkty = $db->dajProduktyPodKategorie($chosenCategory);
$currentPage = $_SESSION['currentPageNumber'];

$pocetProduktov = sizeof($produkty);

$helpIndexForPrintingProducts = ($currentPage - 1) * 10;

$arrayForPrintingNumbers = array();


for ($i = 0; $i < 10; $i++) {
    $arrayForPrintingNumbers[$i] = $helpIndexForPrintingProducts + $i;

}






$stranky = array('prvaStranka', 'druhaStranka', 'tretiaStranka', 'stvrtaStranka','piataStranka');


for ($i = 0; $i < 5; $i++) {
    if (isset($_GET[$stranky[$i]])) {

        $_SESSION['currentPageNumber'] = $i + 1;
        header("location: ProductsLayout.php");
        die();

    }
}

echo $helpIndexForPrintingProducts;

if(isset($_GET['currentProduct'])) {
    $chosenProduct = $_GET['currentProduct'];



    if ($chosenProduct == '0') {

        $_SESSION['curr'] = $currentPage * 5;


    } else if ($chosenProduct == '1') {

        $_SESSION['curr'] = $helpIndexForPrintingProducts + 1;

    }

    header("location: ProductViewLayout.php");
    die;
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

        <div class="main-title">
            <h1><?php echo $chosenCategory?></h1>


        </div>

        <section class="listed-products">



            <div class="best-products-row">

                <div class="separator">


                </div>



                <div class="best-products-column-image">


                    <?php if ($productShowingManager->shouldShowNextProduct($arrayForPrintingNumbers[0] , $pocetProduktov)) {?>

                            <a href="?currentProduct=0" >
                     <img src=<?php  echo $produkty[$arrayForPrintingNumbers[0]]["cestaKObrazku"]?> alt=""  >



                        <div class="best-products-effect" >
                    <h1> <?php echo $produkty[$arrayForPrintingNumbers[0]]["nazovProduktu"]?> </h1>
                        </div>
                            </a>
                    <p> <?php echo $produkty[$arrayForPrintingNumbers[0]]["cena"]?> </p>
                    <?php } ?>


                </div>

                <div class="best-products-column-image">


                    <?php if ($productShowingManager->shouldShowNextProduct($arrayForPrintingNumbers[1] , $pocetProduktov)) {?>

                    <a href="?currentProduct=1">
                        <img src=<?php  echo $produkty[$arrayForPrintingNumbers[1]]["cestaKObrazku"]?> alt=""  >


                    <div class="best-products-effect" >
                        <h1> <?php echo $produkty[$arrayForPrintingNumbers[1]]["nazovProduktu"]?> </h1>
                    </div>
                    </a>
                        <p> <?php echo $produkty[$arrayForPrintingNumbers[1]]["cena"]?> </p>
                    <?php } ?>


                </div>

                <div class="best-products-column-image">


                    <?php if ($productShowingManager->shouldShowNextProduct($arrayForPrintingNumbers[2] , $pocetProduktov)) {?>

                    <a href="?currentProduct=2">
                        <img src=<?php  echo $produkty[$arrayForPrintingNumbers[2]]["cestaKObrazku"]?> alt=""  >

                        <div class="best-products-effect" >
                            <h1> <?php echo $produkty[$arrayForPrintingNumbers[2]]["nazovProduktu"]?> </h1>
                        </div>
                    </a>

                        <p> <?php echo $produkty[$arrayForPrintingNumbers[2]]["cena"]?> </p>
                    <?php } ?>


                </div>

                <div class="best-products-column-image">


                    <?php if ($productShowingManager->shouldShowNextProduct($arrayForPrintingNumbers[3] , $pocetProduktov)) {?>

                    <a href="?currentProduct=3">
                        <img src=<?php  echo $produkty[$arrayForPrintingNumbers[3]]["cestaKObrazku"]?> alt=""  >

                        <div class="best-products-effect" >
                        <h1> <?php echo $produkty[$arrayForPrintingNumbers[3]]["nazovProduktu"]?> </h1>
                        </div>
                    </a>
                        <p> <?php echo $produkty[$arrayForPrintingNumbers[3]]["cena"]?> </p>
                    <?php } ?>


                </div>

                <div class="best-products-column-image">


                    <?php if ($productShowingManager->shouldShowNextProduct($arrayForPrintingNumbers[4] , $pocetProduktov)) {?>

                    <a href="?currentProduct=4">
                        <img src=<?php  echo $produkty[$arrayForPrintingNumbers[4]]["cestaKObrazku"]?> alt=""  >

                        <div class="best-products-effect" >
                        <h1> <?php echo $produkty[$arrayForPrintingNumbers[4]]["nazovProduktu"]?> </h1>
                        </div>
                    </a>
                        <p> <?php echo $produkty[$arrayForPrintingNumbers[4]]["cena"]?> </p>
                    <?php } ?>


                </div>

            </div>


            <div class="best-products-row">

                <div class="separator">


                </div>



                <div class="best-products-column-image">


                    <?php if ($productShowingManager->shouldShowNextProduct($arrayForPrintingNumbers[5] , $pocetProduktov)) {?>

                    <a href="?currentProduct=5">
                        <img src=<?php  echo $produkty[$arrayForPrintingNumbers[5]]["cestaKObrazku"]?> alt=""  >

                        <div class="best-products-effect" >
                        <h1> <?php echo $produkty[$arrayForPrintingNumbers[5]]["nazovProduktu"]?> </h1>
                        </div>
                    </a>
                        <p> <?php echo $produkty[$arrayForPrintingNumbers[5]]["cena"]?> </p>
                    <?php } ?>


                </div>

                <div class="best-products-column-image">


                    <?php if ($productShowingManager->shouldShowNextProduct($arrayForPrintingNumbers[6] , $pocetProduktov)) {?>

                    <a href="?currentProduct=6">
                        <img src=<?php  echo $produkty[$arrayForPrintingNumbers[6]]["cestaKObrazku"]?> alt=""  >

                        <div class="best-products-effect" >
                        <h1> <?php echo $produkty[$arrayForPrintingNumbers[6]]["nazovProduktu"]?> </h1>
                        </div>
                    </a>
                        <p> <?php echo $produkty[$arrayForPrintingNumbers[6]]["cena"]?> </p>
                    <?php } ?>


                </div>

                <div class="best-products-column-image">


                    <?php if ($productShowingManager->shouldShowNextProduct($arrayForPrintingNumbers[7] , $pocetProduktov)) {?>

                    <a href="?currentProduct=7">
                        <img src=<?php  echo $produkty[$arrayForPrintingNumbers[7]]["cestaKObrazku"]?> alt=""  >

                        <div class="best-products-effect" >
                        <h1> <?php echo $produkty[$arrayForPrintingNumbers[7]]["nazovProduktu"]?> </h1>
                        </div>
                    </a>
                        <p> <?php echo $produkty[$arrayForPrintingNumbers[7]]["cena"]?> </p>
                    <?php } ?>


                </div>

                <div class="best-products-column-image">


                    <?php if ($productShowingManager->shouldShowNextProduct($arrayForPrintingNumbers[8] , $pocetProduktov)) {?>

                    <a href="?currentProduct=8">
                        <img src=<?php  echo $produkty[$arrayForPrintingNumbers[8]]["cestaKObrazku"]?> alt=""  >

                        <div class="best-products-effect" >
                        <h1> <?php echo $produkty[$arrayForPrintingNumbers[8]]["nazovProduktu"]?> </h1>
                        </div>
                    </a>
                        <p> <?php echo $produkty[$arrayForPrintingNumbers[8]]["cena"]?> </p>
                    <?php } ?>


                </div>

                <div class="best-products-column-image">


                    <?php if ($productShowingManager->shouldShowNextProduct($arrayForPrintingNumbers[9] , $pocetProduktov)) {?>

                    <a href="?currentProduct=9">
                        <img src=<?php  echo $produkty[$arrayForPrintingNumbers[9]]["cestaKObrazku"]?> alt=""  >

                        <div class="best-products-effect" >
                        <h1> <?php echo $produkty[$arrayForPrintingNumbers[9]]["nazovProduktu"]?> </h1>
                        </div>
                    </a>
                        <p> <?php echo $produkty[$arrayForPrintingNumbers[9]]["cena"]?> </p>
                    <?php } ?>


                </div>

            </div>





        </section>

        <div class="pageNumebrsBox">

            <form>

                <!--
                <?php if ($productShowingManager->showBackButton($currentPage)) { ?>
                    <input type="submit" name="krokSpat"  value="←">
                <?php } ?>
                -->


                <input type="submit" name="prvaStranka" <?php if ($productShowingManager->highlightCurrentPageButton($currentPage, 1)) { ?> style="background-color: #ffc107; color: black" disabled <?php } ?> value="1">

                <?php if ($productShowingManager->shouldShowNextNumberOfPage($pocetProduktov, 2)) { ?>
                    <input type="submit" name="druhaStranka"  <?php if ($productShowingManager->highlightCurrentPageButton($currentPage, 2)) { ?> style="background-color: #ffc107; color: black" disabled <?php } ?> value="2">
                <?php } ?>

                <?php if ($productShowingManager->shouldShowNextNumberOfPage($pocetProduktov, 3)) { ?>
                    <input type="submit" name="tretiaStranka" <?php if ($productShowingManager->highlightCurrentPageButton($currentPage, 3)) { ?> style="background-color: #ffc107; color: black" disabled <?php } ?> value="3">
                <?php } ?>

                <?php if ($productShowingManager->shouldShowNextNumberOfPage($pocetProduktov, 4)) { ?>
                    <input type="submit" name="stvrtaStranka" <?php if ($productShowingManager->highlightCurrentPageButton($currentPage, 4)) { ?> style="background-color: #ffc107; color: black" disabled <?php } ?> value="4">
                <?php } ?>

                <?php if ($productShowingManager->shouldShowNextNumberOfPage($pocetProduktov, 5)) { ?>
                    <input type="submit" name="piataStranka" <?php if ($productShowingManager->highlightCurrentPageButton($currentPage, 5)) { ?> style="background-color: #ffc107; color: black" disabled <?php } ?> value="5">
                <?php } ?>

                <!--
                <?php if ($productShowingManager->showNextButton($currentPage, $pocetProduktov)) { ?>
                    <input type="submit" name="krokDalej" value="→">
                <?php } ?>
                -->


            </form>


        </div>


        <?php
        include_once "sideCategories.php";

        ?>

    </section>


</body>
</html>