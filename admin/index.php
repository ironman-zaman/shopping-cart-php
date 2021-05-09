<?php

use ShoppingCart\DataBase;
use ShoppingCart\Installer;

/*Composer Autoloader*/
require_once "../vendor/autoload.php";

/*Database Connection*/
$db = new DataBase();

/*Install the system*/
$installer = new Installer();
//create tables
if($installer->createTables($db->conn)===false){
    die("Table is not created");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart Admin</title>
</head>
<body>
    <div class="wrapper">
        <a href="add-product.php">Add New Product</a>
    </div>
</body>
</html>