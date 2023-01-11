<?php


class InputValidator
{

    private $index;

    public function __construct() {

    }

    public function validateFirstName($name) : string {
        $value = $this->validateName($name);

        if ($value == 1) {
            return "Enter name";
        } else if ($value == 2) {
            return "Name must be 1-32 characters";
        } else {
            return " ";
        }
    }

    public function validateLastName($name) : string {
        $value = $this->validateName($name);

        if ($value == 1) {
            return "Enter lastname";
        } else if ($value == 2) {
            return "Lastname must be 1-32 characters";
        } else {
            return " ";
        }
    }

    public function validateName($name) : int {
        if (strcmp($name, "") == 0) {
            return 1;
        } else if (strlen($name) > 32) {
            return 2;
        } else {
            return 3;
        }
    }

    public function validateMail($mail) : string {
        if (strcmp($mail, "") == 0) {
            return "Enter e-mail address";
        } else if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            return "Enter valid e-mail address";
        } else if ($this->chceckIfEmailExists($mail) == 1) {
            return "E-mail address already registered";
        } else {
            return " ";
        }
    }

    public function validateMailForPersonal($mail) : string {
        if (strcmp($mail, "") == 0) {
            return "Enter e-mail address";
        } else if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            return "Enter valid e-mail address";
        } else {
            return " ";
        }
    }

    public function validateMailForRecovery($mail) : string {
        if (strcmp($mail, "") == 0) {
            return "Enter e-mail address";
        } else if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            return "Enter valid e-mail address";
        } else if ($this->chceckIfEmailExists($mail) != 1) {
            return "E-mail address not registered";
        } else {
            return " ";
        }

    }

    public function validateCity($city) : string {
        $value = $this->validateCityStreet($city);

        if ($value == 1) {
            return "Enter city";
        } else if ($value == 2) {
            return "City must be 1-128 characters";
        } else {
            return " ";
        }
    }

    public function validateStreet($city) : string {
        $value = $this->validateCityStreet($city);

        if ($value == 1) {
            return "Enter street";
        } else if ($value == 2) {
            return "Street must be 1-128 characters";
        } else {
            return " ";
        }
    }

    public function validateCityStreet($city) : int {
        if (strcmp($city, "") == 0) {
            return 1;
        } else if (strlen($city) > 128) {
            return 2;
        } else {
            return 3;
        }
    }

    public function checkSecondPassword($first, $second) : string {
        if (strcmp($first, $second) != 0) {
            return "Passwords must be equal";
        } else  if (strcmp($second, "") == 0) {
            return "Re-enter password";
        } else {
            return " ";
        }
    }

    public function checkFirstPassword($first) : string {
        if (strcmp($first, "") == 0) {
            return "Enter password";
        } else if (strlen($first) < 8 || strlen($first) > 20) {
            return "Password must be 8-20 characters";
        } else if (!(preg_match('/[a-z]/', $first))) {
            return "Must contain lowercase character";
        } else if (!(preg_match('/[A-Z]/', $first))) {
            return "Must contain uppercase character";
        } else if (!(preg_match('~[0-9]+~', $first))) {
            return "Must contain one number";
        } else {
            return " ";
        }
    }

    public function chceckIfEmailExists($mail) : int {
        $db = new Database();
        return $isLogged = $db->doesHaveMail($mail);
    }



}