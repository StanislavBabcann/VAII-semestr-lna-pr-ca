
<?php
include "Database.php";
$db = new Database();

$pocetKusov = $_GET['pocet'];
$idMenenej = $_GET['idPolozky'];

$db->aktualizujPocetProduktovPolozkyKosiku($idMenenej, $pocetKusov);
