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
    $usedFunction = '$2a';

    //0 vor Rundenanzahl bei Zahlen kleiner 10
    if($rounds<10) {
        $rounds='$0'.$rounds;
    }
    else {
        $rounds='$'.$rounds;
    }

    //Individueller Salt
    $emailPart = subStr($email, 0, 3);
    $time = time();
    $time = subStr($time, 0, 5);
    $randomSalt = randomString(20);

    $salt = subStr($usedFunction.$rounds.$emailPart.$time.$randomSalt, 0, 22);

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

/*

*/
function getUser($email, $mysqli) {
        $stmt = $mysqli->prepare("SELECT idUsers, username, password, salt, regDate, profilepic, status FROM users WHERE email = ? LIMIT 1");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();

        // Holt Variablen vom result
        $stmt->bind_result($usersid, $username, $dbPassword, $salt, $regDate, $profilepic, $status);
        $stmt->fetch();
        $rows = $stmt->num_rows;

        return array($idUsers, $username, $email, $password, $salt, $regDate, $profilepic, $status, $rows);
}

/*

*/
function setStatus($usersid, $statusCode, $mysqli) {
    if(mysqli_query($mysqli, "UPDATE users, confirmcode SET users.status='2' WHERE users.email='$email' AND confirmcode.idConfirmCode='$confirmCode' AND users.status='1'")) {
        return true;
    }
    else {
        return false;
    }
}

/*

*/
function logLogin($usersid, $mysqli) {
    $logfile = fopen("../logs/logLogin.txt", "a");
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
function signup($email, $password, $mysqli) {

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


    /**
        Speichern in DB
    */
            // Definieren des Status
            $status = 1;

            // Speichern der Daten in der Datenbank
            mysqli_query($mysqli, "INSERT INTO users(email, password, salt, status) VALUES ('$email', '$password', '$salt', '$status')");
            $result = $mysqli->query("SELECT idUsers FROM users WHERE email='$email'");
            $row = $result->fetch_assoc();
            $idUsers = $row['idUsers'];

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
    if($stmt = $mysqli->prepare("SELECT idUsers, username, password, salt, profilepic, status FROM users WHERE email = ? LIMIT 1")) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();

        // Holt Variablen vom result
        $stmt->bind_result($usersid, $username, $dbPassword, $salt, $profilepic, $status);
        $stmt->fetch();

        // Überprüft die Aktivierung des Kontos
        if($status == 2) {
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
                        $time = time();
                        $mysqli->query("INSERT INTO log_login(id_users, time) VALUES ('$usersid', '$time')");
                        logLogin($usersid, $mysqli);

                        // Login erfolgreich
                        return true;
                    }
                    else {
                        // Passwort ist falsch
                        // Versuch in DB gespeichert
                        $time = time();
                        $mysqli->query("INSERT INTO login_attempts(id_users, time) VALUES ('$usersid', '$time')");
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
?>
