<?php
include_once('config.php');
include_once('../data-validation/data-validation.php');

/**
Module Name: login
Description: Register and login users. Change passwords
Version: 1.0
Author: #
Author URI: #
*/
/**
    Use Case #01: The user can register with his email-adress and a password. Then he get an email with a link to activate his account. If it´s successful, he would be redirected to his profile page.

    Use Case #02: The user is already registered and want to be logged in. He use his email-adress and the password. If they are correct, he would be redirected to his profile page (in case he hadn´t the required fields) or to the dashboard.

    Use Case #03: The user has forgotten his password. He types in his email-adress and get an email with a link to activate his account. Then he will be redirected to a site he can change his password.

    Use Case #04: The user tries 3 times to login and has a false password. Then his account is blocked an he get an email with a link to activate his account. Then he will be redirected to a site he can change his password.
*/

/**
    Sicherer Aufbau einer PHP-Session

    @author Dennis Kalt
    @param string   $session_name   vergibt den Sessionnamen
    @param boolean  $secure         Cookie nur über gesicherte Verbindungen senden
    @param boolean  $httponly       HTTPonly-Flag für Übertragungen über HTTP
    @param []       $cookieParams   Array für die Session-Cookie-Parameter
    @version 1.0
*/
function sec_session_start() {
    $session_name = 'sec_session_id';
    $secure = false;
    $httponly = true;

    // Zwingt Sessions nur Cookies zu nutzen
    if(ini_set('session.use_only_cookies', 1) === FALSE) {
        header("Location: ../error.php");
        exit();
    }

    // Holt Cookie-Parameter
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params(
        $cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"],
        $secure,
        $httponly
    );

    // Setzt Session-Name
    session_name($session_name);
    session_start();            // Startet PHP-Sitzung
    session_regenerate_id();    // Erneuert Session, löscht alte
}

/**
    Maskieren von Eingaben

    @author Dennis Kalt
    @param  string  $input        Zu maskierende Eingabe
    @return string  $masked_string  Maskierte Ausgabe
    @version 1.0
*/
function mask($input) {
    $input = trim($input);
    $input = strip_tags($input);
    $input = htmlspecialchars($input);
    $input = mysql_real_escape_string($input);
    $masked_string = $input;


    return $masked_string;
}

/**
    Erzeugen eines zufälligen String mit der definierten Zeichenlänge aus den vorher definierten Zeichen

    @author Dennis Kalt
    @param  string  $length         Zeichenlänge des ausgegebenen Strings
    @return string  $randomString   Zufälliger String
    @version 1.0
*/
function randomString($length) {
    //Mögliche Zeichen für den String
    $zeichen = '0123456789';
    $zeichen .= 'abcdefghijklmnopqrstuvwxyz';
    $zeichen .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $zeichen .= './';

    //String wird generiert
    $randomString = '';
    $anzahl = strlen($zeichen);
    for ($i=0; $i<$length; $i++) {
        $randomString .= $zeichen[rand(0,$anzahl-1)];
    }

    return $randomString;
}

/**
    Generieren eines eindeutigen Salt

    @author Dennis Kalt
    @param  string  $email          Zu maskierende Eingabe
    @return integer $masked_string  Maskierte Ausgabe
    @version 1.0

    Bestandteile des Salt (21,5 Zeichen):
    1. Verwendete Funktion: $2a
    2. Anzahl der Runden (zwischen 1 und 31): $07
    3. individueller Salt: Groß- und Kleinbuchstaben, Zahlen sowie ./

    Der Salt wird mit einem Teil der verwendeten E-Mail-Adresse, einem Teil des UNIX-Zeitstempels und einem automatisch generierten Saltpart.
*/
function generateSalt($email, $rounds) {
    //Verwendete Funktion
    $usedFunction = '$2y';

    //0 vor Rundenanzahl bei Zahlen kleiner 10
    if($rounds<10) {
        $rounds='$0'.$rounds;
    }
    else {
        $rounds='$'.$rounds;
    }

    //Individueller Salt
    $emailPart = subStr($email, 0, 3);
    $randomSalt = randomString(25);

    $salt = subStr($usedFunction.$rounds.$emailPart.$randomSalt, 0, 22);

    return $salt;
}

