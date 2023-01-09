<?php

class ProduktNakupnehoKosiku
{
    private $id;

    private $cena;

    /**
     * @return mixed
     */
    public function getCena()
    {
        return $this->cena;
    }

    /**
     * @param mixed $cena
     */
    public function setCena($cena): void
    {
        $this->cena = $cena;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }
    private $id_pouzivatela;

    /**
     * @return mixed
     */
    public function getIdPouzivatela()
    {
        return $this->id_pouzivatela;
    }

    /**
     * @param mixed $id_pouzivatela
     */
    public function setIdPouzivatela($id_pouzivatela): void
    {
        $this->id_pouzivatela = $id_pouzivatela;
    }

    private $id_produktu;

    /**
     * @return mixed
     */
    public function getIdProduktu()
    {
        return $this->id_produktu;
    }

    /**
     * @param mixed $idProduktu
     */
    public function setIdProduktu($idProduktu): void
    {
        $this->id_produktu = $idProduktu;
    }
    private $pocetKusov;

    /**
     * @return mixed
     */
    public function getPocetKusov()
    {
        return $this->pocetKusov;
    }

    /**
     * @param mixed $pocetKusov
     */
    public function setPocetKusov($pocetKusov): void
    {
        $this->pocetKusov = $pocetKusov;
    }
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
    private $balenie;

    /**
     * @return mixed
     */
    public function getBalenie()
    {
        return $this->balenie;
    }

    /**
     * @param mixed $balenie
     */
    public function setBalenie($balenie): void
    {
        $this->balenie = $balenie;
    }

    private $pocetDostupnychNaSklade;

    /**
     * @return mixed
     */
    public function getPocetDostupnychNaSklade()
    {
        return $this->pocetDostupnychNaSklade;
    }

    /**
     * @param mixed $pocetDostupnychNaSklade
     */
    public function setPocetDostupnychNaSklade($pocetDostupnychNaSklade): void
    {
        $this->pocetDostupnychNaSklade = $pocetDostupnychNaSklade;
    }



}