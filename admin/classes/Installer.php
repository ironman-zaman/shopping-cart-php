<?php
namespace ShoppingCart;

class Installer{
    private $tableCreated = false;
    public function createTables($conn){
        try {
            $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
           // sql to create table product
            $productTableSql = "CREATE TABLE IF NOT EXISTS products (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            product_name VARCHAR(30) NOT NULL,
            product_desc TEXT NOT NULL,
            product_image TEXT,
            product_price VARCHAR(30),
            creation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )";
            // use exec() because no results are returned
            $conn->exec($productTableSql );
            // sql to create table users
            $userTableSql = "CREATE TABLE IF NOT EXISTS users (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(30) NOT NULL,
            pass VARCHAR(100) NOT NULL,
            email VARCHAR(100),
            creation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )";
            // use exec() because no results are returned
            $conn->exec($userTableSql);
            $this -> tableCreated = true;
          } catch(\PDOException $e) {
            $this -> tableCreated = false;
            echo $e->getMessage();
          }
          
        $conn = null;
        return $this -> tableCreated;
    }
}