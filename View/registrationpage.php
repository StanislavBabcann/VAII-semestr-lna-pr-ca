<?php
    include_once "../Controller/RegistrationPageHeader.php";
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
            include_once "unloggedUserLayout.php";

        ?>

        <div class = "registrationBox">



            <h1>Register</h1>
            <form name="registrationForm">
                <p>First name</p>
                <input type="text" name="regMeno" placeholder="Enter first name" value="<?php echo $regMeno;?>">
                <span class = "error" style="color: red"> <?php echo $nameErr;?></span>
                <p>Last name</p>
                <input type="text" name="regPriezvisko" placeholder="Enter last name" value="<?php echo $regLast;?>">
                <span class = "error" style="color: red"> <?php echo $lastErr;?></span>
                <p>E-mail address</p>
                <input type="text" name="regMail" placeholder="Enter e-mail address" value="<?php echo $regMail;?>">
                <span class = "error" style="color: red"> <?php echo $mailErr;?></span>
                <p>City</p>
                <input type="text" name="regMesto" placeholder="Enter city" value="<?php echo $regMesto;?>">
                <span class = "error" style="color: red"> <?php echo $cityErr;?></span>
                <p>Street</p>
                <input type="text" name="regUlica" placeholder="Enter street" value="<?php echo $regUlica;?>">
                <span class = "error" style="color: red"> <?php echo $ulicaErr;?></span>
                <p>Password</p>
                <input type="password" name="regHeslo" placeholder="Enter password">
                <span class = "error" style="color: red"> <?php echo $firstPasErr;?></span>
                <p>Confirm password</p>
                <input type="password" name="regHesloZnova" placeholder="Re-enter password">
                <span class = "error" style="color: red"> <?php echo $secondPasErr;?></span>
                <input type="submit" name="regPotvrdit" value="Register" >


            </form>


        </div>

        <?php
        include_once "sideCategories.php";

        ?>




    </section>



</body>
</html>