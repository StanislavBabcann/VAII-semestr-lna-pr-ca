<?php
include_once "../Controller/homePageHeader.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once "head.html"?>
</head>
<body>

    <section class = "header">

        <?php
        $loginManager->setLayout();
        ?>


        <?php
        include_once "../View/sideCategories.php";

        ?>

    </section>


</body>
</html>