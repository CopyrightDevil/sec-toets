<?php
require "../includes/product-class.php";
// control login status
session_start();
if ($_SESSION['login_status'] != true) {
    header("Location: ../index.php");
    die();
}
// check productCode
if (!isset($_GET['productCode'])) {
    echo "Selecteer eerst een product!";
    header("refresh:2, url = product-view.php");
} else {
    try {
        $product = new Product();
        $product->deleteProduct($_GET['productCode']);
        echo "Product deleted!";
        header("refresh:2, url = product-view.php");
    } catch (\Exception $e) {
        die("fout bij het verwijderen");
    }
}


?>
