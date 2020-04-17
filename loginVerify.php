<?php
// include files
require_once('query.php');
require_once('validation.php');

if(isset($_POST["submit"])){ // when submit is pressed
// assign variables   
$username = validUsername($_POST["username"]);
$password = validPassword($_POST["password"]);

login($username, $password);
// if login: start session 
session_start();
$_SESSION['valid_user'] = $username;
header( 'Location: home.php');
}
?>