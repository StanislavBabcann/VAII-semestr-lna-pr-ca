<?php
include_once "../Controller/NakupnyKosikHeader.php";
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


    <div class = "basket">
        <h1>Shoping basket</h1>


        <div class = "columns">
            <h3>Name of product</h3>

            <h2>Number of pieces</h2>

            <h1>Prize</h1>

            <h1>Total prize</h1>

        </div>

    </div>


    <div class = "basketProducts">
    <?php

    $i = 0;
    foreach ($produktyKosiku as $jednaPolozka) {

        $idAktualneho = $jednaPolozka->getIdProduktu();
        $jednaPolozka->getIdPouzivatela();
        $aktualnyProdukt = $db->dajProduktPodlaId($idAktualneho);
        $dostupnyPocet = $db->dajPocetProduktovNaSkladePodlaIdABalenia($idAktualneho, $jednaPolozka->getBalenie());

        ?>

        <div class = "oneProduct">
            <img alt=" " src=<?php echo $aktualnyProdukt->getCestaKObrazku()?>>
            <a href="?chosenProduct=<?php echo $idAktualneho?>"><?php echo $aktualnyProdukt->getNazovProduktu()?></a>



            <?php
            $dolnyRiadok = $jednaPolozka->getBalenie()." g";

            if ($jednaPolozka->getPrichut() != null)
            $dolnyRiadok = $dolnyRiadok.",".$jednaPolozka->getPrichut();

            {?>
                <h2><?php echo $dolnyRiadok?></h2>
            <?php }?>

            <form  method="post">

                <input type="number" name=<?php echo $i?> id=<?php echo $i?> min="1" max=<?php echo $dostupnyPocet?> onchange="changePrize(<?php echo $i?>, <?php echo sizeof($produktyKosiku)?>)" value=<?php echo $jednaPolozka->getPocetKusov()?> >
                <input type="hidden" name=<?php echo $i."id"?> id=<?php echo $i."id"?> value="<?php echo $jednaPolozka->getId()?>"/>

            </form>
            <h3 id=<?php echo "cenaPolozky".$i?>> <?php echo $outputFormator->editPrize($jednaPolozka->getCena())?></h3>

            <h4 id=<?php echo "celkovaCenaPolozky".$i?>> <?php echo $outputFormator->editPrizeForMultipleItems($jednaPolozka->getCena(), $jednaPolozka->getPocetKusov())?></h4>




            <div class="deleteOption">
                <a href="?deletedItem=<?php echo $jednaPolozka->getId()?>"> Delete</a>


            </div>



        </div>


    <?php $i++;} ?>


        <?php if (sizeof($produktyKosiku) != 0 ) {
            ?>
            <div class="kupon">

                <h1>Use a discount coupon</h1>
                <input name="textKupon" id="textKupon" type="text">
                <input type="submit" value="USE" onclick="skontrolujKupon(<?php echo $i?>)">
                <h2 id="upozornenieKupon"></h2>
            </div>
        <?php } ?>



        <div class="zuctovanie">


            <div class="pokracuj">
                <a href="homePage.php"> Continue shopping</a>
            </div>



            <?php if (sizeof($produktyKosiku) != 0 ) {?>
            <div class="zmazVsetko">
                <a href="?deleteBasket=1">Empty the basket</a>
            </div>

            <h1>Together: </h1>
            <h2 id="cenaDokopy"><?php echo $basketManager->getTotalPrizeWithDPH($produktyKosiku)?></h2>
            <h3 id="cenaBezDph"><?php echo $basketManager->getTotalPrizeWithoutDPH($produktyKosiku)?></h3>


            <form>
                <input id = "makeOrderBtn" name="makeOrderBtn" type="submit" value="ORDER">
            </form>

            <?php } ?>

        </div>

    </div>












    <?php
    include_once "sideCategories.php";

    ?>

</section>


</body>
</html>
