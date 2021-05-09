<?php

use ShoppingCart\Product;
require_once "../vendor/autoload.php";

if (isset($_POST['submit'])) {
    $productName = secureData($_POST['product-name']);
    $productDesc = secureData($_POST['product-desc']);
    $productPrice = secureData($_POST['product-price']);
    $productImg = secureData(basename($_FILES["product-image"]["name"]));

    if (empty($productName) || empty($productDesc) || empty($productPrice) || empty($productImg)) {
        echo "Please fill up all the fields";
    }else{
        $product = new Product();
        $product->insertProduct($productName,$productDesc,$productPrice,$productImg);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
        <input type="text" placeholder="Eneter Product Name" name="product-name"><br><br>
        <textarea  id="" cols="30" rows="10" placeholder="Enter Prouct Description" name="product-desc"></textarea><br><br>
        <input type="text" placeholder="Product Price" name="product-price"><br><br>
        <input type="file" name="product-image" id=""><br><br>
        <input type="submit" value="Submit" name="submit">
    </form>
</body>
</html>