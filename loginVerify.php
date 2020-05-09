<?php
// include files
require_once('query.php');
require_once('validation.php');
$_SESSION['cart'] = array();
if(isset($_POST["submit"])){ // when subit is pressed
// assign variables   
$username = validUser($_POST["username"],"username");
$password = validUser($_POST["password"], "password");

login($username, $password);

// if login: start session 
session_start();
$_SESSION['valid_user'] = $username;
// move to home.php
header( 'Location: home.php');
}
?>
