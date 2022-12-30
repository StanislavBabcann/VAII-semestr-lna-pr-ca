<?php

ob_start();

define("chosenCategoryConst", 'choosenCategorySES');

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_GET['hlavnaKategoria'])) {
    $_SESSION['currentPageNumber'] = 1;
    $kategoria = $_GET['hlavnaKategoria'];
    $_SESSION['filterBy'] = "hlavna";
    $_SESSION['choosenCategorySES'] = $kategoria;

    header("location: ProductsLayout.php");
    die();

}

if (isset($_GET['podKategoria'])) {
    $_SESSION['currentPageNumber'] = 1;
    $kategoria = $_GET['podKategoria'];
    $_SESSION['filterBy'] = "pod";
    $_SESSION['choosenCategorySES'] = $kategoria;

    header("location: ProductsLayout.php");
    die();

}



ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name = "viewport" content ="with=device-width, initial-scale=1.0">
    <title>Supplement engineer</title>
    <link rel="stylesheet" href="css/sideCategories.css">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.0/css/fontawesome.min.css">


</head>
<body>

<script>

    const ids = ["myDropdown", "myDropdown2","myDropdown3","myDropdown4","myDropdown5","myDropdown6",
        "myDropdown7","myDropdown8","myDropdown9"];

    function myFunction(number) {
        deleteBeforeOpenedMenu();
        document.getElementById(ids[number]).classList.toggle("show");

    }



    function deleteBeforeOpenedMenu() {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }

    window.onclick = function(event) {
        if (!event.target.matches('.dropbtn')) {
            deleteBeforeOpenedMenu();
        }
    }


</script>



<div class="text-box">


    <div class="dropdown">


            <button onclick="myFunction(0)" id = "prvy" class="dropbtn">PROTEINS</button>
            <div id="myDropdown" class="dropdown-content">
                <a href="?hlavnaKategoria=Protein powder">ALL</a>
                <a href="?podKategoria=Whey">WHEY</a>
                <a href="?podKategoria=Casein">CASEIN</a>
                <a href="?podKategoria=Blends">BLENDS</a>
                <a href="?podKategoria=Vegan">VEGAN</a>
                <a href="?podKategoria=Other protein">OTHER(BEEF, EGG...)</a>
            </div>
    </div>

    <div class="dropdown">


        <button onclick="myFunction(1)" id = "druhy" class="dropbtn">WEIGHT GAINERS</button>
        <div id="myDropdown2" class="dropdown-content">
            <a href="?hlavnaKategoria=Gainers">All</a>
            <a href="?podKategoria=Gainers">GAINERS</a>
            <a href="?podKategoria=Sacharidcs">SACHARIDS</a>
        </div>


    </div>

    <div class="dropdown">


        <button onclick="myFunction(2)" class="dropbtn">CREATINE</button>
        <div id="myDropdown3" class="dropdown-content">
            <a href="?hlavnaKategoria=Creatine">ALL</a>
            <a href="?podKategoria=Monohydrate">MONOHYDRATE</a>
            <a href="?podKategoria=Multi-component">MULTI-COMPONENT</a>
            <a href="?podKategoria=Other creatine">OTHER</a>
        </div>


    </div>

    <div class="dropdown">


        <button onclick="myFunction(3)" class="dropbtn">AMINO ACIDS</button>
        <div id="myDropdown4" class="dropdown-content">
            <a href="?hlavnaKategoria=Amino acids">ALL</a>
            <a href="?podKategoria=BCAA">BCAA</a>
            <a href="?podKategoria=Glutamine">GLUTAMINE</a>
            <a href="?podKategoria=Arginine">ARGININE</a>
            <a href="?podKategoria=Single creatine">SINGLE COMPONENT</a>
            <a href="?podKategoria=Multi creatine">MULTI COMPONENT</a>
        </div>


    </div>

    <div class="dropdown">


        <button onclick="myFunction(4)" class="dropbtn">PRE-WORKOUT PUMPS</button>
        <div id="myDropdown5" class="dropdown-content">
            <a href="?hlavnaKategoria=Pre-workout pumps">ALL</a>
            <a href="?podKategoria=With stimulants">WITH STIMULANTS</a>
            <a href="?podKategoria=Without stimulants">WITHOUT STIMULANTS</a>
        </div>


    </div>

    <div class="dropdown">


        <button onclick="myFunction(5)" class="dropbtn">FAT BURNERS</button>
        <div id="myDropdown6" class="dropdown-content">
            <a href="?hlavnaKategoria=Fat burners">ALL</a>
            <a href="?podKategoria=L-carnitine">L-CARNITINE</a>
            <a href="?podKategoria=Single burner">SINGLE COMPONENT</a>
            <a href="?podKategoria=Complex burner">COMPLEX</a>
        </div>


    </div>

    <div class="dropdown">


        <button onclick="myFunction(6)" class="dropbtn">JOINT NUTRITION</button>
        <div id="myDropdown7" class="dropdown-content">
            <a href="?hlavnaKategoria=Joint nutrition">ALL</a>
            <a href="?podKategoria=Single joint">SINGLE COMPONENT</a>
            <a href="?podKategoria=Multi joint">MULTI COMPONENT</a>
        </div>


    </div>

    <div class="dropdown">


        <button onclick="myFunction(7)" class="dropbtn">VITAMINS & MINERALS</button>
        <div id="myDropdown8" class="dropdown-content">
            <a href="?hlavnaKategoria=VITAMINS & MINERALS">ALL</a>
            <a href="?podKategoria=Single vitamin">SINGLE COMPONENT</a>
            <a href="?podKategoria=Multi vitamin">COMPLEX</a>
            <a href="?podKategoria=Omega">OMEGA FATTY ACIDS</a>
        </div>


    </div>

    <div class="dropdown">


        <button onclick="myFunction(8)" class="dropbtn">CLOTHES</button>
        <div id="myDropdown9" class="dropdown-content">
            <a href="?hlavnaKategoria=Clothes">ALL</a>
            <a href="?podKategoria=t-shirt">T-SHIRT</a>
            <a href="?podKategoria=tank top">TANK TOP</a>
        </div>


    </div>

</div>


</body>
</html>



