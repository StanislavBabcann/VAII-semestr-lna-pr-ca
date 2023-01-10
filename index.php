<?php
session_start();
$_SESSION['choosenCategorySES'] = "Best products";
header("location: View/ProductsLayout.php");

$user_ip = getUserIP();

$_SESSION['ipcka'] = $user_ip;

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


