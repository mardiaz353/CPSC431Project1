<?php 
// include files
require_once('query.php');
require_once('validation.php');

if(isset($_POST["submit"])){ // when submit is pressed
    // initial variables and trim elimates whitespaces
    $username = validString(validUsername($_POST["username"]));
    $email = validString(validEmail($_POST["email"])); 
    $password = validPassword($_POST["password"]);
    $phone = validNumber($_POST["phone"]);
    $street = validString($_POST["street"]);
    $city = validString($_POST["city"]);
    $state = validString($_POST["state"]);
    $zip = validNumber($_POST["zip"]);
    $name = validString($_POST["name"]);
    $creditNumber = validNumber($_POST["credittNumber"]);
    $security = validNumber($_POST["security"]);
    $file = $_FILES['fileToUpload'];
    $fileName = $_FILES['fileToUpload']['name'];
    $fileTmpName = $_FILES['fileToUpload']['tmp_name'];
    $fileError = $_FILES['fileToUpload']['error'];
    $fileType = $_FILES['fileToUpload']['type'];// Gets the ext of file
    // check if its a valid file
    validFile($fileError, $fileType);

    $uploaded_file = 'uploads/'.$fileName;

    if(is_uploaded_file($fileTmpName)){
        if(!move_uploaded_file($fileTmpName,$uploaded_file)){
            echo 'Problem: Could not move file to destination directory';
            exit;
        }
    }

    // register here but function will be in a other file
    register($username, $email, $password, $phone,
    $street, $city, $state, $zip, $name, $creditNumber,
    $security, $uploaded_file);

    session_start();
    $_SESSION['valid_user'] = $username;
    header( 'Location: app.html');
}
?>