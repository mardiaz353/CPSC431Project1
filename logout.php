<?php 
    session_start();
    $old = $_SESSION['valid_user'];

    unset($_SESSION['valid_user']);
    $result = session_destroy();
    header( 'Location: index.html');
    if(!empty($old)){
        if($result) {
            echo 'Logged out';
            header( 'Location: index.html');
        } else {
            echo "Could not log you out";
        }
    } else {
        echo 'you were not logged in.';
        header( 'Location: index.html');
    }
?>