<?php

class ProductShowingManager
{
    public function __construct()
    {

    }

    public function shouldShowNextProduct($pageumber, $numberOfItemOnPage, $numberOfProducts) {
        if ($pageumber * $numberOfItemOnPage < $numberOfProducts) {
            return true;
        } else {
            return false;
        }


    }
}