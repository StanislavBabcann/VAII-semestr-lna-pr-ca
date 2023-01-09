<?php

class Kupon
{
    private $idKuponu;

    /**
     * @return mixed
     */
    public function getIdKuponu()
    {
        return $this->idKuponu;
    }

    /**
     * @param mixed $idKuponu
     */
    public function setIdKuponu($idKuponu): void
    {
        $this->idKuponu = $idKuponu;
    }
    private $kod;

    /**
     * @return mixed
     */
    public function getKod()
    {
        return $this->kod;
    }

    /**
     * @param mixed $kod
     */
    public function setKod($kod): void
    {
        $this->kod = $kod;
    }
    private $percentoZlavy;

    /**
     * @return mixed
     */
    public function getPercentoZlavy()
    {
        return $this->percentoZlavy;
    }

    /**
     * @param mixed $percentoZlavy
     */
    public function setPercentoZlavy($percentoZlavy): void
    {
        $this->percentoZlavy = $percentoZlavy;
    }
    private $pouzity;

    /**
     * @return mixed
     */
    public function getPouzity()
    {
        return $this->pouzity;
    }

    /**
     * @param mixed $pouzity
     */
    public function setPouzity($pouzity): void
    {
        $this->pouzity = $pouzity;
    }
}