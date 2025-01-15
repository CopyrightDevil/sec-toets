<?php
require "../includes/user-class.php";

$db = new DB();
$user = new User($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user->registerUser($name, $email, $password);
    echo "Account aangemaakt!";
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account aanmaken</title>
</head>
<body>
    <h2>Account aanmaken</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Naam" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Wachtwoord" required>
        <button type="submit">Aanmaken</button>
    </form>
</body>
</html>