/**
    Diese Funktion überprüft, ob auf dem Server CRYPT_BLOWFISH definiert ist, um BCRYPT verwenden zu können

    @author Dennis Kalt
    @return boolean (true = CRYPT_BLOWFISH enabled)
    @version 1.0
*/
function blowfish(){
    if (defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH) {
        // CRYPT_BLOWFISH is enabled
        return true;
    }
    else {
        // CRYPT_BLOWFISH is not available
        return false;
    }
}

/**
    Überprüft, ob mehr als x-beliebige Anmeldeversuche gescheitert sind und blockiert dann das Konto, versendet eine E-Mail zum Aktivieren.

    @author Dennis Kalt
    @param  string  $isersid        Ermittelte Users-ID
    @param  object  $mysqli         Verbindungseinstellungen
    @return boolean (true = mehr als x-beliebige Anmeldeversuche)
    @version 1.0
*/
function checkbrute($usersid, $mysqli) {
    // Holt den aktuellen Zeitstempel
    $time = time();

    // Erlaubte Anmeldeversuche
    $attemps = 3;

    if ($stmt = $mysqli->prepare("SELECT time FROM login_attempts WHERE id_users = ? ")) {
        $stmt->bind_param('i', $usersid);

        // Führe die vorbereitete Abfrage aus.
        $stmt->execute();
        $stmt->store_result();

        // Wenn es mehr als x-beliebig fehlgeschlagene Versuche gab
        if ($stmt->num_rows > $attemps) {
            return true;
            // Erzeugen des Bestätigungscodes
            $confirmCode = createConfirmCode($mysqli);
            // E-Mail senden
            if($stmt = $mysqli->prepare("SELECT email FROM users WHERE idUsers = ?")) {
                $stmt->bind_param('s', $email);

                // Führe die vorbereitete Abfrage aus
                $stmt->execute();
                $stmt->store_result();

                $stmt->bind_result($email);
                $stmt->fetch();
            }
            sendConfirmationMail($email, $confirmCode);
        } else {
            return false;
        }
    }
}

/**
    Erstellen und senden der Aktivierungsmail

    @author Dennis Kalt
    @param string $email            Eingegebene E-Mail-Adresse
    @param string $confcode         Bestätigungscode
    @return boolean
    @version 1.0
*/
function sendConfirmationMail($email, $confcode) {
    if(strlen($confcode) > 10) {
        return false;
    }
    else if(strlen($confcode) < 10) {
        return false;
    }
    else {
        $to = $email; // Empfänger
        $subject = 'Aktiviere Deinen Account'; // Betreff der E-Mail
        $activationSite = 'http://localhost/php-praktikum/inc/login/activate.php';
        // Eigentlicher E-Mail-Inhalt mit Aktivierungslink
        $message = '

        Dankeschön für Ihr Vertrauen in Bee!
        Dein Nutzer wurde erstellt. Bitte bestätige diesen nun noch mit einem Klick auf den Link.

        ------------------------
        E-Mail-Adresse: '.$email.'
        ------------------------

        Bitte klicke auf diesen Link, um deinen Account zu aktivieren:
        '.$activationSite.'?email='.$email.'&activate='.$confcode.'

        ';

        $headers = 'From: noreply@webdesign-denniskalt.de' . "\r\n"; // Header-Informationen
        mail($to, $subject, $message, $headers); // Versendet die E-Mail
    }
}

/*

*/
function getUser($email, $mysqli) {
        $stmt = $mysqli->prepare("SELECT idUsers, username, email, password, salt, regDate, status.beschreibung, profilepic, forename, surname, birthDate, postcode, usersTypesId, url FROM users INNER JOIN status ON status.idStatus=users.status WHERE email = ? LIMIT 1");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();

        // Holt Variablen vom result
        $stmt->bind_result($usersid, $username, $email, $password, $salt, $regDate, $status, $profilepic, $forename, $surname, $birthDate, $postcode, $usersTypesId, $url);
        $stmt->fetch();
        $rows = $stmt->num_rows;

        return array($usersid, $username, $email, $password, $salt, $regDate, $status, $profilepic, $forename, $surname, $birthDate, $postcode, $usersTypesId, $url);
}

