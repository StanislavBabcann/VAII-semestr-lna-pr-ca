<?php

class PonukanyProdukt
{
    private $idProduktu;

    /**
     * @return mixed
     */
    public function getIdProduktu()
    {
        return $this->idProduktu;
    }

    /**
     * @param mixed $idProduktu
     */
    public function setIdProduktu($idProduktu): void
    {
        $this->idProduktu = $idProduktu;
    }
    private $nazovProduktu;

    /**
     * @return mixed
     */
    public function getNazovProduktu()
    {
        return $this->nazovProduktu;
    }

    /**
     * @param mixed $nazovProduktu
     */
    public function setNazovProduktu($nazovProduktu): void
    {
        $this->nazovProduktu = $nazovProduktu;
    }
    private $hlavnaKategoria;
    private $podKategoria;
    private $popisProduktu;
    private $cestaKObrazku;
    private $vyrobca;
    private $hlavnyNadpis;
    private $keyBenefits;
    private $dosage;
    private $nutricneHodnoty;
    private $zlozenie;

    /**
     * @return mixed
     */
    public function getZlozenie()
    {
        return $this->zlozenie;
    }

    /**
     * @param mixed $zlozenie
     */
    public function setZlozenie($zlozenie): void
    {
        $this->zlozenie = $zlozenie;
    }

    /**
     * @return mixed
     */
    public function getNutricneHodnoty()
    {
        return $this->nutricneHodnoty;
    }

    /**
     * @param mixed $nutricneHodnoty
     */
    public function setNutricneHodnoty($nutricneHodnoty): void
    {
        $this->nutricneHodnoty = $nutricneHodnoty;
    }

    /**
     * @return mixed
     */
    public function getDosage()
    {
        return $this->dosage;
    }

    /**
     * @param mixed $dosage
     */
    public function setDosage($dosage): void
    {
        $this->dosage = $dosage;
    }

    /**
     * @return mixed
     */
    public function getKeyBenefits()
    {
        return $this->keyBenefits;
    }

    /**
     * @param mixed $keyBenefits
     */
    public function setKeyBenefits($keyBenefits): void
    {
        $this->keyBenefits = $keyBenefits;
    }

    /**
     * @return mixed
     */
    public function getHlavnyNadpis()
    {
        return $this->hlavnyNadpis;
    }

    /**
     * @param mixed $hlavnyNadpis
     */
    public function setHlavnyNadpis($hlavnyNadpis): void
    {
        $this->hlavnyNadpis = $hlavnyNadpis;
    }

    /**
     * @return mixed
     */
    public function getVyrobca()
    {
        return $this->vyrobca;
    }

    /**
     * @param mixed $vyrobca
     */
    public function setVyrobca($vyrobca): void
    {
        $this->vyrobca = $vyrobca;
    }

    /**
     * @return mixed
     */
    public function getCestaKObrazku()
    {
        return $this->cestaKObrazku;
    }

    /**
     * @param mixed $cestaKObrazku
     */
    public function setCestaKObrazku($cestaKObrazku): void
    {
        $this->cestaKObrazku = $cestaKObrazku;
    }

    /**
     * @return mixed
     */
    public function getPopisProduktu()
    {
        return $this->popisProduktu;
    }

    /**
     * @param mixed $popisProduktu
     */
    public function setPopisProduktu($popisProduktu): void
    {
        $this->popisProduktu = $popisProduktu;
    }

    /**
     * @return mixed
     */
    public function getPodKategoria()
    {
        return $this->podKategoria;
    }

    /**
     * @param mixed $podKategoria
     */
    public function setPodKategoria($podKategoria): void
    {
        $this->podKategoria = $podKategoria;
    }

    /**
     * @return mixed
     */
    public function getHlavnaKategoria()
    {
        return $this->hlavnaKategoria;
    }

    /**
     * @param mixed $hlavnaKategoria
     */
    public function setHlavnaKategoria($hlavnaKategoria): void
    {
        $this->hlavnaKategoria = $hlavnaKategoria;
    }





}