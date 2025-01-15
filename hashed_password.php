<?php
$password = "12345"; // Vervang dit door het gewenste wachtwoord
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);
echo "Gehashte wachtwoord: " . $hashedPassword;
?>