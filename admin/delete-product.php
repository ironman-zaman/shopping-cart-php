<?php
use ShoppingCart\Product;
/*Autoload*/
require_once "../vendor/autoload.php";
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