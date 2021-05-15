<?php
function secureData($data){
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}

function loggedIn(){
session_start();
if(isset($_SESSION['loggedin'])){
    return true;
}else return false;
}

function loginUser($username){
    if(session_id() == ''){
        //session has not started
        session_start();
    }
    session_regenerate_id();
    $_SESSION['loggedin'] = TRUE;
	$_SESSION['name'] = $username;
    header("Location: index.php");
}