<?php

include "LogginManager.php";
include "Database.php";

session_start();



$loginManager = new LogginManager();

$aktualneIdProduktu = $_SESSION['currentProductId'];



echo $aktualneIdProduktu;

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













    <?php
    include_once "sideCategories.php";

    ?>

</section>


</body>
</html>


