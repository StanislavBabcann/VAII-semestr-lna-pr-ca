<?php
include "Database.php";

session_start();

$db = new Database();


if (isset($_GET['upravProfilBtn'])) {

    header("location: editprofile.php");
    die();

}

if (isset($_GET['zmazProfilBtn'])) {
    $db->deleteUserAccount($_SESSION['sesMail']);
    $_SESSION['logged'] = 0;
    header("location: index.php");
    die();

}

if (isset($_GET['zmenHesloBtn'])) {

    header("location: changePassword.php");
    die();
}

if (isset($_GET['odhlasSaBtn'])) {
    $_SESSION['logged'] = 0;
    header("location: index.php");
    die;
}
$_SESSION['logged'] = 1;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Account menu</title>
    <link rel="stylesheet" href="MainPage.css">
    <link rel="preconnect" href="https://fonts.googleapis.com/css?family=Sofia">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.0/css/fontawesome.min.css">

    <script type="text/javascript" language="JavaScript" src="javascriptMethods.js">

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
                    <input type="submit" name="#" value="View basket">

                    <input type="submit" name="upravProfilBtn" value="Edit profile">

                    <input type="submit" name="zmenHesloBtn" value="Change password">

                    <input type="submit" name="zmazProfilBtn" value="Delete account" style="background-color: red" onclick="return confirmDeleteAccount()">

                    <input type="submit" name="odhlasSaBtn" value="Log out">
                </form>
        </div>


    </section>

</body>
</html>