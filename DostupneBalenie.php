<?php

class DostupneBalenie
{
    private $hmotnost;

    
    /**
     * @return mixed
     */
    public function getHmotnost()
    {
        return $this->hmotnost;
    }

    /**
     * @param mixed $hmotnost
     */
    public function setHmotnost($hmotnost): void
    {
        $this->hmotnost = $hmotnost;
    }



}