/*

*/
function getConfirmCode($email, $mysqli) {
        $stmt = $mysqli->prepare("SELECT idUsers, confirmcodes.idConfirmcodes FROM users INNER JOIN confirmcodes ON users.idUsers=confirmcodes.usersId WHERE email = ? LIMIT 1");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();

        // Holt Variablen vom result
        $stmt->bind_result($usersid, $confirmcode);
        $stmt->fetch();
        $rows = $stmt->num_rows;

        return array($usersid, $confirmcode);
}

/*

*/
function getUserDesign($email, $mysqli) {
        $stmt = $mysqli->prepare("SELECT bg, design FROM options INNER JOIN users ON users.idUsers=options.usersId WHERE email = ? LIMIT 1");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();

        // Holt Variablen vom result
        $stmt->bind_result($bg, $design);
        $stmt->fetch();
        $rows = $stmt->num_rows;

        return array($bg, $design);
}

/*

*/


/*

*/
function setStatus($email, $status, $mysqli) {
    if($stmt = $mysqli->prepare("SELECT status.idStatus FROM status WHERE status.beschreibung = ? LIMIT 1")) {
        $stmt->bind_param('s', $status);
        $stmt->execute();
        $stmt->store_result();

        // Holt Variablen vom result
        $stmt->bind_result($idstatus);
        $stmt->fetch();
        $rows = $stmt->num_rows;
        if(mysqli_query($mysqli, "UPDATE users SET users.status='$idstatus' WHERE users.email='$email'")) {
            return true;
        }
        else {
            return false;
        }
    }
    else {
        return false;
    }
}

/*

*/
function logLogin($usersid, $mysqli) {
    $logfile = fopen("../../logs/logLogin.txt", "a");
    $eintrag = date("d.m.Y, H:i:s", time()) .
                    ";" . $usersid .
                    ";" . $_SERVER['REMOTE_ADDR'] .
                    ";" . $_SERVER['REQUEST_METHOD'] .
                    ";" . $_SERVER['PHP_SELF'] .
                    ";" . $_SERVER['HTTP_USER_AGENT'] .
                    ";" . $_SERVER['HTTP_REFERER'] .
                    "\r\n";
    fputs($logfile, $eintrag);
    fclose($logfile);
    return true;
}

/**
    Überprüfen des Bestätigungscode

    @author Dennis Kalt
    @return boolean true: nicht vorhanden false: vorhanden
    @version 1.0

    Überprüft, ob der Bestätigungscode in der DB vorhanden ist
*/
function checkConfirmCode($confirmCode, $mysqli) {
    if($stmt = $mysqli->prepare("SELECT usersid FROM confirmCode WHERE idConfirmCode = ? LIMIT 1")) {
        $stmt->bind_param('s', $confirmCode);
        $stmt->execute();
        $stmt->store_result();

        $stmt->bind_result($usersid);
        $stmt->fetch();
    }
    // Es gibt diesen Bestätigungscode bereits
    if($stmt->num_rows == 1) {
        return false;
    }
    // Der Bestätigungscode ist nicht vorhanden
    else {
        return true;
    }
}

/**
    Generieren eines Bestätigungscodes

    @author Dennis Kalt
    @return string $confirmCode  Bestätigungscode
    @version 1.0

    Der Bestätigungscode besteht aus vorher definierten Buchstaben und Zahlen. Hierbei wurden ähnliche Buchstaben und Zahlen entfernt, um Irritationen zu vermeiden.
*/
function generateConfirmCode() {
    $laenge = 12;

    //Mögliche Zeichen für den String
    $zeichen = '23456789';
    $zeichen .= 'abcdefghkmnopqrstuvwxyz';
    $zeichen .= 'ABCDEFGHKMNPQRSTUVWXYZ';

    //String wird generiert
    $confirmCode = '';
    $anzahl = strlen($zeichen);
    for ($i=0; $i<$laenge; $i++) {
        $confirmCode .= $zeichen[rand(0,$anzahl-1)];
    }
    // Generate a 12 character hash
    $confirmCode = md5($confirmCode);
    return $confirmCode;
}

