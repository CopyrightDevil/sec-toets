<?php
session_start();
if ($_SESSION['login_status'] !== true) {
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Welkom, <?= htmlspecialchars($_SESSION['name']) ?>!</h1>

    <!-- Iedereen mag producten bekijken -->
    <a href="../product/product-view.php">Producten bekijken</a>

    <!-- Alleen admins mogen producten beheren -->
    <?php if ($_SESSION['role'] === 'admin'): ?>
        <a href="../product/product-add.php">Producten beheren</a>
    <?php endif; ?>

    <a href="user-logout.php">Uitloggen</a>
</body>
</html>