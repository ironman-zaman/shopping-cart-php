<?php
namespace ShoppingCart;

class DataBase{
private $serverName = 'localhost';
private $dbName = 'shoppingcart';
private $dbUser = 'root';
private $dbPass = '';
public $conn;
    function __construct()
    {
        try {
            $this->conn = new \PDO("mysql:host=$this->serverName;dbname=$this->dbName",$this->dbUser,$this->dbPass);
        } catch (\PDOException $e) {
          echo "Connection Failed: " . $e->getMessage();
        }
    }
}