/**
    Erstellen des nutzbaren Bestätigungscodes

    @author Dennis Kalt
    @return string $confirmCode  Bestätigungscode
    @version 1.0

    Der Bestätigungscode besteht aus vorher definierten Buchstaben und Zahlen. Hierbei wurden ähnliche Buchstaben und Zahlen entfernt, um Irritationen zu vermeiden.
*/
function createConfirmCode($mysqli) {
    do {
        $confirmCode = generateConfirmCode();
    } while (checkConfirmCode($confirmCode, $mysqli) == false);

    return $confirmCode;
}

/**
    Funktionen zum Registrieren des Nutzers

    @author Dennis Kalt
    @param  string  $email          Eingegebene E-Mail-Adresse
    @param  string  $passwort       Eingegebenes Passwort
    @param  object  $mysqli         Verbindungseinstellungen
    @return boolean
    @version 1.0

    Ablauf:
    1. Übergabewerte validieren
    2. Prüfung, ob Nutzer bereits vorhanden
    3. Salt generieren
    4. Passwort hashen
    5. Speichern in DB
    6. Bestätigungsmail erstellen und versenden
*/
function signup($email, $password, $vorname, $nachname, $mysqli) {

    /**
        Übergabewerte validieren
    */
    $email = mask($email);
    $password = mask($password);
    $vorname = mask($vorname);
    $nachname = mask($nachname);

    /**
        Prüfung, ob Nutzer bereits vorhanden
    */

    // Prepared Statements zum Verhindern von SQL-Injektionen
    if($stmt = $mysqli->prepare("SELECT idUsers FROM users WHERE email = ? LIMIT 1")) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();

        // Holt Variablen vom result
        $stmt->bind_result($idUsers);
        $stmt->fetch();

        // Bereits vorhandener Nutzer
        if($stmt->num_rows == 1) {
            return false;
        }

        // Fortführung des Registrierungsprozess bei keinem vorhandenen Nutzer
        else if($stmt->num_rows == 0) {
     /**
        Salt generieren
    */
            $salt = generateSalt($email, 7);

            // Options für Hash festlegen
            $options = array(
                'salt' => $salt,
                'cost' => subStr($salt, 4, 7),
            );

    /**
        Passwort hashen
    */
            $password = password_hash($password, PASSWORD_BCRYPT, $options);

            // Erzeugen des Bestätigungscodes
            $confirmCode = createConfirmCode($mysqli);

    /**
        Speichern in DB
    */
            // Definieren des Status
            $status = 'inaktiv';

            // Speichern der Daten in der Datenbank
            mysqli_query($mysqli, "INSERT INTO users(email, password, salt, forename, surname) VALUES ('$email', '$password', '$salt', '$vorname', '$nachname')");
            $result = $mysqli->query("SELECT idUsers FROM users WHERE email='$email'");
            $row = $result->fetch_assoc();
            $idUsers = $row['idUsers'];
            setStatus($email, $status, $mysqli);
            $mysqli->query("INSERT INTO confirmcodes(idConfirmcodes, usersId) VALUES ('$confirmCode', '$idUsers')");
            sendConfirmationMail($email, $confirmCode);
            return true;


        }

        // Irgendwas schief gelaufen
        else {
            return false;
        }
    }
}

