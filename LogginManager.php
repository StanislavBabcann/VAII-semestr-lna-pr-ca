<?php

class LogginManager
{
    public function __construct()
    {

    }

    public function setLayout() {
        if (isset($_SESSION['logged'])) {
            if ($_SESSION['logged'] == 0) {
                include_once "unloggedUserLayout.php";
            } else {
                include_once "loggedUserLayout.php";
            }
        } else {
            include_once "unloggedUserLayout.php";
        }
    }
}