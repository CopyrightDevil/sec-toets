<?php
require "db.php";

class Product {
    private $pdo;

    public function __construct() {
        $this->pdo = new DB();
    }
    public function addProduct($name, $description, $price, $productcode, $categoryId) 
    {
        $this->pdo->run(
            "INSERT INTO product (name, description, price, productcode, category_id) VALUES 
                ('$name', '$description', $price, '$productcode', $categoryId)"
        );
    }
    public function getProduct($productId) {
        return $this->pdo->run("SELECT * FROM product WHERE id = $productId")->fetch();
    }
    public function getProducts() {
        return $this->pdo->run("SELECT * FROM product")->fetchAll();
    }
    public function getCategory() {
        return $this->pdo->run("SELECT * FROM category")->fetchAll();
    }
    public function editProduct($id, $name, $description, $price, $productCode) {
        $this->pdo->run(
            "UPDATE product SET name = '$name', 
            description = '$description', 
            price = $price,
            productCode = '$productCode'         
            WHERE id = $id"
        );
    }
    public function deleteProduct($productCode) {
        $this->pdo->run("DELETE FROM product WHERE productCode = '$productCode'");
    }
}