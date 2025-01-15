<?php
require "../includes/product-class.php";
session_start();

if (!isset($_SESSION['login_status']) || $_SESSION['role'] !== 'admin') {
    die("Geen toegang!");
}

$db = new DB();
$product = new Product($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $productCode = $_POST['productCode'];
    $categoryId = $_POST['categoryId'];

    $product->addProduct($name, $description, $price, $productCode, $categoryId);
    echo "Product toegevoegd!";
    header("Location: product-view.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product toevoegen</title>
</head>
<body>
    <h2>Product toevoegen</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Naam" required>
        <input type="text" name="description" placeholder="Beschrijving" required>
        <input type="number" name="price" min="0.01" step="0.01" placeholder="Prijs" required>
        <input type="text" name="productCode" placeholder="Productcode" required>
        <select name="categoryId" required>
            <option value="">Selecteer een categorie</option>
            <?php
            foreach ($product->getProducts() as $category) {
                echo "<option value='{$category['id']}'>{$category['name']}</option>";
            }
            ?>
        </select>
        <button type="submit">Toevoegen</button>
    </form>
    <a href="product-view.php">Terug naar overzicht</a>
    <a href="../user/user-dashboard.php">Terug naar dashboard</a>
</body>
</html>