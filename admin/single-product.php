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
if (!isset($_GET['id'])) {
    die("Product Id Is Empty!");
}
$productId = $_GET['id'];
/*Secure product id*/
$productId = secureData($productId);

/*Grab product infomration of this id */
$product = new Product();
$productInfo = $product->singleProductInfo($productId);
?>

<?php
/*include header*/
require_once "templates/header.php";
?>

<div class="single-product">
<h1><?php echo $productInfo['product_name']; ?></h1>
<?php if(!empty($productInfo['product_image'])) { ?>
     <img src="uploads/<?php echo $productInfo['product_image']; ?>">
<?php } ?>
<p><?php echo $productInfo['product_desc']; ?></p>
<p><small><?php echo $productInfo['product_price']; ?></small></p>
</div>

<?php
/*Include footer */
require_once "templates/footer.php";
?>
    