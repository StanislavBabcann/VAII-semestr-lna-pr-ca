<?php


class BasketManager
{
    public function __construct()
    {

    }

    public function countTotalPrize($productsOfBasket) {
        $totalPrize = 0.0;

        foreach ($productsOfBasket as $oneItem) {
            $cena = $oneItem->getCena();
            $pocetKusov = $oneItem->getPocetKusov();
            $totalPrize += $cena * $pocetKusov;
        }

        return $totalPrize;
    }

    public function getTotalPrizeWithDPH ($productsOfBasket) {
        $result = $this->countTotalPrize($productsOfBasket);

        $formator = new OutputFormator();

        $result = $formator->editPrize($result);
        $result = $result." with VAT";

        return $result;
    }

    public function getTotalPrizeWithoutDPH ($productsOfBasket) {
        $result = $this->countTotalPrize($productsOfBasket);

        $result = $result * 0.8;
        $result = round($result, 2);

        $formator = new OutputFormator();

        $result = $formator->editPrize($result);
        $result = $result." without VAT";

        return $result;

}



}