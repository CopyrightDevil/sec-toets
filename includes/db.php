<?php
class DB {
    private $pdo;

    public function __construct($db = "shop", $user = "root", $pwd = "", $host = "localhost") {
        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pwd, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        } catch (PDOException $e) {
            die("Databaseverbinding mislukt: " . $e->getMessage());
        }
    }

    public function run($sql, $args = []) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }
}
?>