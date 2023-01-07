<?php

include "InputValidator.php";
include "Database.php";
include "LogginManager.php";

$loginManager = new LogginManager();

session_start();

$db = new Database();

$pouzivatel = $db->nacitajInfoUzivatela($_SESSION['sesMail']);

$mailErr = " " ;
$nameErr = " " ;
$lastErr = " " ;
$cityErr = " " ;
$ulicaErr = " " ;

$editMeno = null;
$editLast = null;
$editMail = null;
$editMesto = null;
$editUlica = null;
$staryMail = null;

if ($_SESSION['logged'] == 1) {
    $editMeno = $pouzivatel->meno;
    $editLast = $pouzivatel->priezvisko;
    $editMail = $pouzivatel->mail;
    $editMesto = $pouzivatel->mesto;
    $editUlica = $pouzivatel->ulica;
    $staryMail = $pouzivatel->mail;
}


if (isset($_GET['potvrdit'])) {

    if ($_SESSION['titulPreFormu'] == "Edit profile") {

        $upravenyPouzivatel = new Pouzivatel();

        $editMeno = $_REQUEST['meno'];
        $editLast = $_REQUEST['priezvisko'];
        $editMail = $_REQUEST['mail'];
        $editMesto = $_REQUEST['mesto'];
        $editUlica = $_REQUEST['ulica'];

        $inpValidator = new InputValidator();

        $nameErr = $inpValidator->validateFirstName($editMeno);
        $lastErr = $inpValidator->validateLastName($editLast);

        if (strcmp($_SESSION['sesMail'], $editMail) != 0) {
            $mailErr = $inpValidator->validateMail($editMail);
        }

        $cityErr = $inpValidator->validateCity($editMesto);
        $ulicaErr = $inpValidator->validateStreet($editLast);


        if (strcmp($nameErr, " ") != 0 || strcmp($lastErr, " ") != 0 ||
            strcmp($mailErr, " ") != 0 || strcmp($cityErr, " ") != 0 ||
            strcmp($ulicaErr, " ") != 0) {


        } else {


            $upravenyPouzivatel->meno = $editMeno;
            $upravenyPouzivatel->priezvisko = $editLast;
            $upravenyPouzivatel->mail = $editMail;
            $upravenyPouzivatel->mesto = $editMesto;
            $upravenyPouzivatel->ulica = $editUlica;
            $upravenyPouzivatel->druhyMail = $staryMail;


            $db->upravInfoPouzivatela($upravenyPouzivatel);

            header("location: AccountStarter.php");
            die();
        }
    } else {
        header("location: VolbaDopravy.php");




    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit profile</title>
    <link rel="stylesheet" href="css/MainPage.css">
    <meta name = "viewport" content ="with=device-width, initial-scale=1.0">

    <script src="javascripts.js" , language="JavaScript" type="text/javascript">


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
            <input type="text" name="meno" placeholder="Enter first name" value = <?php echo $editMeno ?> >
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
            <input type="submit" name="potvrdit" value=<?php echo $_SESSION['titulPreButton']?>>
        </form>


    </div>

    <?php
    include_once "sideCategories.php";

    ?>


</section>



</body>
</html>



