<?php

    include "LogginManager.php";

    session_start();
    $loginManager = new LogginManager();

$user_ip = getUserIP();

$_SESSION['ipcka'] = $user_ip;

function getUserIP() {
    if( array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER) && !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ) {
        if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',')>0) {
            $addr = explode(",",$_SERVER['HTTP_X_FORWARDED_FOR']);
            return trim($addr[0]);
        } else {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
    }
    else {
        return $_SERVER['REMOTE_ADDR'];
    }
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



    <section class = "header">

        <?php

        $loginManager->setLayout();


        ?>
        <div class="main-title">
            <h1>Best products with best prizes!</h1>
            <p>Look at the most favourite products by our customers!</p>

        </div>

        <section class="listed-products">



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