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
        $prize = round($prize, 2);
        if (!strpos($prize, ".")) {
            $prize = $prize.".00";
        }

        $array = explode(".", $prize);

        if (strlen($array[1]) == 1) {
            $array[1] = $array[1]."0";

        }

        $output = $array[0].",".$array[1]." €";

        return $output;
    }
}