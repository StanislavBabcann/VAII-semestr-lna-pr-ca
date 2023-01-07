<?php
include "ProduktNakupnehoKosiku.php";
include "PonukanyProdukt.php";
include "Pouzivatel.php";

class Database
{



    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=localhost;dbname=database', "root", "dtb456");
    }


    public function pridajPouzivatela(Pouzivatel $pouzivatel) {
        $sql= "INSERT into uzivatelia (meno, priezvisko, mail, mesto, ulica, heslo) VALUES (?, ?, ?, ?, ?, ?)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([$pouzivatel->meno, $pouzivatel->priezvisko, $pouzivatel->mail,$pouzivatel->mesto, $pouzivatel->ulica, $pouzivatel->heslo]);
    }

    public function nacitajInfoUzivatela($mail) : Pouzivatel {
        $stm = $this->pdo->prepare("SELECT * FROM uzivatelia WHERE mail = ?");
        $stm->execute([$mail]);
        return $stm->fetchAll(PDO::FETCH_CLASS, Pouzivatel::class)[0];
    }

    public function upravInfoPouzivatela(Pouzivatel $pouzivatel) {
        $sql = "UPDATE uzivatelia SET meno=?, priezvisko=?, mail=?, mesto=?, ulica=? WHERE mail = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$pouzivatel->meno, $pouzivatel->priezvisko, $pouzivatel->mail, $pouzivatel->mesto, $pouzivatel->ulica, $pouzivatel->druhyMail]);
    }

    public function zmenHesloPouzivatela($mail, $heslo) {
        $sql = "UPDATE uzivatelia SET heslo=? WHERE mail = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$heslo, $mail]);

    }

    public function deleteUserAccount($mail) {
        $sql = "DELETE FROM uzivatelia WHERE mail = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$mail]);
    }

    public function doesHaveMail($mail) : int {
        $stmt = $this->pdo->prepare("SELECT * FROM uzivatelia WHERE mail = ?");
        $stmt->execute([$mail]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return 0;
        } else {
            return 1;
        }

    }

    public function getPasswordOfUser($mail) : string {
        $stmt = $this->pdo->prepare("SELECT heslo FROM uzivatelia WHERE mail = ?");
        $stmt->execute([$mail]);
        $result = $stmt->fetchColumn();

        return $result;

    }

    public function resetTable() {
        $stmt = $this->pdo->prepare("ALTER TABLE uzivatelia AUTO_INCREMENT = 1");
        $stmt->execute();

        $stmt = $this->pdo->prepare("DELETE FROM uzivatelia");
        $stmt->execute();
    }

    public function dajProduktyHlavnejKategorie($hlavnaKategoria) {


        $sql = $this->pdo->prepare("SELECT DISTINCT idProduktu, cestaKObrazku, nazovProduktu FROM produkty PR JOIN varianty_produktov VP ON PR.idProduktu = VP.id_produktu WHERE PR.hlavnaKategoria = ? && VP.pocetKusov != 0");
        $sql->execute([$hlavnaKategoria]);
        return $sql->fetchAll();
    }

    public function dajProduktyPodKategorie($podKategoria) {


        $sql = $this->pdo->prepare("SELECT DISTINCT idProduktu, cestaKObrazku, nazovProduktu FROM produkty PR JOIN varianty_produktov VP ON PR.idProduktu = VP.id_produktu WHERE PR.podKategoria = ? && VP.pocetKusov != 0");
        $sql->execute([$podKategoria]);
        return $sql->fetchAll();
    }

    public function dajInfoOProdukte($idProduktu) {
        $sql = $this->pdo->prepare("SELECT * FROM produkty WHERE idProduktu = ?");
        $sql->execute([$idProduktu]);
        return $sql->fetchAll()[0];
    }

    public function dajProduktyPodlaVyrobcu($vyrobca) {
        $sql = $this->pdo->prepare("SELECT * FROM produkty WHERE vyrobca = ?");
        $sql->execute([$vyrobca]);
        return $sql->fetchAll();
    }

    public function dajVariantyProduktov($idProduktu) {
        $sql = $this->pdo->prepare("SELECT * FROM varianty_produktov WHERE id_produktu = ? && pocetKusov != 0");
        $sql->execute([$idProduktu]);

        return $sql->fetchAll();
    }

    public function dajDostupneBalenia($idProduktu) {
        $sql = $this->pdo->prepare("SELECT distinct balenie FROM varianty_produktov WHERE id_produktu = ? && pocetKusov != 0 ORDER BY balenie");
        $sql->execute([$idProduktu]);


        return $sql->fetchAll(PDO::FETCH_CLASS, DostupneBalenie::class);
    }

    public function dajCenuProduktuPodlaBalenia($idProduktu, $balenie) {
        $sql = $this->pdo->prepare("SELECT cena FROM varianty_produktov WHERE id_produktu = ? && balenie = ?");
        $sql->execute([$idProduktu, $balenie]);
        return $sql->fetchAll()[0];

    }

    public function dajPrichuteProduktu($idProduktu) {
        $sql = $this->pdo->prepare("SELECT prichut FROM varianty_produktov WHERE id_produktu = ? && pocetKusov != 0");
        $sql->execute([$idProduktu]);
        return $sql->fetchAll(PDO::FETCH_CLASS, DostupnaPrichutPreBalenie::class);
    }

    public function dajNajnizsieCenyProduktov($idProduktu) {
        $sql = $this->pdo->prepare("SELECT min(cena) FROM varianty_produktov WHERE id_produktu = ? && pocetKusov != 0");
        $sql->execute([$idProduktu]);

        return $sql->fetchAll()[0][0];
    }

    public function nacitajData() {
        $filename = 'files/variantyProduktov.txt';


        $f = fopen($filename, 'r');

        if (!$f) {
            return;
        }

        while (!feof($f)) {
            $line = fgets($f);
            echo $line;
            $lineSplit = explode("*", $line);

            $sql = $this->pdo->prepare("INSERT into varianty_produktov(id, id_produktu, prichut, balenie, cena, pocetKusov) values (?,?,?,?,?,?)");
            $sql->execute([$lineSplit[0], $lineSplit[1], $lineSplit[2],$lineSplit[3], $lineSplit[4], $lineSplit[5]]);
        }



        fclose($f);
    }

    public function pridajPolozkuDoProduktovNakupnehoKosika(ProduktNakupnehoKosiku $produkt) {
        $sql= "INSERT into produkty_nakupneho_kosiku (id_pouzivatela, id_produktu, pocetKusov, prichut, balenie, cena) VALUES (?, ?, ?, ?, ?, ?)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([$produkt->getIdPouzivatela(), $produkt->getIdProduktu(), $produkt->getPocetKusov(),$produkt->getPrichut(), $produkt->getBalenie(), $produkt->getCena()]);
    }

    public function dajProduktyNakupnehoKosika($idUctu) {
        $sql = $this->pdo->prepare("SELECT * FROM produkty_nakupneho_kosiku WHERE id_pouzivatela = ?");
        $sql->execute([$idUctu]);
        return $sql->fetchAll(PDO::FETCH_CLASS, ProduktNakupnehoKosiku::class);
    }

    public function dajProduktPodlaId($id) {
        $sql = $this->pdo->prepare("SELECT * FROM produkty WHERE idProduktu = ?");
        $sql->execute([$id]);
        return $sql->fetchAll(PDO::FETCH_CLASS, PonukanyProdukt::class)[0];
    }

    public function zmazPolozkuKosiku($id) {
        $sql = $this->pdo->prepare("DELETE FROM produkty_nakupneho_kosiku WHERE id = ?");
        $sql->execute([$id]);
    }

    public function vyprazdniKosik($idUzivatela) {
        $sql = $this->pdo->prepare("DELETE FROM produkty_nakupneho_kosiku WHERE id_pouzivatela = ?");
        $sql->execute([$idUzivatela]);
    }

    public function odoberVariantProduktuZoSkladu($idProduktu, $balenie) {
        $sql = $this->pdo->prepare("UPDATE  varianty_produktov SET pocetKusov = pocetKusov - 1 WHERE id_produktu = ? && balenie = ?");
        $sql->execute([$idProduktu, $balenie]);
    }

    public function dajPocetProduktovNaSkladePodlaIdABalenia($idProduktu, $balenie) {
        $sql = $this->pdo->prepare("SELECT pocetKusov FROM varianty_produktov WHERE id_produktu = ? && balenie = ?");
        $sql->execute([$idProduktu, $balenie]);
        return $sql->fetchAll()[0][0];
    }

}