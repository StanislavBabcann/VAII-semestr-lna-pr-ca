<?php
session_start();
$_SESSION['choosenCategorySES'] = "Best products";
header("location: View/ProductsLayout.php");


