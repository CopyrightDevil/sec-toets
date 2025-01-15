<?php
require "../includes/product-class.php";
session_start();

if (!isset($_SESSION['login_status']) || $_SESSION['role'] !== 'admin') {
    die("Geen toegang!");
}

$db = new DB();
$product = new Product($db);

if (!isset($_GET['id'])) {
    die("Product ID ontbreekt.");
}

$id = $_GET['id'];
$currentProduct = $product->getProduct($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $productCode = $_POST['productCode'];

    $product->updateProduct($id, $name, $description, $price, $productCode);
    echo "Product bijgewerkt!";
    header("Location: product-view.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product bewerken</title>
</head>
<body>
    <h2>Product bewerken</h2>
    <form method="POST">
        <input type="text" name="name" value="<?= htmlspecialchars($currentProduct['name']) ?>" required>
        <input type="text" name="description" value="<?= htmlspecialchars($currentProduct['description']) ?>" required>
        <input type="number" name="price" value="<?= htmlspecialchars($currentProduct['price']) ?>" min="0.01" step="0.01" required>
        <input type="text" name="productCode" value="<?= htmlspecialchars($currentProduct['productCode']) ?>" required>
        <button type="submit">Opslaan</button>
    </form>
    <a href="product-view.php">Annuleren</a>
</body>
</html>