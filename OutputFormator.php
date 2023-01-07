<?php

class OutputFormator
{


    public function __construct()
    {

    }

    public function editPrizeForMultipleItems($prize, $pieces) {
        $sum = $prize * $pieces;

        return $this->editPrize($sum);

    }

    public function editPrize($prize) {
        $array = explode(".", $prize);

        if (strlen($array[1]) == 1) {
            $array[1] = $array[1]."0";

        }

        $output = $array[0].",".$array[1]." €";

        return $output;
    }
}