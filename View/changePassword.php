<?php
include_once "../Controller/changePasswordHeader.php"
/** @var \Controller\changePasswordHeader $firstPasErr */
/** @var \Controller\changePasswordHeader $secondPasErr */
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once "head.html"?>

    <script src="../Script/javascripts.js"  language="JavaScript" type="text/javascript">


    </script>

</head>
<body>

<section class = "header">

    <?php
    include_once "loggedUserLayout.php";

    ?>

    <div class = "changePasswordBox">

        <h1>Change password</h1>
        <form name="changePasswordForm" >
            <p>Enter new password</p>
            <input type="password" name="changePassword" placeholder="Enter password">
            <span class = "error" style="color: red"> <?php echo $firstPasErr;?></span>
            <p>Re-enter password</p>
            <input type="password" name="changePassRe" placeholder="Re-enter password">
            <span class = "error" style="color: red"> <?php echo $secondPasErr;?></span>
            <input type="submit" name="potvrZmenHesla" value="Change password" onclick="confirmChangePassword()">
        </form>


    </div>

    <?php
    include_once "sideCategories.php";

    ?>


</section>



</body>
</html>
