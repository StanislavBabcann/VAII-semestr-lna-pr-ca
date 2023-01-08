<?php

    include "LogginManager.php";

    session_start();
    $loginManager = new LogginManager();

$user_ip = getUserIP();

$_SESSION['ipcka'] = $user_ip;

function getUserIP() {
    if( array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER) && !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ) {
        if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',')>0) {
            $addr = explode(",",$_SERVER['HTTP_X_FORWARDED_FOR']);
            return trim($addr[0]);
        } else {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
    }
    else {
        return $_SERVER['REMOTE_ADDR'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name = "viewport" content ="with=device-width, initial-scale=1.0">
    <title>Supplement engineer</title>
    <link rel="stylesheet" href="css/MainPage.css">
    <meta charset="UTF-8">



</head>
<body>



    <section class = "header">

        <?php

        $loginManager->setLayout();


        ?>

        <?php
        include_once "sideCategories.php";

        ?>

    </section>


</body>
</html>