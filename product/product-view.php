<?php
require "../includes/product-class.php";
session_start();

if (!isset($_SESSION['login_status'])) {
    die("Geen toegang!");
}

$db = new DB();
$product = new Product($db);
$products = $product->getProducts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producten overzicht</title>
</head>
<body>
    <h2>Producten overzicht</h2>
    <a href="../user/user-dashboard.php">Terug naar dashboard</a>
    <a href="../user/user-logout.php">Log uit</a>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Naam</th>
                <th>Beschrijving</th>
                <th>Prijs</th>
                <th>Productcode</th>
                <th>Categorie</th>
                <?php if ($_SESSION['role'] === 'admin'): ?>
                    <th>Acties</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= htmlspecialchars($product['id']) ?></td>
                    <td><?= htmlspecialchars($product['name']) ?></td>
                    <td><?= htmlspecialchars($product['description']) ?></td>
                    <td><?= htmlspecialchars($product['price']) ?></td>
                    <td><?= htmlspecialchars($product['productCode']) ?></td>
                    <td><?= htmlspecialchars($product['category_id']) ?></td>
                    <?php if ($_SESSION['role'] === 'admin'): ?>
                        <td>
                            <a href="product-edit.php?id=<?= $product['id'] ?>">Bewerken</a>
                            <a href="product-delete.php?id=<?= $product['id'] ?>" onclick="return confirm('Weet je zeker dat je dit product wilt verwijderen?')">Verwijderen</a>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>