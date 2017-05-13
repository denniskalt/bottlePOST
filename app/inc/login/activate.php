<?php
$status = session_status();
if($status == PHP_SESSION_NONE){
    //There is no active session
    session_start();
}else
if($status == PHP_SESSION_DISABLED){
    //Sessions are not available
}
include_once('../../config.php');
include_once('functions.php');

    $confirmcode = $_GET["activate"];
    $email = $_GET["email"];
    if(activateAccount($email, $confirmcode, $mysqli)) {
        header('Location: '.MEMBERPAGE);
    }
    else {
        header('Location: index.php?vew=error&id=1');
    }

?>
