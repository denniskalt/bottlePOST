<?php
/**
    Verarbeitung des Formular-Inhaltes
*/
session_start();
include_once('config.php');
include_once('functions.php');

// Start der PHP-Sitzung
if (isset($_POST['email'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    /*if(!filterEmail($email) && empty($password)) {
        http_response_code(403);
    }*/

// Login-Bereich
    if(isset($_POST['loginbtn']) && isset($_POST['password'])) {
        // Sichere Session starten
        // Login erfolgreich
        if(login($email, $password, $mysqli) == true) {
            // Ausgabe gesicherte Seite
            header('Location: ../../'.MEMBERPAGE);
        }
        // Login fehlgeschlagen
        else {
            // Fehler auf Login-Seite
            header('Location: ../../index.php?error=login');
        }
    }

// Signup-Bereich
    else if(isset($_POST['signupbtn']) && isset($_POST['password']) && isset($_POST['user'])) {
        $user = $_POST['user'];
        // Registrierung erfolgreich
        if(signup($email, $password, $user, $mysqli) == true) {
            // Ausgabe gesicherte Seite
            //header('Location: ../../index.php?register=1');
            header('Location: register.php');
        }
        // Registrierung fehlgeschlagen
        else {
            // Fehler auf Signup-Seite
            header('Location: ../../index.php?error=signup');
        }
    }

// Passwort zurücksetzen-Bereich
    else if(isset($_POST['pwbtn'])) {
        // Registrierung erfolgreich
        if(list($email, $confirmcode, $pwreset) = pwreset($email, $mysqli)) {
            // Ausgabe Login-Seite
            //header('Location: pwreset.php?activate='.$confirmcode.'&email='.$email.'&pwreset='.$pwreset.'');
            header("Location: pwreset.php?activate=$confirmcode&email=$email&pwreset=$pwreset");
        }
        // Registrierung fehlgeschlagen
        else {
            // Fehler bei PW-Reset
            header('Location: ../../index.php?error=1');
        }
    }

// Weder der Login-, noch der Signup-Button wurde gedrückt.
    else {
        header('Location: ../../index.php?error=push');
    }
}

else {
    // Die korrekten POST-Variablen wurden nicht zu dieser Seite geschickt.
    header('Location: ../../index.php?error=var');
}
?>
