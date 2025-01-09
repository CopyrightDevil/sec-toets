<?php
require "includes/user-class.php";
session_start();
if (isset($_SESSION['login_status']) &&  $_SESSION['login_status'] == true) {
    header("Location: user/user-dashboard.php");
}

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $user = new User();

        $email = $_POST['email'];
        $password = $_POST['password'];

        $userData = $user->loginUser($email);
        print_r($userData);
        if ($userData && md5($password) == $userData['password']) {
            session_start();
            $_SESSION['login_status'] = true;
            $_SESSION['name'] = $userData['naam'];
            header("Location:user/user-dashboard.php");
        } else {
            echo "Ongeldige email of wachtwoord!";
            header("refresh:2, url = user/user-login.php");
            die();
        }
    } 
}catch (Exception $e) {
    echo $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Document</title>
</head>
<body>
<h2>Inloggen</h2>
<form method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit">
    </form>
<a href="user/user-register.php">Nog geen account?</a>
</body>
</html>