<?php

class ProductShowingManager
{
    private $lastProduct;

    public function __construct()
    {

    }

    public function getLastProductOfPage() {
        return $this->lastProduct;
    }

    public function shouldShowNextProduct($numberOfItemOnPage, $numberOfProducts) {
        if ( $numberOfItemOnPage < $numberOfProducts) {
            $this->lastProduct = $numberOfItemOnPage;
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