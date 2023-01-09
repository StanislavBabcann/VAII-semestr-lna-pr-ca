<?php

include_once "../Controller/editProfileHeader.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once "head.html"?>

    <script src="../Script/javascripts.js" language="JavaScript" type="text/javascript">


    </script>

</head>
<body>

<section class = "header">

    <?php
    $loginManager->setLayout();

    ?>

    <div class = "editProfileBox">

        <h1><?php echo $_SESSION['titulPreFormu'] ?></h1>
        <form name="editProfileForm" >
            <p>First name</p>
            <input type="text" name="meno" placeholder="Enter first name" value = "<?php echo $editMeno ?>" >
            <span class = "error" style="color: red"> <?php echo $nameErr;?></span>
            <p> Last name</p>
            <input type="text" name="priezvisko" placeholder="Enter last name " value = <?php echo $editLast ?>>
            <span class = "error" style="color: red"> <?php echo $lastErr;?></span>
            <p> E-mail address</p>
            <input type="text" name="mail" placeholder="Enter e-mail address" value = "<?php echo $editMail ?>">
            <span class = "error" style="color: red"> <?php echo $mailErr;?></span>
            <p>City</p>
            <input type="text" name="mesto" placeholder="Enter city" value = "<?php echo $editMesto ?>">
            <span class = "error" style="color: red"> <?php echo $cityErr;?></span>
            <p>Street</p>
            <input type="text" name="ulica" placeholder="Enter street" value = "<?php echo $editUlica ?>">
            <span class = "error" style="color: red"> <?php echo $ulicaErr;?></span>
            <input type="submit" name="potvrdit" <?php if (strcmp($mode,"Edit profile") == 0) { ?>onclick="confirmEditAccount() <?php }?>" value=<?php echo $_SESSION['titulPreButton']?>>
        </form>


    </div>

    <?php
    include_once "sideCategories.php";

    ?>


</section>



</body>
</html>



