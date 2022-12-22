<?php

class ProductShowingManager
{
    public function __construct()
    {

    }

    public function shouldShowNextProduct($numberOfItemOnPage, $numberOfProducts) {
        if ( $numberOfItemOnPage < $numberOfProducts) {
            return true;
        } else {
            return false;
        }


    }

    public function shouldShowNextNumberOfPage($numberOfProducts, $numberThatShouldBeShowed) {
        if (($numberThatShouldBeShowed - 1) * 10 < $numberOfProducts) {
            return true;
        } else {
            return false;
        }
    }

    public function showBackButton($currentPage) {
        if ($currentPage != 1) {
            return true;
        } else {
            return false;
        }
    }

    public function showNextButton($currentPage, $numberOfProducts) {
        if ($currentPage * 10 < $numberOfProducts) {
            return true;
        } else {
            return false;
        }
    }

    public function highlightCurrentPageButton($currentPage, $theButton) {
        if ($currentPage == $theButton) {
            return true;
        } else {
            return false;
        }
    }


}