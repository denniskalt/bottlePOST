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

/**
Module Name: Login-Modul
Description: Register and login users. Change passwords
Version: 1.0

Use Case #01: The user can register with his email-adress and a password. Then he get an email with a link to activate his account. If it´s successful, he would be redirected to his profile page.

Use Case #02: The user is already registered and want to be logged in. He use his email-adress and the password. If they are correct, he would be redirected to his profile page (in case he hadn´t the required fields) or to the dashboard.

Use Case #03: The user has forgotten his password. He types in his email-adress and get an email with a link to activate his account. Then he will be redirected to a site he can change his password.

Use Case #04: The user tries 3 times to login and has a false password. Then his account is blocked an he get an email with a link to activate his account. Then he will be redirected to a site he can change his password.
*/

/**
    Maskieren von Eingaben

    @author Dennis Kalt
    @param  string  $input          Zu maskierende Eingabe
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
    $zeichen .= './_-#()@§!';

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

    Der Salt besteht aus einem Teil der verwendeten E-Mail-Adresse und einem automatisch generierten Saltpart.
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
function sendConfirmationMail($email, $confcode, $pwreset) {
    if(strlen($confcode) > 10) {
        return false;
    }
    else if(strlen($confcode) < 10) {
        return false;
    }
    else {
        $to = $email; // Empfänger
        $subject = 'Aktiviere Deinen Account'; // Betreff der E-Mail
        if($pwreset!="") {
            $activationSite = 'http://localhost/php-praktikum/inc/login/pwreset.php';
        }
        else {
            $activationSite = 'http://localhost/php-praktikum/inc/login/activate.php';
        }
        // Eigentlicher E-Mail-Inhalt mit Aktivierungslink
        if($pwreset!="") {
            $message = '
            Dankeschön für Dein Vertrauen!
            Dein Nutzer wurde erstellt. Bitte bestätige diesen nun noch mit einem Klick auf den Link.

            ------------------------
            E-Mail-Adresse: '.$email.'
            ------------------------

            Bitte klicke auf diesen Link, um deinen Account zu aktivieren:
            <a href="'.$activationSite.'?email='.$email.'&activate='.$confcode.'&pwreset='.$pwreset.'">'.$activationSite.'?email='.$email.'&activate='.$confcode.'&pwreset='.$pwreset.'</a>';
        }
        else {
            $message = '
            Dankeschön für Dein Vertrauen!
            Dein Nutzer wurde erstellt. Bitte bestätige diesen nun noch mit einem Klick auf den Link.

            ------------------------
            E-Mail-Adresse: '.$email.'
            ------------------------

            Bitte klicke auf diesen Link, um deinen Account zu aktivieren:
            <a href="'.$activationSite.'?email='.$email.'&activate='.$confcode.'">'.$activationSite.'?email='.$email.'&activate='.$confcode.'</a>';
        }

        $headers = 'From: noreply@webdesign-denniskalt.de' . "\r\n"; // Header-Informationen
        mail($to, $subject, $message, $headers); // Versendet die E-Mail
    }
}

/**
    GET-Methode Nutzerdaten

    @author Dennis Kalt
    @param string $email            Eingegebene E-Mail-Adresse
    @return array $usersid
                  $username
                  $email
                  $password
                  $salt
                  $regDate
                  $status
                  $profilepic
                  $forename
                  $surname
                  $birthDate
                  $postcode
                  $userTypesId
                  $url
    @version 1.0
*/
function getUser($email, $mysqli) {
        $stmt = $mysqli->prepare("SELECT idUsers, username, email, password, salt, status.beschreibung, profilepic, forename, surname FROM users INNER JOIN status ON status.idStatus=users.status WHERE email = ? LIMIT 1");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();

        // Holt Variablen vom result
        $stmt->bind_result($usersid, $username, $email, $password, $salt, $status, $profilepic, $forename, $surname);
        $stmt->fetch();
        $rows = $stmt->num_rows;

        return array($usersid, $username, $email, $password, $salt, $status, $profilepic, $forename, $surname);
}

