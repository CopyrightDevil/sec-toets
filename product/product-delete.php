<?php
require "../includes/product-class.php";
session_start();

if (!isset($_SESSION['login_status']) || $_SESSION['role'] !== 'admin') {
    die("Geen toegang!");
}

if (!isset($_GET['id'])) {
    die("Product ID ontbreekt.");
}

$db = new DB();
$product = new Product($db);

$id = $_GET['id'];
$product->deleteProduct($id);

echo "Product verwijderd!";
header("Location: product-view.php");
exit();
?>