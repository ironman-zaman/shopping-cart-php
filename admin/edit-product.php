<?php

use ShoppingCart\ErrorHandler;
use ShoppingCart\Product;
/*Autoload*/
require_once "../vendor/autoload.php";

/*Declate variable globally*/
$productId = "";
$productInfo =array();

/*Grab the id of the product from GET variable */
if (isset($_GET['id'])){
    $productId = $_GET['id'];
    /*Secure product id*/
    $productId = secureData($productId);
    /*Create product object*/
    $product = new Product();
    /*Grab product infomration of this id*/
    $productInfo = $product->singleProductInfo($productId);
    //die the product is not found
    if (!$productInfo) {
        die("No products found");
    }
}
/*Update product*/
else if (isset($_POST['submit'])) {
    $productName = secureData($_POST['product-name']);
    $productDesc = secureData($_POST['product-desc']);
    $productPrice = secureData($_POST['product-price']);
    $productImg = secureData(basename($_FILES["product-image"]["name"]));
    $productId = secureData($_POST['product-id']);
    
    /*Form validation*/
    $errorHandler = new ErrorHandler();

    /*Check to see if all the required fields are given*/
    if (empty($productName)) {
        $errorHandler->errors(0,"Product name can't be empty");
    }
    if (empty($productDesc)) {
        $errorHandler->errors(1,"Product description can't be empty");
    }
    if (empty($productPrice)) {
        $errorHandler->errors(2,"Product price can't be empty");
    }

    /*If there is any error display it*/
    if ($errorHandler->errors()) {
        foreach ($errorHandler->errors() as $error) {
            echo $error.'<br>';
            $errorHandler = null;
        }
    }else{
        //update product
        $product = new Product();
        $product->updateProduct($productId,$productName,$productDesc,$productPrice,$productImg);
    }
    /*Grab product infomration of this id*/
    $product = new Product();
    $productInfo = $product->singleProductInfo($productId);
}
/*If there is no product id in the url and no submission then die*/
else{
    die("You are not allowed to access this page");
}
?>

<?php
/*include header*/
require_once "templates/header.php";
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
        <input type="text" value="<?php echo $productInfo['product_name']; ?>" name="product-name"><br><br>
        <textarea  id="" cols="30" rows="10"  name="product-desc"><?php echo $productInfo['product_desc']; ?></textarea><br><br>
        <input type="text" value="<?php echo $productInfo['product_price']; ?>" name="product-price"><br><br>
        <input type="file" name="product-image" id="" value=""><br><br>
        <input type="hidden" value="<?php echo $productInfo['id']; ?>" name="product-id">
        <input type="submit" value="Submit" name="submit">
</form>

<?php
/*Include footer */
require_once "templates/footer.php";
?>

