<?php
    session_start();



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name = "viewport" content ="with=device-width, initial-scale=1.0">
    <title>Supplement engineer</title>
    <link rel="stylesheet" href="MainPage.css">
    <meta charset="UTF-8">



</head>
<body>



    <section class = "header">

        <?php

        if (isset($_SESSION['logged'])) {
            if ($_SESSION['logged'] == 0) {
                include_once "unloggedUserLayout.php";
            } else {
                include_once "loggedUserLayout.php";
            }
        } else {
            include_once "unloggedUserLayout.php";
        }


        ?>
        <div class="main-title">
            <h1>Best products with best prizes!</h1>
            <p>Look at the most favourite products by our customers!</p>

        </div>

        <section class="best-products-canvas">



            <div class="best-products-row">

                <div class="best-products-column-image">

                    <img src="images/LevroneGainer.png" alt="">
                    <div class = "best-products-layer">
                        <h3>Anabolic Mass</h3>
                    </div>
                </div>

                <div class="best-products-column-image">

                    <img src="images/ScitecProtein.png" alt="">
                    <div class = "best-products-layer">
                        <h3>Scitec 100% whey</h3>
                    </div>
                </div>

                <div class="best-products-column-image" >

                    <img src="images/Scatterbrain.png" alt="">
                    <div class = "best-products-layer">
                        <h3>Scatterbrain</h3>
                    </div>
                </div>

            </div>


            <div class="best-products-row">
                <div class="best-products-column-image">

                    <img src="images/TshirtCV.png" alt="">
                    <div class = "best-products-layer">
                        <h3>T-shirt Czcech Virus</h3>
                    </div>
                </div>

                <div class="best-products-column-image">

                    <img src="images/ReflexCreatine.png" alt="">
                    <div class = "best-products-layer">
                        <h3>Creapure Creatine</h3>
                    </div>
                </div>

                <div class="best-products-column-image">

                    <img src="images/Biosterol.png" alt="">
                    <div class = "best-products-layer">
                        <h3>Biosterol - Megabol</h3>
                    </div>
                </div>


            </div>



        </section>
        <?php
        include_once "sideCategories.php";

        ?>

    </section>


</body>
</html>