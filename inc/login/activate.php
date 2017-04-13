<?php
session_start();
include_once('config.php');
include_once('functions.php');

    $confirmcode = $_GET["activate"];
    $email = $_GET["email"];
    if(activateAccount($email, $confirmcode, $mysqli)) {
        header('Location: ../../'.MEMBERPAGE);
    }
    else {
        header('Location: ../../index.php?error=activate');
    }

?>
