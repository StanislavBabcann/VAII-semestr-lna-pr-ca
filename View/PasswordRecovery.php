<?php
    include_once "../Controller/PasswordRecoveryHeader.php";
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

          <div class = "recovery-box">

            <h1>Password recovery</h1>
            <form>
              <p>E-mail address</p>
              <input type="text" name="recoverMail" placeholder="Enter e-mail address" value = "<?php echo $recMail;?>">
                <span class = "error" style="color: red" > <?php echo $mailErr;?></span>
              <p>You will recieve instructions <br> for reseting your password</p>


                <input type="submit" name="recoverPassBtn" value="Send">
            </form>


          </div>

        <?php
        include_once "sideCategories.php";

        ?>
    </section>

</body>
</html>