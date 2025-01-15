<?php
require "includes/user-class.php";
session_start();

if (isset($_SESSION['login_status']) && $_SESSION['login_status'] === true) {
    header("Location: user/user-dashboard.php");
    exit();
}

$db = new DB();
$user = new User($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $userData = $user->loginUser($email);

    if ($userData && password_verify($password, $userData['password'])) {
        $_SESSION['login_status'] = true;
        $_SESSION['name'] = $userData['name'];
        $_SESSION['role'] = $userData['role'];
        header("Location: user/user-dashboard.php");
        exit();
    } else {
        $error = "Ongeldige email of wachtwoord!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Inloggen</h2>
    <?php if (isset($error)) echo "<p>$error</p>"; ?>
    <form method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Wachtwoord" required>
        <button type="submit">Login</button>
    </form>
    <a href="user/user-register.php">Account aanmaken</a>
</body>
</html>