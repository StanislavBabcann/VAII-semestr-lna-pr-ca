<?php

include "../Controller/LogginManager.php";
include "../Model/Database.php";
include "../Controller/ProductShowingManager.php";
include "../Controller/OutputFormator.php";

ob_start();

$loginManager = new LogginManager();
$outFormator = new OutputFormator();

session_start();

$db = new Database();

//$db->nacitajData();

$productShowingManager = new ProductShowingManager();

$chosenCategory = "Best products";

if (isset($_SESSION['choosenCategorySES'])) {

    $chosenCategory = $_SESSION['choosenCategorySES'];
}


$wayOfFiltering = null;

if (isset($_SESSION['filterBy']) && strcmp($chosenCategory,"Best products") != 0) {

    $wayOfFiltering = $_SESSION['filterBy'];
}

$produkty = null;

if ($wayOfFiltering == "hlavna") {
    $produkty = $db->dajProduktyHlavnejKategorie($chosenCategory);
} else if ($wayOfFiltering == "pod") {
    $produkty = $db->dajProduktyPodKategorie($chosenCategory);
} else if ($wayOfFiltering == "vyrobca"){
    $produkty = $db->dajProduktyPodlaVyrobcu($chosenCategory);
} else {
    $produkty = $db->dajVsetkyProdukty();

    $pomocneProdukty = array();

    for ($i = 0; $i < 50; $i++) {
        $pomocneProdukty[$i] = $produkty[$i];
    }

    $produkty = $pomocneProdukty;
}

$currentPage = 1;
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

$stranky = array();

for ($i = 1; $i < 11; $i++) {
    $nazovPage = "stranka".$i;
    array_push($stranky, $nazovPage);

}
for ($i = 0; $i < 5; $i++) {
    if (isset($_GET[$stranky[$i]])) {

        $_SESSION['currentPageNumber'] = $i + 1;
        header("location: ../View/ProductsLayout.php");
        die();

    }
}

if(isset($_GET['tlacidloSpat'])) {
    $_SESSION['currentPageNumber']--;
    header("location: ../View/ProductsLayout.php");
    die();

}

if(isset($_GET['tlacidloDalej'])) {
    $_SESSION['currentPageNumber']++;
    header("location: ../View/ProductsLayout.php");
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

    header("location: ../View/ProductViewLayout.php");
    die;
}
