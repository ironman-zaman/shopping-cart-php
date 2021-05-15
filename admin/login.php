<?php

use ShoppingCart\ErrorHandler;
use ShoppingCart\User;

//composer autoload
require_once "../vendor/autoload.php";
//Check if system is installed or not
if (!file_exists("config.php")) {
    header('Location: installer.php');
}
//check if user is logged in or not
if (loggedIn()) {
    header("Location: index.php");
}
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    /*Form validation*/
    $errorHandler = new ErrorHandler();
    /*Check to see if all the required fields are given*/
    if (empty($username)) {
        $errorHandler->errors(0,"User name can't be empty");
    }
    if (empty($password)) {
        $errorHandler->errors(1,"Password can't be empty");
    }
    $user = new User();
    $password = md5($password);
    if (!$user->userExist($username,$password)) {
        $errorHandler->errors(2,"User does not exist");
    }
    /*If there is any error display it*/
    if ($errorHandler->errors()) {
        foreach ($errorHandler->errors() as $error) {
            echo $error.'<br>';
            $errorHandler = null;
        }
    }else{
        loginUser($username);
    }
}

?>
<?php
/*include header*/
require_once "templates/header.php";
?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <input type="text" placeholder="Username:" name="username"><br><br>
    <input type="text" placeholder="Password" name="password"><br><br>
    <input type="submit" value="Submit" name="submit">
</form>
<?php
/*Include footer */
require_once "templates/footer.php";
?>
    