

<?php

session_start();

include "Database.php";
include "Pouzivatel.php";
include "InputValidator.php";


$mailErr = " " ;
$nameErr = " " ;
$lastErr = " " ;
$cityErr = " " ;
$ulicaErr = " " ;
$firstPasErr = " ";
$secondPasErr = " " ;

$regMeno = "";
$regLast = "";
$regMail = "";
$regMesto = "";
$regUlica = "";

$db = new Database();

    if (isset($_GET['regPotvrdit'])) {
        $regMeno = $_REQUEST['regMeno'];
        $regLast = $_REQUEST['regPriezvisko'];
        $regMail = $_REQUEST['regMail'];
        $regMesto = $_REQUEST['regMesto'];
        $regUlica = $_REQUEST['regUlica'];
        $regHeslo = $_REQUEST['regHeslo'];
        $regHesloZnova = $_REQUEST['regHesloZnova'];



        $inpValidator = new InputValidator();

        $nameErr = $inpValidator->validateFirstName($regMeno);
        $lastErr = $inpValidator->validateLastName($regLast);
        $mailErr = $inpValidator->validateMail($regMail);
        $cityErr = $inpValidator->validateCity($regMesto);
        $ulicaErr = $inpValidator->validateStreet($regUlica);
        $firstPasErr = $inpValidator->checkFirstPassword($regHeslo);
        $secondPasErr = $inpValidator->checkSecondPassword($regHeslo, $regHesloZnova);



        if (strcmp($nameErr, " ") != 0 || strcmp($lastErr, " ") != 0 ||
        strcmp($mailErr, " ") != 0 || strcmp($cityErr, " ") != 0 ||
            strcmp($ulicaErr, " ") != 0 || strcmp($firstPasErr, " ") != 0 ||
            strcmp($secondPasErr, " ") != 0) {

        }
        else {
            $password = $_REQUEST['regHeslo'];
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $newPouzivatel = new Pouzivatel();
            $newPouzivatel->meno = $_REQUEST['regMeno'];
            $newPouzivatel->priezvisko = $_REQUEST['regPriezvisko'];
            $newPouzivatel->mail = $_REQUEST['regMail'];
            $newPouzivatel->mesto = $_REQUEST['regMesto'];
            $newPouzivatel->ulica = $_REQUEST['regUlica'];
            $newPouzivatel->heslo = $hashed_password;

            $_SESSION['sesMail'] = $newPouzivatel->mail;


            $db->pridajPouzivatela($newPouzivatel);


            header("location: AccountStarter.php");
        }


    }
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="RegistrationPage.css">
    <meta name = "viewport" content ="with=device-width, initial-scale=1.0">


    <script src="javascripts.js" , language="JavaScript" type="text/javascript">


    </script>


</head>


<body>

    <section class = "header">

        <?php
            include_once "unloggedUserLayout.php";

        ?>

        <div class = "loginbox">



            <h1>Register</h1>
            <form name="registrationForm" >
                <p>First name</p>
                <input type="text" name="regMeno" placeholder="Enter first name" value=<?php echo $regMeno;?>>
                <span class = "error" style="color: red"> <?php echo $nameErr;?></span>
                <p>Last name</p>
                <input type="text" name="regPriezvisko" placeholder="Enter last name" value=<?php echo $regLast;?>>
                <span class = "error" style="color: red"> <?php echo $lastErr;?></span>
                <p>E-mail address</p>
                <input type="text" name="regMail" placeholder="Enter e-mail address" value=<?php echo $regMail;?>>
                <span class = "error" style="color: red"> <?php echo $mailErr;?></span>
                <p>City</p>
                <input type="text" name="regMesto" placeholder="Enter city" value=<?php echo $regMesto;?>>
                <span class = "error" style="color: red"> <?php echo $cityErr;?></span>
                <p>Street</p>
                <input type="text" name="regUlica" placeholder="Enter street" value=<?php echo $regUlica;?>>
                <span class = "error" style="color: red"> <?php echo $ulicaErr;?></span>
                <p>Password</p>
                <input type="password" name="regHeslo" placeholder="Enter password">
                <span class = "error" style="color: red"> <?php echo $firstPasErr;?></span>
                <p>Confirm password</p>
                <input type="password" name="regHesloZnova" placeholder="Re-enter password">
                <span class = "error" style="color: red"> <?php echo $secondPasErr;?></span>
                <input type="submit" name="regPotvrdit" value="Register">


            </form>


        </div>


    </section>



</body>
</html>