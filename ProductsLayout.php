<?php
include "LogginManager.php";
include "Database.php";
include "ProductShowingManager.php";
include "OutputFormator.php";

ob_start();

$loginManager = new LogginManager();
$outFormator = new OutputFormator();


session_start();


$db = new Database();

$productShowingManager = new ProductShowingManager();

$chosenCategory = $_SESSION['choosenCategorySES'];
$wayOfFiltering = $_SESSION['filterBy'];

$produkty = null;

if ($wayOfFiltering == "hlavna") {
    $produkty = $db->dajProduktyHlavnejKategorie($chosenCategory);
} else if ($wayOfFiltering == "pod") {
    $produkty = $db->dajProduktyPodKategorie($chosenCategory);
} else {
    $produkty = $db->dajProduktyPodlaVyrobcu($chosenCategory);
}






if (isset($_SESSION['currentPageNumber'])) {
    $currentPage = $_SESSION['currentPageNumber'];
}

$pocetProduktov = sizeof($produkty);

$helpIndexForPrintingProducts = ($currentPage - 1) * 10;

$numberOfFirst = $helpIndexForPrintingProducts + 1;



$arrayForPrintingNumbers = array();
$arrayOfPrizes = array();

$cenyProduktov = array();



for ($i = 0; $i < 10; $i++) {
    $arrayForPrintingNumbers[$i] = $helpIndexForPrintingProducts + $i;

    if ($productShowingManager->shouldShowNextProduct($arrayForPrintingNumbers[$i] , $pocetProduktov)) {
        $idProduktu = $produkty[$arrayForPrintingNumbers[$i]]->getIdProduktu();
        $cenyProduktov[$i] = $db->dajNajnizsieCenyProduktov($idProduktu);
    }
}











$stranky = array('prvaStranka', 'druhaStranka', 'tretiaStranka', 'stvrtaStranka','piataStranka');


for ($i = 0; $i < 5; $i++) {
    if (isset($_GET[$stranky[$i]])) {

        $_SESSION['currentPageNumber'] = $i + 1;
        header("location: ProductsLayout.php");
        die();

    }
}

if(isset($_GET['tlacidloSpat'])) {
    $_SESSION['currentPageNumber']--;
    header("location: ProductsLayout.php");
    die();

}

if(isset($_GET['tlacidloDalej'])) {
    $_SESSION['currentPageNumber']++;
    header("location: ProductsLayout.php");
    die();

}
if(isset($_GET['currentProduct'])) {
    $chosenProduct = $_GET['currentProduct'];


    for ($i = 0; $i < 10; $i++) {
        if ($chosenProduct == $i) {

            $idOfChosenProcut = $produkty[$arrayForPrintingNumbers[$i]]->getIdProduktu();
            $_SESSION['currentProductId'] = $idOfChosenProcut;


        }
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

                <?php for($i = 0; $i < 5; $i++) {?>
                <div class="best-products-column-image">

                    <?php if ($productShowingManager->shouldShowNextProduct($arrayForPrintingNumbers[$i] , $pocetProduktov)) {?>

                            <a href="?currentProduct=<?php echo $i?>" >
                     <img src=<?php  echo $produkty[$arrayForPrintingNumbers[$i]]->getCestaKObrazku()?> alt=""  >



                        <div class="best-products-effect" >
                    <h1> <?php echo $produkty[$arrayForPrintingNumbers[$i]]->getNazovProduktu()?> </h1>
                        </div>
                            </a>
                    <p> <?php echo $outFormator->editPrize($cenyProduktov[$i])?> </p>
                    <?php } ?>


                </div>
                <?php }?>


            </div>

            <div class="best-products-row">

                <div class="separator">


                </div>

                <?php for($i = 5; $i < 10; $i++) {?>
                    <div class="best-products-column-image">

                        <?php if ($productShowingManager->shouldShowNextProduct($arrayForPrintingNumbers[$i] , $pocetProduktov)) {?>

                            <a href="?currentProduct=<?php echo $i?>" >
                                <img src=<?php  echo $produkty[$arrayForPrintingNumbers[$i]]->getCestaKObrazku()?> alt=""  >



                                <div class="best-products-effect" >
                                    <h1> <?php echo $produkty[$arrayForPrintingNumbers[$i]]->getNazovProduktu()?> </h1>
                                </div>
                            </a>
                            <p> <?php echo $outFormator->editPrize($cenyProduktov[$i])?> </p>
                        <?php } ?>


                    </div>
                <?php }?>


            </div>


        </section>

        <div class="pageNumebrsBox">

            <form>

                <?php if ($productShowingManager->showBackButton($currentPage)) { ?>
                    <input type="submit" name="tlacidloSpat" value="←">
                <?php } ?>



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

                <?php if ($productShowingManager->showNextButton($currentPage, $pocetProduktov)) { ?>
                    <input type="submit" name="tlacidloDalej" value="→">
                <?php } ?>


            </form>


        </div>

        <div class = "infoAboutHowManyProducts" >
            <h1>Showing <?php echo $numberOfFirst?> to <?php echo $productShowingManager->getLastProductOfPage() + 1?> of <?php echo $pocetProduktov?> items</h1>


        </div>


        <?php
        include_once "sideCategories.php";

        ?>

    </section>


</body>
</html>