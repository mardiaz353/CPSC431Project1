<?php
// connection function
function db_connect() {
    $result = new mysqli('localhost', 'root', '', 'user');
    if(!$result) {
        throw new Exception('Could not connect to db server');
    } else {
        return $result;
    }
}

// register function
function register($username, $email, $password, $phone,
$street, $city, $state, $zip, $name, $creditNumber,
$security, $uploaded_file)
{ 
    //connect to db
    $conn = db_connect();
    // check if username is unique 
    $result = $conn->query("SELECT * FROM user WHERE username='".$username."'");
    if(!$result) {
        throw new Exception('Could not execute query');
    }
    
    if($result->num_rows>0){
        throw new Exception('That username is taken');
    } 

    // else put in db
    $query = "INSERT INTO user(username, email, fName, lName, 
    password, phone, street, city, state, zip, name, creditNumber,
    security, uploaded_file)
    VALUES ('$username', '$email', '$fName', '$lName', sha256('".$password."'),
     '$phone', '$street', '$city', '$state', '$zip', '$name', '$creditNumber',
     '$security', '$uploaded_file')";
    $result = $conn->query($query);

    // just in case somthing happens
    if(!$result) {
        throw new Exception('Could not register into db please try again later');
    }
    return true;
    $result->free_result();
    $conn->close();
}

// login function
function login($username, $password) 
{
    // connect to db
    $conn = db_connect();

    // check if username is unique
    $result = $conn->query("SELECT * FROM user WHERE 
    username='".$username."' AND password=sha256('".$password."')");
    // sha1 = 40 log & sha256 = 64
    if(!$result) {
        throw new Exception('user is used already');
        exit;
    }

    if($result->num_rows>0) {
        return true;
    } else {
        throw new Exception('could not log you in');
        exit;
    }
    $result->free_result();
    $conn->close();
}
?>