<?php
// checks if its empty and takes out stuff 
function validString($string) {
    // if string is empty return false
    if(empty($string)) {throw new Exception('Please fill out form');}
    $string = trim($string);// remove whitespace
    $string = stripslashes($string); // remove 
    $string = htmlspecialchars($string); // only chars
    return $string;
}

// checks if their is numbers
function validNumber($num) {
    if(!preg_match('/^[0-9]+$/', $num)){
        throw new Exception('Numbers only');
        exit;
    }
    return true;
}

// checks if username has 2 to 20 char that are letters \w
function validUsername($user) {
    if(!preg_match('/^\w{2,20}$/', $user)){
        throw new Exception('not a valid username');
        exit;
    }
    return validString($user);
}

// checks if their is input has 6 digits
function validPassword($pass) {
    if(strlen($pass) < 6) {
        throw new Exception("That Password is not valid");
        exit;
    }
    return validString($pass);
}

function validEmail($email) {
    if(!preg_match('/^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/', $email)){
        throw new Exception('not a valid email');
        exit;
    }
    return true;
}

function validFile($fileError, $fileType) {
    // this checks if the file extension is correct
    if($fileType != 'image/jpeg' && $fileType != 'image/png'){
        echo 'Problem: file is not a PNG image or a JPEG: ';
        return false;
    } 

     //if there is a error then display error sign
    if($fileError > 0){ 
        echo 'Problem: ';
        switch ($fileError) {
            case 1:
                throw new Exception('File exceed upload_max_file_size.');
            case 2:
                throw new Exception('File exceed max_file_size');
            case 3: 
                throw new Exception('File only partially uploaded.');
            case 4: 
                throw new Exception('No file uploaded.');
            case 6:
                throw new Exception('Cannot upload file: No temp directory specified.');
            case 7: 
                throw new Exception('Upload failed: Cannot write to disk');
            case 8: 
                throw new Exception('A PHP extension blocked the file upload');
            default:
        }
    } else {
        return true;
    }
}
?>