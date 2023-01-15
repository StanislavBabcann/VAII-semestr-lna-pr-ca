<?php
include_once "../Controller/LoginPageHeader.php";
/** @var \Controller\LoginPageHeader $mailAdress */
/** @var \Controller\LoginPageHeader $mailErr */
/** @var \Controller\LoginPageHeader $passERR */
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once "head.html"?>

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
                <input type="text" name="logMail" placeholder="Enter e-mail address" value="<?php echo $mailAdress;?>">
                <span class = "error" style="color: red"><?php echo $mailErr;?></span>
                <p>Password</p>
                <input type="password" name="logPassword" placeholder="Enter password" >
                <span class = "error" style="color: red"><?php echo $passERR;?></span>
                <input type="submit" name="logPotvrdit" value="Login">
                <a href="PasswordRecovery.php">Lost your password?</a><br>
                <a href="registrationpage.php">Don't have an account yet?</a>
            </form>

        </div>



        <?php
        include_once "sideCategories.php";

        ?>

    </section>



</body>
</html>