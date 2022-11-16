<?php

session_start();


include "Database.php";
include "Pouzivatel.php";


$db = new Database();

$mailErr = " " ;
$passERR = " ";

$mailAdress="";


if (isset($_GET['logPotvrdit'])) {
    $mailAdress=$_REQUEST['logMail'];


    $isLogged = $db->doesHaveMail($_REQUEST['logMail']);
    $_SESSION['sesLog'] = $isLogged;
    $_SESSION['logMail'] = $_REQUEST['logMail'];
    if ($isLogged == 1) {
        $heslo = $db->getPasswordOfUser($_REQUEST['logMail']);
        $_SESSION['HESLO'] = $heslo;
        $_SESSION['HESIELKO'] = $_REQUEST['logPassword'];


        if(password_verify($_REQUEST['logPassword'], $heslo)) {
            $_SESSION['sesMail'] = $_REQUEST['logMail'];

            header("location: AccountStarter.php");
        } else {
            $passERR = "Incorrect password";
        }

    } else {
        $mailErr = "Incorrect e-mail address";


    }

}



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/LoginPage.css">
    <meta name = "viewport" content ="with=device-width, initial-scale=1.0">

</head>
<body>

    <section class = "header">
        <?php

        include_once "unloggedUserLayout.php";


        ?>

        <div class = "loginbox">

            <h1>Login</h1>
            <form name="logginForm">


                <p>E-mail address</p>
                <input type="text" name="logMail" placeholder="Enter e-mail address" value=<?php echo $mailAdress;?>>
                <span class = "error" style="color: red"><?php echo $mailErr;?></span>
                <p>Password</p>
                <input type="password" name="logPassword" placeholder="Enter password" >
                <span class = "error" style="color: red"><?php echo $passERR;?></span>
                <input type="submit" name="logPotvrdit" value="Login">
                <a href="PasswordRecovery.php">Lost your password?</a><br>
                <a href="registrationpage.php">Don't have an account yet?</a>
            </form>

        </div>

    </section>

</body>
</html>