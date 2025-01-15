<?php
require "db.php";

class User {
    private $db;

    public function __construct(DB $db) {
        $this->db = $db;
    }

    public function registerUser(string $name, string $email, string $password, string $role = 'user') {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $this->db->run(
            "INSERT INTO user (name, email, password, role) VALUES (?, ?, ?, ?)",
            [$name, $email, $hash, $role]
        );
    }

    public function loginUser(string $email) {
        return $this->db->run("SELECT * FROM user WHERE email = ?", [$email])->fetch();
    }
}
?>