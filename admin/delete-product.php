<?php
use ShoppingCart\Product;
//Check if system is installed or not
if (!file_exists("config.php")) {
    header('Location: installer.php');
}
/*Autoload*/
require_once "../vendor/autoload.php";

//check if user is logged in or not
if (!loggedIn()) {
    header("Location: login.php");
}
/*Grab the id of the product from GET variable */
if (isset($_GET['id'])){
    $productId = $_GET['id'];
    /*Secure product id*/
    $productId = secureData($productId);
    /*Create product object*/
    $product = new Product();
    /*Grab product infomration of this id*/
    $productInfo = $product->deleteProduct($productId);
}