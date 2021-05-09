<?php
namespace ShoppingCart;

class Installer{
    public function createTables($conn){
        // sql to create tables
        $productTableSql = "CREATE TABLE IF NOT EXISTS products (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        product_name VARCHAR(30) NOT NULL,
        product_desc TEXT NOT NULL,
        product_image TEXT,
        product_price VARCHAR(30),
        creation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        $tableCreated = $conn -> exec($productTableSql);
        $conn = null;
        return $tableCreated;
    }
}