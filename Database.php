<?php

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
        $stmt->execute([$pouzivatel->meno, $pouzivatel->priezvisko, $pouzivatel->mail, $pouzivatel->mesto, $pouzivatel->ulica, $pouzivatel->mail]);
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

}