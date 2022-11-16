<?php
include "Database.php";
include "InputValidator.php";
session_start();

$db = new Database();
$mail = $_SESSION['sesMail'];


$firstPasErr = " ";
$secondPasErr = " " ;



if (isset($_GET['potvrZmenHesla'])) {


    $inpValidator = new InputValidator();

    $zmenaHeslo = $_REQUEST['changePassword'];
    $zmenaHesloZnova = $_REQUEST['changePassRe'];

    $firstPasErr = $inpValidator->checkFirstPassword($zmenaHeslo);
    $secondPasErr = $inpValidator->checkSecondPassword($zmenaHeslo, $zmenaHesloZnova);

    if (strcmp($firstPasErr, " ") != 0 || strcmp($secondPasErr, " ") != 0) {
    } else {
        $hashed_password = password_hash($zmenaHeslo, PASSWORD_DEFAULT);
        $db->zmenHesloPouzivatela($mail, $hashed_password);
        header("location: AccountStarter.php");
        die();
    }

}



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="changePassword.css">
    <meta name = "viewport" content ="with=device-width, initial-scale=1.0">

    <script src="javascripts.js" , language="JavaScript" type="text/javascript">


    </script>

</head>
<body>

<section class = "header">

    <?php
    include_once "loggedUserLayout.php";

    ?>

    <div class = "loginbox">

        <h1>Change password</h1>
        <form name="changePasswordForm" >
            <p>Enter new password</p>
            <input type="password" name="changePassword" placeholder="Enter password">
            <span class = "error" style="color: red"> <?php echo $firstPasErr;?></span>
            <p>Re-enter password</p>
            <input type="password" name="changePassRe" placeholder="Re-enter password">
            <span class = "error" style="color: red"> <?php echo $secondPasErr;?></span>
            <input type="submit" name="potvrZmenHesla" value="Change password" onclick="return validateEditPasswordForm(changePasswordForm.changePassword.value, changePasswordForm.changePassRe.value)">
        </form>


    </div>


</section>



</body>
</html>
