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

$helpIndex = ($currentPage - 1) * 10;


echo sizeof($produkty);
echo $produkty[0]["nazovProduktu"];

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
    <section class = "header">

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


                    <?php if ($productShowingManager->shouldShowNextProduct($currentPage,$helpIndex , $pocetProduktov)) {?>

                     <img src=<?php  echo $produkty[$helpIndex]["cestaKObrazku"]?> alt=""  >

                    <h1> <?php echo $produkty[$helpIndex]["nazovProduktu"]?> </h1>
                    <p> <?php echo $produkty[$helpIndex]["cena"]?> </p>
                    <?php } ?>


                </div>

                <div class="best-products-column-image">


                    <?php if ($productShowingManager->shouldShowNextProduct($currentPage,$helpIndex + 1 , $pocetProduktov)) {?>

                        <img src=<?php  echo $produkty[$helpIndex + 1]["cestaKObrazku"]?> alt=""  >

                        <h1> <?php echo $produkty[$helpIndex + 1]["nazovProduktu"]?> </h1>
                        <p> <?php echo $produkty[$helpIndex + 1]["cena"]?> </p>
                    <?php } ?>


                </div>

                <div class="best-products-column-image">


                    <?php if ($productShowingManager->shouldShowNextProduct($currentPage,$helpIndex + 2 , $pocetProduktov)) {?>

                        <img src=<?php  echo $produkty[$helpIndex + 2]["cestaKObrazku"]?> alt=""  >

                        <h1> <?php echo $produkty[$helpIndex + 2]["nazovProduktu"]?> </h1>
                        <p> <?php echo $produkty[$helpIndex + 2]["cena"]?> </p>
                    <?php } ?>


                </div>

                <div class="best-products-column-image">


                    <?php if ($productShowingManager->shouldShowNextProduct($currentPage,$helpIndex + 3 , $pocetProduktov)) {?>

                        <img src=<?php  echo $produkty[$helpIndex + 3]["cestaKObrazku"]?> alt=""  >

                        <h1> <?php echo $produkty[$helpIndex + 3]["nazovProduktu"]?> </h1>
                        <p> <?php echo $produkty[$helpIndex + 3]["cena"]?> </p>
                    <?php } ?>


                </div>

                <div class="best-products-column-image">


                    <?php if ($productShowingManager->shouldShowNextProduct($currentPage,$helpIndex + 4 , $pocetProduktov)) {?>

                        <img src=<?php  echo $produkty[$helpIndex + 4]["cestaKObrazku"]?> alt=""  >

                        <h1> <?php echo $produkty[$helpIndex + 4]["nazovProduktu"]?> </h1>
                        <p> <?php echo $produkty[$helpIndex + 4]["cena"]?> </p>
                    <?php } ?>


                </div>








            </div>




            <div class="best-products-row">

                <div class="separator">


                </div>



                <div class="best-products-column-image">


                    <?php if ($productShowingManager->shouldShowNextProduct($currentPage,$helpIndex + 5 , $pocetProduktov)) {?>

                        <img src=<?php  echo $produkty[$helpIndex + 5]["cestaKObrazku"]?> alt=""  >

                        <h1> <?php echo $produkty[$helpIndex + 5]["nazovProduktu"]?> </h1>
                        <p> <?php echo $produkty[$helpIndex + 5]["cena"]?> </p>
                    <?php } ?>


                </div>

                <div class="best-products-column-image">


                    <?php if ($productShowingManager->shouldShowNextProduct($currentPage,$helpIndex + 6 , $pocetProduktov)) {?>

                        <img src=<?php  echo $produkty[$helpIndex + 6]["cestaKObrazku"]?> alt=""  >

                        <h1> <?php echo $produkty[$helpIndex + 6]["nazovProduktu"]?> </h1>
                        <p> <?php echo $produkty[$helpIndex + 6]["cena"]?> </p>
                    <?php } ?>


                </div>

                <div class="best-products-column-image">


                    <?php if ($productShowingManager->shouldShowNextProduct($currentPage,$helpIndex + 7 , $pocetProduktov)) {?>

                        <img src=<?php  echo $produkty[$helpIndex + 7]["cestaKObrazku"]?> alt=""  >

                        <h1> <?php echo $produkty[$helpIndex + 7]["nazovProduktu"]?> </h1>
                        <p> <?php echo $produkty[$helpIndex + 7]["cena"]?> </p>
                    <?php } ?>


                </div>

                <div class="best-products-column-image">


                    <?php if ($productShowingManager->shouldShowNextProduct($currentPage,$helpIndex + 8 , $pocetProduktov)) {?>

                        <img src=<?php  echo $produkty[$helpIndex + 8]["cestaKObrazku"]?> alt=""  >

                        <h1> <?php echo $produkty[$helpIndex + 8]["nazovProduktu"]?> </h1>
                        <p> <?php echo $produkty[$helpIndex + 8]["cena"]?> </p>
                    <?php } ?>


                </div>

                <div class="best-products-column-image">


                    <?php if ($productShowingManager->shouldShowNextProduct($currentPage,$helpIndex + 9 , $pocetProduktov)) {?>

                        <img src=<?php  echo $produkty[$helpIndex + 9]["cestaKObrazku"]?> alt=""  >

                        <h1> <?php echo $produkty[$helpIndex + 9]["nazovProduktu"]?> </h1>
                        <p> <?php echo $produkty[$helpIndex + 9]["cena"]?> </p>
                    <?php } ?>


                </div>

                <?php

                $counter = i;
                foreach ($produkty as $riadokProduktu)







            </div>





        </section>

        <nav class="page-numbering">

            <ul>
                <li><a href="" >1</a></li>
                <li><a href="LoginPage.php" > 2</a></li>
                <li><a href="">3</a></li>

            </ul>



        </nav>


        <?php
        include_once "sideCategories.php";

        ?>

    </section>


</body>
</html>