/**
    GET-Methode Bestätigungscode

    @author Dennis Kalt
    @param string $email            Eingegebene E-Mail-Adresse
    @return array $usersid
                  $confirmcode
    @version 1.0
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

/**
    GET-Methode User-Design-Einstellungen

    @author Dennis Kalt
    @param string $email            Eingegebene E-Mail-Adresse
    @return array $bg
                  $design
    @version 1.0
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

        if($bg!="") {
            return array($bg, $design);
        }
        else {
            return false;
        }
}

/**
    UPDATE-Methode Status

    @author Dennis Kalt
    @param string $email            Eingegebene E-Mail-Adresse
           string $status           Beschreibung des Status
    @return boolean
    @version 1.0
*/
function updateStatus($email, $status, $mysqli) {
    if($stmt = $mysqli->prepare("SELECT status.idStatus FROM status WHERE status.beschreibung = ? LIMIT 1")) {
        $stmt->bind_param('s', $status);
        $stmt->execute();
        $stmt->store_result();

        // Holt Variablen vom result
        $stmt->bind_result($idstatus);
        $stmt->fetch();
        $rows = $stmt->num_rows;
        if(mysqli_query($mysqli, "UPDATE users SET users.status='$idstatus' WHERE users.email='$email'")) {
            if($stmt = $mysqli->prepare("SELECT confirmcodes.idConfirmcodes FROM confirmcodes INNER JOIN users ON users.idUsers = confirmcodes.usersId WHERE users.email = ?")) {
                $stmt->bind_param('s', $email);
                $stmt->execute();
                $stmt->store_result();

                // Holt Variablen vom result
                $stmt->bind_result($confirmcode);
                $stmt->fetch();
                $rows = $stmt->num_rows;

                if($stmt = $mysqli->prepare("DELETE FROM confirmcodes WHERE confirmcodes.idConfirmcodes = ?")) {
                    $stmt->bind_param('s', $confirmcode);
                    $stmt->execute();
                    $stmt->close();
                    return true;
                }
            }
        }
    }
}

