<?php
require "db.php";

class Product {
    private $db;

    public function __construct(DB $db) {
        $this->db = $db;
    }

    public function addProduct($name, $description, $price, $productCode, $categoryId) {
        $this->db->run(
            "INSERT INTO product (name, description, price, productCode, category_id) 
            VALUES (?, ?, ?, ?, ?)",
            [$name, $description, $price, $productCode, $categoryId]
        );
    }

    public function getProducts() {
        return $this->db->run("SELECT * FROM product")->fetchAll();
    }

    public function getProduct($id) {
        return $this->db->run("SELECT * FROM product WHERE id = ?", [$id])->fetch();
    }

    public function updateProduct($id, $name, $description, $price, $productCode) {
        $this->db->run(
            "UPDATE product SET name = ?, description = ?, price = ?, productCode = ? WHERE id = ?",
            [$name, $description, $price, $productCode, $id]
        );
    }

    public function deleteProduct($id) {
        $this->db->run("DELETE FROM product WHERE id = ?", [$id]);
    }
}
?>