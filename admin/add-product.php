<?php
use ShoppingCart\ErrorHandler;
use ShoppingCart\Product;

//composer autoload
require_once "../vendor/autoload.php";

//Check if system is installed or not
if (!file_exists("config.php")) {
    header('Location: installer.php');
}
//check if user is logged in or not
if (!loggedIn()) {
    header("Location: login.php");
}

if (isset($_POST['submit'])) {
    $productName = secureData($_POST['product-name']);
    $productDesc = secureData($_POST['product-desc']);
    $productPrice = secureData($_POST['product-price']);

    //product image
    $productImg = basename($_FILES["product-image"]["name"]);
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["product-image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
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

    /*if product image is uploaded*/
    if (!empty($productImg)) {
        /*check if the uploaded file is an image or not*/
        if(!getimagesize($_FILES["product-image"]["tmp_name"])){
            $errorHandler->errors(3,"File is not an image");
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            $errorHandler->errors(4,"Sorry, file already exists.");
        }
        // Check file size
        if ($_FILES["product-image"]["size"] > 500000) {
            $errorHandler->errors(5,"Sorry, your file is too large.");
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        $errorHandler->errors(6,"Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
        }
    }
    
    /*If there is any error display it*/
    if ($errorHandler->errors()) {
        foreach ($errorHandler->errors() as $error) {
            echo $error.'<br>';
            $errorHandler = null;
        }
    }else{
        /*If for some reason product image is not uploaded, exit*/
        if (!empty($productImg)) {
        if (!move_uploaded_file($_FILES["product-image"]["tmp_name"], $target_file)) {
            echo "Sorry, there was an error uploading your file.";
            die();
          } 
        }
        $product = new Product();
        $product->insertProduct($productName,$productDesc,$productPrice,$productImg);
    }
}
?>

<?php
/*include header*/
require_once "templates/header.php";
?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
        <input type="text" placeholder="Eneter Product Name" name="product-name"><br><br>
        <textarea  id="" cols="30" rows="10" placeholder="Enter Prouct Description" name="product-desc"></textarea><br><br>
        <input type="text" placeholder="Product Price" name="product-price"><br><br>
        <input type="file" name="product-image" id=""><br><br>
        <input type="submit" value="Submit" name="submit">
    </form>

<?php
/*Include footer */
require_once "templates/footer.php";
?>
    