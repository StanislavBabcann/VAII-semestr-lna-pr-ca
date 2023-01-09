<?php
include_once "../Controller/VolbaDopravyHeader.php"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once "head.html"?>
</head>

<body>

<script src="../Script/javascripts.js" language="JavaScript" type="text/javascript">


</script>

<section class = "header" >

    <?php

    $loginManager->setLayout();

    ?>

    <div class = "transportation">
        <h1>Type of transport</h1>

        <form method="get">
            <input type="radio" id="radioKurier" name="radioDoprava" value="Kuriér GLS" checked="checked" onchange="setDoprava(this.value)">
            <label for="radioKurier">Kuriér GLS                        1,90€</label>
            <p>Vaša zásielka bude doručená do 24 hodín</p>

            <input type="radio" id="radioOsobny" name="radioDoprava" value="Osobný odber v Žiline" onchange="setDoprava(this.value)">
            <label for="radioOsobny">Osobný odber v Žiline      ZADARMO</label>
            <p>Osobný odber na adrese Za Plavárňou 3, Žilina</p>


        </form>


    </div>

    <div class = "payment">
        <h1>Type of payment</h1>

        <form method="get">
            <input type="radio" id="radioDobierka" name="radioPlatba" value="dobierka" checked="checked" onchange="setPlatba(this.value)">
            <label for="radioDobierka">Platba dobierkou               1,00 €</label>
            <p>(možné platiť aj kartou)</p>

            <input type="radio" id="radioNaUcet" name="radioPlatba" value="prevodom na účet" onchange="setPlatba(this.value)">
            <label for="radioNaUcet">Na účet</label>

            <input type="radio" id="radioKarta" name="radioPlatba" value="kartou online" onchange="setPlatba(this.value)">
            <label for="radioKarta">Kartou online</label>
            <p>(cez platobnú bránu Stripe)</p>



        </form>

    </div>

    <div class = "makeOrder">
        <form>
        <input type="submit" name="odosliObjednavku" value="MAKE ORDER">
        </form>


    </div>







    <?php
    include_once "sideCategories.php";

    ?>

</section>


</body>
</html>

