


<?php
    include "InputValidator.php";
    include "Database.php";

    $mailErr = " ";

    $recMail = "";

    $Color = "red";
    if (isset($_GET['recoverPassBtn'])) {
        $inpValidator = new InputValidator();

        $mailErr = $inpValidator->validateMailForRecovery($_REQUEST['recoverMail']);

        $recMail = $_REQUEST['recoverMail'];

        if (strcmp($mailErr, " ") != 0) {


        } else {
            $mailErr = "Instructions sent to e-mail address";
            $Color = "limegreen";



        }

    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Password reset</title>
    <link rel="stylesheet" href="css/PasswordRecovery.css">
    <meta name = "viewport" content ="with=device-width, initial-scale=1.0">

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
              <input type="text" name="recoverMail" placeholder="Enter e-mail address" value = <?php echo $recMail;?>>
                <span class = "error" > <?php echo '<div style="Color:'.$Color.'">'.$mailErr.'</div>';?></span>
              <p>You will recieve instructions <br> for reseting your password</p>


                <input type="submit" name="recoverPassBtn" value="Send">
            </form>


          </div>
    </section>

</body>
</html>