/**
    Loggen der Login-Daten

    @author Dennis Kalt
    @param string $usersid            Eingegebene E-Mail-Adresse
    @return boolean
    @version 1.0
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
    //$confirmCode = md5($confirmCode);
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
    Funktionen zum Aktivieren des Accounts

    @author Dennis Kalt
    @param  string  $email          Eingegebene E-Mail-Adresse
    @param  string  $confcode       Confirmcode
    @param  object  $mysqli         Verbindungseinstellungen
    @return boolean
*/
function activateAccount($email, $confcode, $mysqli) {
    $email = filterEmail($email);
    if(updateStatus($email, 'aktiv', $mysqli)) {
        list ($usersid, $username, $email, $password, $salt, $status, $profilepic, $forename, $surname) = getUser($email, $mysqli);

        if($stmt = $mysqli->prepare("DELETE FROM confirmcodes WHERE confirmcodes.usersId = ? LIMIT 1")) {
            $stmt->bind_param('i', $usersid);
            $stmt->execute();
            $stmt->close();
            // Holt User-Agent-String des Nutzers
            $user_browser = $_SERVER['HTTP_USER_AGENT'];

            // XSS-Schutz
            $usersid = preg_replace("/[^0-9]+/", "", $usersid);
            $username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username);
            $_SESSION['usersid'] = $usersid;
            $_SESSION['email'] = $email;
            $_SESSION['login_string'] = hash('sha512', $email . $user_browser);

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

/***
    Funktionen zum Zurücksetzen des Passworts

    @author Dennis Kalt
    @param  string  $email          Eingegebene E-Mail-Adresse
    @param  object  $mysqli         Verbindungseinstellungen
    @return boolean
    @version 1.0
*/
function pwreset($email, $mysqli) {

    if(list ($usersid, $username, $email, $password, $salt, $status, $profilepic, $forename, $surname) = getUser($email, $mysqli)) {
        // Status inaktiv setzen
        $status = 'inaktiv';
        updateStatus($email, $status, $mysqli);
        $confirmCode = createConfirmCode($mysqli);
        $pwreset = generateConfirmCode();
        $mysqli->query("INSERT INTO confirmcodes(idConfirmcodes, usersId, pwreset) VALUES ('$confirmCode', '$usersid', '$pwreset')");
        sendConfirmationMail($email, $confirmCode);
        return array($email, $confirmCode, $pwreset);
    }
    else {
        return false;
    }

}

/**
 *
 * Validiert E-Mails
 *
 * @param string $input         Input-String
 * @param string $pattern       Pattern for filter the email adress
 * @return string
 *
 */
function filterEmail($input) {
    $output = filter_var($input, FILTER_SANITIZE_EMAIL);
    $pattern = '/[[A-Z0-9._%+-]+[ ]?[\(]?(@|at)[\)]?[ ]?[A-Z0-9.-]+[ ]?[\(]?(\.|dot)[)]?[ ]?[A-Z]{2,4}/i';
    if(preg_match($pattern, $input)) {
        return $output;
    } else {
        return false;
    }
}

/**
    Funktionen zum Registrieren des Nutzers

    @author Dennis Kalt
    @param  string  $email          Eingegebene E-Mail-Adresse
    @param  string  $password       Eingegebenes Passwort
    @param  string  $user           Eingegebener Benutzername
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
function signup($email, $password, $user, $mysqli) {

    //Übergabewerte validieren
    $email = mask($email);
    $email = filterEmail($email);
    $password = mask($password);
    $user = mask($user);

    /** Prüfung, ob Nutzer bereits vorhanden */

    // Prepared Statements zum Verhindern von SQL-Injektionen
    if($stmt = $mysqli->prepare("SELECT idUsers FROM users WHERE email = ? ")) {
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

            if($stmt = $mysqli->prepare("SELECT idUsers FROM users WHERE username = ? LIMIT 1")) {
                $stmt->bind_param('s', $user);
                $stmt->execute();
                $stmt->store_result();

                // Holt Variablen vom result
                $stmt->bind_result($idUsers);
                $stmt->fetch();
                if($stmt->num_rows == 0) {
            // Salt generieren
            $salt = generateSalt($email, 7);

            // Options für Hash festlegen
            $options = array(
                'salt' => $salt,
                'cost' => subStr($salt, 4, 7),
            );

            // PW hashen
            $password = password_hash($password, PASSWORD_BCRYPT, $options);

            // Erzeugen des Bestätigungscodes
            $confirmCode = createConfirmCode($mysqli);

            /** Speichern in DB */
            // Definieren des Status
            $status = 'inaktiv';

            // Speichern der Daten in der Datenbank
            mysqli_query($mysqli, "INSERT INTO users(citiesId, email, password, salt, username, profilepic) VALUES ('2911271', '$email', '$password', '$salt', '$user', 'user/default.jpg')");
            $result = $mysqli->query("SELECT idUsers FROM users WHERE email='$email'");
            $row = $result->fetch_assoc();
            $idUsers = $row['idUsers'];
            updateStatus($email, $status, $mysqli);
            $mysqli->query("INSERT INTO confirmcodes(idConfirmcodes, usersId) VALUES ('$confirmCode', '$idUsers')");
            sendConfirmationMail($email, $confirmCode);

            // Holt User-Agent-String des Nutzers
                        $user_browser = $_SERVER['HTTP_USER_AGENT'];

                        // XSS-Schutz
                        $usersid = preg_replace("/[^0-9]+/", "", $idUsers);
                        $username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $user);
                        $_SESSION['usersid'] = $usersid;
                        $_SESSION['login_string'] = hash('sha512', $email . $user_browser);
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
        // Irgendwas schief gelaufen
        else {
            return false;
        }
    }
}

/**
    Funktionen zum Einloggen des Nutzers

    @author Dennis Kalt
    @param  string  $email          Eingegebene E-Mail-Adresse
    @param  string  $password       Eingegebenes Passwort
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
                    header('Location: ERROR');
                }
                else {
                    // Überprüft, ob das Passwort in der Datenbank mit dem vom Benutzer eingegebenen Passwort übereinstimmt
                    if($dbPassword == $password) {
                        // Passwort ist richtig
                        // Holt User-Agent-String des Nutzers
                        $user_browser = $_SERVER['HTTP_USER_AGENT'];

                        // XSS-Schutz
                        $usersid = preg_replace("/[^0-9]+/", "", $usersid);
                        $username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username);
                        $_SESSION['usersid'] = $usersid;
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
                updateStatus($email, $status, $mysqli);

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
