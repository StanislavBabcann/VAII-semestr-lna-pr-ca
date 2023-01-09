<?php

include_once "../Controller/ProductViewLayoutHeader.php";


?>

<!DOCTYPE html>
<html lang="en" >
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

    <div class="navBeforeCategories">
        <a href="homePage.php"><?php echo "Main page"?></a>

        <p><?php echo $lomitko?></p>

        <a href="?categoryFromProduct=1"><?php echo $hlavnaKategoria?></a>

        <p><?php echo $lomitko?></p>

        <a href="?categoryFromProduct=2"><?php echo $podKategoria?></a>


    </div>

    <div class="productShowingLayout">
        <img alt=" " src=<?php echo $cestaKObrazku ?>>

        <h1><?php echo $nazovProduktu?></h1>

        <div class="selectBox" >
            <div class="selectPackBox">

            <form id="balenieForm" method="post">
                <label for="balenieBox"></label>
                <select  form = "balenieForm" name="balenieBox" id="balenieBox"  onchange="getOption()" >
                    <?php

                        for ($i = 0; $i < sizeof($arrayOfBalenia); $i++) {
                    ?>
                    <option  value=<?php echo $db->dajCenuProduktuPodlaBalenia($aktualneIdProduktu,$arrayOfBalenia[$i]->balenie)[0]."|".$arrayOfBalenia[$i]->balenie?>><?php echo $arrayOfBalenia[$i]->balenie." g" ?></option>
                    <?php } ?>


                </select>
            </form>

            </div>

            <div class="selectFlavourBox">
                <?php if (sizeof($defalutPrichute) != 0) { ?>

                <form id="prichutForm" method="post">

                    <label for = "prichutBox"></label>
                        <select form = "prichutForm" name="prichutBox" id="prichutBox" onchange="setFlavour()">
                        <?php

                            for ($i = 0; $i < sizeof($defalutPrichute); $i++) {?>
                        <option value=<?php echo $defalutPrichute[$i]->getPrichut()?>><?php echo $defalutPrichute[$i]->getPrichut() ?></option>
                        <?php } ?>
                        </select>

                </form>



                <?php } ?>
            </div>
        </div>


        <h2 id="cenaProduktu"><?php echo $defaultCena." €"?> </h2>
        <h3>Manufacturer:</h3>

        <a href="?chosenManu=1"> <?php echo $vyrobca?></a>





        <form method="post">

            <input type="number" name="pocetKusovBtn" id="pocetKusovBtn" value = 1 min="1" onchange="setPieces()">

        </form>



        <form>
            <input type="submit" name="addToBasketButton" value="Add to&#x00A;basket">
        </form>


        <h4><?php echo $warning?></h4>



    </div>

    <div class="productDescription">

        <h1><?php echo $hlavnyNadpis?></h1>
        <p><?php echo $popisProduktu?></p>



    </div>

    <div class="keyBenefits">

        <h1>Key benefits</h1>
            <?php foreach ($arrayOfBenefity as $benefit) { ?>
                <p><?php echo "• ".$benefit?></p>

            <?php }?>


    </div>

    <div class="dosage">
        <h1>Recommended dosage</h1>
        <p><?php echo $recomendedDosage?></p>

    </div>

    <div class="nutricneHodnoty">
        <h1>Nutritional values</h1>
        <table class="tabulkaNutricnychHodnot">
            <?php foreach ($arrayNutricnych as $riadokNutricnych) {
                $riadok = explode("*", $riadokNutricnych);

            ?>
            <tr>
                <?php foreach ($riadok as $stlpec) { ?>
                <th><?php echo $stlpec?></th>

                <?php } ?>

            </tr>

            <?php
            }
            ?>

        </table>

    </div>

    <div class="zlozenie">
        <h1>Composition</h1>
        <p><?php echo $zlozenieProduktu?></p>

    </div>

    <div class="separator">

    </div>



    <?php
    include_once "sideCategories.php";

    ?>

</section>


</body>
</html>


