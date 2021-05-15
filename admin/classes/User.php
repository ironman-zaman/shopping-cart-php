<?php
namespace ShoppingCart;

class User{
    private $conn;
    function __construct()
    {
        $db = new DataBase();
        $this->conn = $db -> conn;
    }

    function userExist($userName,$password){
        $results = array();
        try {
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = :username AND pass = :pass");
            $stmt->bindParam(':username',$userName);
            $stmt->bindParam(':pass',$password);
            $stmt->execute();
            $results = $stmt->fetchAll();

        } catch (\PDOException $e) {
            //throw $th;
        }
        return $results;
    }
}