/**

*/
function login($email, $password, $mysqli) {
    /**
        Übergabewerte validieren
    */
    $email = mask($email);
    $password = mask($password);

    /**
        Nutzer-Daten aus DB holen
    */

    // Prepared Statements zum Verhindern von SQL-Injektionen
    if($stmt = $mysqli->prepare("SELECT idUsers, username, password, salt, profilepic, status.beschreibung, forename, surname FROM users INNER JOIN status ON status.idStatus=users.status WHERE email = ? LIMIT 1")) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();

        // Holt Variablen vom result
        $stmt->bind_result($usersid, $username, $dbPassword, $salt, $profilepic, $status, $vorname, $nachname);
        $stmt->fetch();

        // Überprüft die Aktivierung des Kontos
        if($status == 'aktiv') {
            // Legt die Options für Hash fest
            $options = array(
                'salt' => $salt,
                'cost' => subStr($salt, 4, 7),
            );

            // Hasht das Passwort mit eindeutigem Salt
            $password = password_hash($password, PASSWORD_BCRYPT, $options);

            if($stmt->num_rows == 1) {
                // Wenn Nutzer vorhanden, Überprüfung ob Konto durch zu viele Login-Versuche blockiert
                if(checkbrute(§usersid, $mysqli) == true) {
                    // Konto blockiert
                    header('Location: ../login.php?error=brute');
                    break;
                }
                else {
                    // Überprüft, ob das Passwort in der Datenbank mit dem vom Benutzer eingegebenen Passwort übereinstimmt
                    if($dbPassword == $password) {
                        // Passwort ist richtig
                        // Holt User-Agent-String des Nutzers
                        $user_browser = $_SERVER['HTTP_USER_AGENT'];

                        // XSS-Schutz
                        $usersid = preg_replace("/[^0-9]+/", "", $usersid);
                        $_SESSION['usersid'] = $usersid;
                        $username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username);
                        $_SESSION['username'] = $username;
                        $_SESSION['login_string'] = hash('sha512', $email . $user_browser);

                        // Login-Log
                        logLogin($usersid, $mysqli);

                        $cookie_name = "$email";
                        $pointpos = strrpos ($email , '.');
                        $substremail = substr ($email , 0, $pointpos);
                        $cookie_name = "$substremail";

                        $usersinfo = array(
                            "email" => $email,
                            "profilepic" => $profilepic,
                            "username" => $username,
                            "vorname" => $vorname,
                            "nachname" => $nachname);

                        $cookie_value = json_encode($usersinfo);
                        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
                        setcookie("user", $email, time() + (86400 * 30), "/");

                        // Login erfolgreich
                        return true;
                    }
                    else {
                        // Passwort ist falsch
                        // Versuch in DB gespeichert
                        $mysqli->query("INSERT INTO login_attempts(usersid, time) VALUES ('$usersid')");
                        return false;
                    }
                }
            }
        }
        else {
            // Account nicht aktiv
            return false;
        }
    }
    else {
        // Kein Benutzer
        return false;
    }
}

