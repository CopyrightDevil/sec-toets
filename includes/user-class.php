<?php
require "db.php";

class User {
    private $pdo;

    public function __construct() {
        $this->pdo = new DB();
    }
    public function registerUser(String $name, String $email, String $password) {
        $hash = md5($password);
        $this->pdo->run(
            "INSERT INTO user (name, email, password) VALUES ('$name', '$email', '$hash')"
        );        
    }
    public function loginUser($email) {
        return $this->pdo->run("SELECT * FROM user WHERE email = '$email'")->fetch();
    }
}