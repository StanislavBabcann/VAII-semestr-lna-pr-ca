<?php
include "../Controller/ProductsLayoutHeader.php";
/** @var \Controller\ProductsLayoutHeader $loginManager */
/** @var \Controller\ProductsLayoutHeader $chosenCategory */
/** @var \Controller\ProductsLayoutHeader $productShowingManager */
/** @var \Controller\ProductsLayoutHeader $arrayForPrintingNumbers */
/** @var \Controller\ProductsLayoutHeader $produkty */
/** @var \Controller\ProductsLayoutHeader $outFormator */
/** @var \Controller\ProductsLayoutHeader $cenyProduktov */
/** @var \Controller\ProductsLayoutHeader $pocetProduktov */
/** @var \Controller\ProductsLayoutHeader $currentPage */
/** @var \Controller\ProductsLayoutHeader $numberOfFirst */
/** @var \Controller\ProductsLayoutHeader $mailErr */
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once "head.html"?>


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



                <?php for ($i = 1; $i < 11; $i++) {
                    if ($productShowingManager->shouldShowNextNumberOfPage($pocetProduktov, $i)) {?>
                        <input type="submit" name=<?php echo "stranka".$i ?> <?php if ($productShowingManager->highlightCurrentPageButton($currentPage, $i)) { ?> style="background-color: #ffc107; color: black" disabled <?php } ?> value=<?php echo $i?>>

                <?php }}?>

                <?php if ($productShowingManager->showNextButton($currentPage, $pocetProduktov)) { ?>
                    <input type="submit" name="tlacidloDalej" value="→">
                <?php } ?>


            </form>


        </div>

        <?php if ($pocetProduktov != 0) { ?>
        <div class = "infoAboutHowManyProducts" >
            <h1>Showing <?php echo $numberOfFirst?> to <?php echo $productShowingManager->getLastProductOfPage() + 1?> of <?php echo $pocetProduktov?> items</h1>


        </div>

        <?php }?>


        <?php
        include_once "sideCategories.php";

        ?>

    </section>


</body>
</html>