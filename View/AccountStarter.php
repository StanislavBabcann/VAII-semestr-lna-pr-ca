<?php
include_once "../Controller/AccountStarterHeader.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once "head.html"?>

    <script type="text/javascript" language="JavaScript" src="../Script/javascripts.js">

    </script>

</head>

<body>
    <section class="header">

        <?php
        include_once "loggedUserLayout.php";

        ?>
        <div class="starterBox">
                <h1>Customer account</h1>
                <form>
                    <input type="submit" name="chodDoKosikuBtn" value="View basket">

                    <input type="submit" name="upravProfilBtn" value="Edit profile">

                    <input type="submit" name="zmenHesloBtn" value="Change password">

                    <input type="submit" name="zmazProfilBtn" value="Delete account" style="background-color: red" onclick="return confirmDeleteAccount()">

                    <input type="submit" name="odhlasSaBtn" value="Log out">
                </form>
        </div>

        <?php
        include_once "sideCategories.php";

        ?>


    </section>

</body>
</html>