/**
    Die "login_string" SESSION-Variable enthält die Browser-Information des Benutzers gehasht mit der E-Mail-Adresse. Die Browser-Informationen werden genutzt, denn es ist sehr unwahrscheinlich dass der Benutzer innerhalb der Sitzung den Browser wechselt.

    @author Dennis Kalt
    @param  string  $usersid        Ermittelte Users-ID
    @param  object  $mysqli         Verbindungseinstellungen
    @return boolean (true = mehr als x-beliebige Anmeldeversuche)
    @version 1.0
*/
function login_check($mysqli) {
    // Überprüfe, ob alle Session-Variablen gesetzt sind
    if (isset($_SESSION['usersid'],
              $_SESSION['username'],
              $_SESSION['login_string']
             )
       ) {

        $usersid = $_SESSION['usersid'];
        $usersid = preg_replace("/[^0-9]+/", "", $usersid);
        $login_string = $_SESSION['login_string'];
        $username = $_SESSION['username'];

        // Hole den user-agent string des Benutzers.
        $user_browser = $_SERVER['HTTP_USER_AGENT'];

        if ($stmt = $mysqli->prepare("SELECT email
                                      FROM users
                                      WHERE users_id = ? LIMIT 1")) {
            // Bind "$usersid" zum Parameter.
            $stmt->bind_param('i', $usersid);
            $stmt->execute();   // Execute the prepared query.
            $stmt->store_result();

            if ($stmt->num_rows == 1) {
                // Wenn es den Benutzer gibt, hole die Variablen von result.
                $stmt->bind_result($email);
                $stmt->fetch();

                $login_check = hash('sha512', $email . $user_browser);

                if ($login_check == $login_string) {
                    // Eingeloggt!!!!
                    return true;
                } else {
                    // Nicht eingeloggt
                    return false;
                }
            } else {
                // Nicht eingeloggt
                return false;
            }
        } else {
            // Nicht eingeloggt
            return false;
        }
    } else {
        // Nicht eingeloggt
        return false;
    }
}

/*
 Aktivierung
*/

function activateAccount($email, $confcode, $mysqli) {
    $email = filterEmail($email);
    if(setStatus($email, 'aktiv', $mysqli)) {
        list ($usersid, $username, $email, $password, $salt, $regDate, $status, $profilepic, $forename, $surname, $birthDate, $postcode, $usersTypesId, $url) = getUser($email, $mysqli);

        if($stmt = $mysqli->prepare("DELETE FROM confirmcodes WHERE confirmcodes.usersId = ? LIMIT 1")) {
            $stmt->bind_param('i', $usersid);
            $stmt->execute();
            $stmt->store_result();

            // Holt Variablen vom result
            $stmt->bind_result($idstatus);
            $stmt->fetch();
            $rows = $stmt->num_rows;

            return true;
        }
        else {
            return false;
        }
    }
    else {
        return false;
    }
}

/**
    Funktionen zum Zurücksetzen des Passworts

    @author Dennis Kalt
    @param  string  $email          Eingegebene E-Mail-Adresse
    @param  object  $mysqli         Verbindungseinstellungen
    @return boolean
    @version 1.0
*/

function pwreset($email, $mysqli) {

    if(list ($usersid, $username, $email, $password, $salt, $regDate, $status, $profilepic, $forename, $surname, $birthDate, $postcode, $usersTypesId, $url) = getUser($email, $mysqli)) {
        // Status inaktiv setzen
        $status = 'inaktiv';
        setStatus($email, $status, $mysqli);
        $confirmCode = createConfirmCode($mysqli);
        $mysqli->query("INSERT INTO confirmcodes(idConfirmcodes, usersId) VALUES ('$confirmCode', '$idUsers')");
        sendConfirmationMail($email, $confirmCode);
        return true;
    }
    else {
        return false;
    }

}



function changePW($email, $password, $mysqli) {

    /**
        Übergabewerte validieren
    */
    $email = mask($email);
    $password = mask($password);

    /**
        Prüfung, ob Nutzer bereits vorhanden
    */

    // Prepared Statements zum Verhindern von SQL-Injektionen
    if($stmt = $mysqli->prepare("SELECT idUsers FROM users WHERE email = ? LIMIT 1")) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();

        // Holt Variablen vom result
        $stmt->bind_result($idUsers);
        $stmt->fetch();

        // Bereits vorhandener Nutzer
        if($stmt->num_rows == 0) {
            return false;
        }

        // Fortführung des Registrierungsprozess bei keinem vorhandenen Nutzer
        else if($stmt->num_rows == 1) {
     /**
        Salt generieren
    */
            $salt = generateSalt($email, 7);

            // Options für Hash festlegen
            $options = array(
                'salt' => $salt,
                'cost' => subStr($salt, 4, 7),
            );

    /**
        Passwort hashen
    */
            $password = password_hash($password, PASSWORD_BCRYPT, $options);

    /**
        Speichern in DB
    */
            // Definieren des Status
            $status = 'aktiv';

            // Speichern der Daten in der Datenbank
            if(mysqli_query($mysqli, "UPDATE users SET users.password='$password', users.salt='$salt' WHERE users.email='$email'")) {
                $result = $mysqli->query("SELECT idUsers FROM users WHERE email='$email'");
                $row = $result->fetch_assoc();
                $idUsers = $row['idUsers'];
                setStatus($email, $status, $mysqli);
                return true;
            }
            else {
                return false;
            }
        }

        // Irgendwas schief gelaufen
        else {
            return false;
        }
    }
}

?>
