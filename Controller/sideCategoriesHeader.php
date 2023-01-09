<?php

ob_start();


if (!isset($_SESSION)) {
    session_start();
}

if (isset($_GET['hlavnaKategoria'])) {
    $_SESSION['currentPageNumber'] = 1;
    $kategoria = $_GET['hlavnaKategoria'];
    $_SESSION['filterBy'] = "hlavna";
    $_SESSION['choosenCategorySES'] = $kategoria;

    header("location: ../View/ProductsLayout.php");
    die();

}

if (isset($_GET['podKategoria'])) {
    $_SESSION['currentPageNumber'] = 1;
    $kategoria = $_GET['podKategoria'];
    $_SESSION['filterBy'] = "pod";
    $_SESSION['choosenCategorySES'] = $kategoria;

    header("location: ../View/ProductsLayout.php");
    die();

}



ob_end_flush();
