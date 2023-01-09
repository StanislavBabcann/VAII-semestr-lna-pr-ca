<?php

session_start();


include "../Model/Database.php";



$db = new Database();

$mailErr = " " ;
$passERR = " ";

$mailAdress="";


if (isset($_GET['logPotvrdit'])) {
    $mailAdress=$_REQUEST['logMail'];


    $isLogged = $db->doesHaveMail($_REQUEST['logMail']);
    $_SESSION['sesLog'] = $isLogged;
    $_SESSION['logMail'] = $_REQUEST['logMail'];
    if ($isLogged == 1) {
        $heslo = $db->getPasswordOfUser($_REQUEST['logMail']);
        $_SESSION['HESLO'] = $heslo;
        $_SESSION['HESIELKO'] = $_REQUEST['logPassword'];


        if(password_verify($_REQUEST['logPassword'], $heslo)) {
            $_SESSION['sesMail'] = $_REQUEST['logMail'];
            $_SESSION['logged'] = 1;
            header("location: ../View/AccountStarter.php");
        } else {
            $passERR = "Incorrect password";
        }

    } else {
        $mailErr = "Incorrect e-mail address";


    }

}
