<?php

class LogginManager
{
    public function __construct()
    {

    }

    public function setLayout() {
        if (isset($_SESSION['logged'])) {
            if ($_SESSION['logged'] == 0) {
                include_once "../View/unloggedUserLayout.php";
            } else {
                include_once "../View/loggedUserLayout.php";
            }
        } else {
            include_once "../View/unloggedUserLayout.php";
        }
    }
}