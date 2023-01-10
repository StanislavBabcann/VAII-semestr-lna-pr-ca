<?php

include "../Model/Database.php";

session_start();

$db = new Database();

$_SESSION['logged'] = $_SESSION['logged'];

if (isset($_GET['upravProfilBtn'])) {
    $_SESSION['titulPreFormu'] = "Edit profile";
    $_SESSION['titulPreButton'] = "Edit";
    header("location: ../View/editprofile.php");
    die();

}

if (isset($_GET['zmazProfilBtn'])) {
    $db->deleteUserAccount($_SESSION['sesMail']);
    $_SESSION['logged'] = 0;
    $_SESSION['choosenCategorySES'] = "Best products";

    $user_ip = getUserIP();

    $_SESSION['ipcka'] = $user_ip;
    header("location: ../View/ProductsLayout.php");
    die();

}

if (isset($_GET['zmenHesloBtn'])) {

    header("location: ../View/changePassword.php");
    die();
}

if (isset($_GET['odhlasSaBtn'])) {
    $_SESSION['logged'] = 0;
    $_SESSION['choosenCategorySES'] = "Best products";
    $user_ip = getUserIP();

    $_SESSION['ipcka'] = $user_ip;
    header("location: ../View/ProductsLayout.php");
    die;
}

if (isset($_GET['chodDoKosikuBtn'])) {
    header("location: ../View/NakupnyKosik.php");
    die;
}

function getUserIP()
{
    if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') > 0) {
            $addr = explode(",", $_SERVER['HTTP_X_FORWARDED_FOR']);
            return trim($addr[0]);
        } else {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}
