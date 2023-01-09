<?php

include "InputValidator.php";
include "../Model/Database.php";

$mailErr = " ";

$recMail = "";

$Color = "red";
if (isset($_GET['recoverPassBtn'])) {
    $inpValidator = new InputValidator();

    $mailErr = $inpValidator->validateMailForRecovery($_REQUEST['recoverMail']);

    $recMail = $_REQUEST['recoverMail'];

    if (strcmp($mailErr, " ") != 0) {


    } else {
        $mailErr = "Instructions sent to e-mail address";
        $Color = "limegreen";



    }

}