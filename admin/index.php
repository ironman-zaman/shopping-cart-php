<?php

use ShoppingCart\DataBase;
use ShoppingCart\Installer;
use ShoppingCart\Product;

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

/*Instantiate product class*/
$product = new Product();
/*Grab the list of all products*/
$productList = $product->showProducts();
?>

<?php
/*include header*/
require_once "templates/header.php";
?>

    <a href="add-product.php">Add New Product</a>
    <div class="product-list">
    <?php foreach ($productList as $product) {
     ?>
    <h2>
    <a href="single-product.php?id=<?php echo $product['id']; ?>">
    <?php echo $product['product_name']; ?>
    </a>
    </h2>
    <?php if(!empty($product['product_image'])) { ?>
     <img src="uploads/<?php echo $product['product_image']; ?>">
     <?php } ?>
    <a href="edit-product.php?id=<?php echo $product['id']; ?>">Edit</a>
    <a href="delete-product.php?id=<?php echo $product['id']; ?>">Delete</a>
    <?php       
    }
    ?>
    </div>

<?php
/*Include footer */
require_once "templates/footer.php";
?>