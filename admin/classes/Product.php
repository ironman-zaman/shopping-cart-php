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
    }

    function showProducts(){
        
    }
}
?>