<?php
namespace ShoppingCart;

class Product{
    private $conn;
    function __construct()
    {
        $db = new DataBase();
        $this->conn = $db -> conn;
    }
    function insertProduct($productName,$productDesc,$productPrice,$productImg){
        try {
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $stmt = $this->conn->prepare("INSERT INTO 
            products (product_name,product_desc,product_image,product_price)
            VALUES (:product_name,:product_desc,:product_image,:product_price)
            ");
            $stmt -> bindParam(':product_name',$productName);
            $stmt -> bindParam(':product_desc',$productDesc);
            $stmt -> bindParam(':product_image',$productImg);
            $stmt -> bindParam(':product_price',$productPrice);
            $stmt -> execute();
            echo "Products Added";
        } catch (\PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $this->conn = null;
    }

    function updateProduct($productId,$productName,$productDesc,$productPrice,$productImg){
        try {
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $stmt = $this->conn->prepare("UPDATE products 
            SET product_name = :product_name, product_desc = :product_desc, product_image = :product_image, product_price = :product_price
            WHERE id = :product_id
            ");
            $stmt -> bindParam(':product_name',$productName);
            $stmt -> bindParam(':product_desc',$productDesc);
            $stmt -> bindParam(':product_image',$productImg);
            $stmt -> bindParam(':product_price',$productPrice);
            $stmt -> bindParam(':product_id',$productId);
            $stmt -> execute();
            echo "Products Updated";
        } catch (\PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $this->conn = null;
    }

    function deleteProduct($productId){
        try {
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $stmt = $this->conn->prepare("DELETE FROM products
            WHERE id = :product_id
            ");
            $stmt -> bindParam(':product_id',$productId);
            $stmt -> execute();
            echo "Product Deleted";
        } catch (\PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $this->conn = null;
    }

    function showProducts(){
        $results = array();
        try {
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
            $stmt = $this->conn->prepare("SELECT * FROM products");
            $stmt->execute();
            $results = $stmt->fetchAll();

        } catch (\PDOException $e) {
            //throw $th;
        }

        return $results;
    }

    function singleProductInfo($productId){
        $results = array();
        try {
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
            $stmt = $this->conn->prepare("SELECT * FROM products WHERE id = :id");
            $stmt->bindParam(':id',$productId);
            $stmt->execute();
            $results = $stmt->fetch();
        } catch (\PDOException $e) {
           echo $e->getMessage();
           die();
        }

        return $results;
    }
}
?>