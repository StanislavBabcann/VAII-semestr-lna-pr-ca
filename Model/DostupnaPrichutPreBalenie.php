<?php

class DostupnaPrichutPreBalenie
{
    private $prichut;

    /**
     * @return mixed
     */
    public function getPrichut()
    {
        return $this->prichut;
    }

    /**
     * @param mixed $prichut
     */
    public function setPrichut($prichut): void
    {
        $this->prichut = $prichut;
    }
}