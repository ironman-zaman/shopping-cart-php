<?php
use ShoppingCart\DataBase;
use ShoppingCart\Installer;
/*Composer Autoloader*/
require_once "../vendor/autoload.php";
//Check if system is installed or not
if (file_exists("config.php")) {
    header('Location: index.php');
}
//check if user is logged in or not
if (!loggedIn()) {
    header("Location: login.php");
}
/*Database Connection*/
$db = new DataBase;
/*Install the system*/
$installer = new Installer();
//create tables
if($installer->createTables($db->conn)===false){
    die("Unable to install the system!");
}
//create the config file
fopen('config.php','w') or die("Unable to install the system!");
//redirect to main page
header('Location: index.php');