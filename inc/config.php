<?php

    // Login-Angaben für die Datenbank
    define('HOST', 'localhost');            // Der Host mit dem du dich verbinden willst.
    define('USER', 'root');             // Der Datenbank-Benutzername.
    define('PASSWORD', ''); // Das Datenbank-Passwort.
    define('DATABASE', 'phppraktikum');     // Der Datenbankname.
    $mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);

    //App-Konfigurationen
    define('MEMBERPAGE', 'memberpage.php');

?>
