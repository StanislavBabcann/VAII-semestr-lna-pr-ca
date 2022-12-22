<?php

define("chosenCategoryConst", 'choosenCategorySES');


$_SESSION['currentPageNumber'] = 1;
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

    function myFunction() {
        deleteBeforeOpenedMenu();
        document.getElementById("myDropdown").classList.toggle("show");

    }

    function myFunction2() {
        deleteBeforeOpenedMenu();
        document.getElementById("myDropdown2").classList.toggle("show");
    }

    function myFunction3() {
        deleteBeforeOpenedMenu();
        document.getElementById("myDropdown3").classList.toggle("show");
    }

    function myFunction4() {
        deleteBeforeOpenedMenu();
        document.getElementById("myDropdown4").classList.toggle("show");
    }

    function myFunction5() {
        deleteBeforeOpenedMenu();
        document.getElementById("myDropdown5").classList.toggle("show");
    }

    function myFunction6() {
        deleteBeforeOpenedMenu();
        document.getElementById("myDropdown6").classList.toggle("show");
    }

    function myFunction7() {
        deleteBeforeOpenedMenu();
        document.getElementById("myDropdown7").classList.toggle("show");
    }

    function myFunction8() {
        deleteBeforeOpenedMenu();
        document.getElementById("myDropdown8").classList.toggle("show");
    }

    function myFunction9() {
        deleteBeforeOpenedMenu();
        document.getElementById("myDropdown9").classList.toggle("show");
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


            <button onclick="myFunction()" id = "prvy" class="dropbtn">Proteins</button>
            <div id="myDropdown" class="dropdown-content">
                <a href="ProductsLayout.php">Whey Protein <?php $_SESSION['choosenCategorySES'] = "Whey protein"?></a>
                <a href="#about"> Protein Blends</a>
                <a href="#contact">Night Protein</a>
                <a href="#contact">Plant-Based Protein</a>
                <a href="#contact">Beef Protein</a>
                <a href="#contact">Soy Protein</a>
            </div>
    </div>

    <div class="dropdown">


        <button onclick="myFunction2()" id = "druhy" class="dropbtn">Weight Gainers</button>
        <div id="myDropdown2" class="dropdown-content">
            <a href="#home">Gainers</a>
            <a href="#about">Slow Release Carbs</a>
            <a href="#contact">Fast Release Carbs</a>
            <a href="#contact">All-in-One</a>
        </div>


    </div>

    <div class="dropdown">


        <button onclick="myFunction3()" class="dropbtn">Amino acids</button>
        <div id="myDropdown3" class="dropdown-content">
            <a href="#home">Complex Amino Acids</a>
            <a href="#about">BCAAs</a>
            <a href="#contact">EAA</a>
            <a href="#contact">Arginine</a>
            <a href="#contact">Glutamine</a>
        </div>


    </div>

    <div class="dropdown">


        <button onclick="myFunction4()" class="dropbtn">Creatine</button>
        <div id="myDropdown4" class="dropdown-content">
            <a href="#home">Creatine Monohydrate</a>
            <a href="#about">Creatine-Other Forms</a>
            <a href="#about">HCL</a>
            <a href="#contact">Multi Component Creatine</a>
        </div>


    </div>

    <div class="dropdown">


        <button onclick="myFunction5()" class="dropbtn">Vitamins</button>
        <div id="myDropdown5" class="dropdown-content">
            <a href="#home">Multivitamin</a>
            <a href="#about">Vitamin A</a>
            <a href="#about">B Vitamins</a>
            <a href="#about">Vitamin C</a>
            <a href="#about">Vitamin D</a>
            <a href="#about">Vitamin E</a>
            <a href="#about">Other Vitamins</a>

        </div>


    </div>

    <div class="dropdown">


        <button onclick="myFunction9()" class="dropbtn">Minerals</button>
        <div id="myDropdown9" class="dropdown-content">
            <a href="#home">Multimineral Supplements</a>
            <a href="#about">Magnesium</a>
            <a href="#about">Calcium</a>
            <a href="#contact">Iron</a>
            <a href="#contact">Zinc</a>
            <a href="#contact">ZMA & ZMB</a>
            <a href="#contact">Other Minerals</a>
        </div>


    </div>

    <div class="dropdown">


        <button onclick="myFunction6()" class="dropbtn">Anabolizers & Pre-Workout Supplements</button>
        <div id="myDropdown6" class="dropdown-content">
            <a href="#home">Pre-Workout Supplements</a>
            <a href="#about">NO Supplements</a>
            <a href="#contact">HMB</a>
            <a href="#contact">Testosterone Support</a>
            <a href="#contact">Caffeine</a>
            <a href="#contact">Beta Alanine</a>
            <a href="#contact">DAA</a>
        </div>


    </div>

    <div class="dropdown">


        <button onclick="myFunction7()" class="dropbtn">Joint Supplements</button>
        <div id="myDropdown7" class="dropdown-content">
            <a href="#home">Complex Joint Supplements</a>
            <a href="#about">Collagen Joint Supplements</a>
            <a href="#about">Glucosamine</a>
            <a href="#contact">Other Joint Supplements</a>
        </div>


    </div>

    <div class="dropdown">


        <button onclick="myFunction8()" class="dropbtn">Fat Burners</button>
        <div id="myDropdown8" class="dropdown-content">
            <a href="#home">Complex Fat Burners</a>
            <a href="#about">L-Carnitine</a>
            <a href="#contact">Thermogenic Fat Burners</a>
            <a href="#contact">Other Fat Burners</a>
        </div>


    </div>

</div>


</body>
</html>



