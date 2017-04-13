<?php
include_once('login/config.php');
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
              $_SESSION['email'],
              $_SESSION['login_string']
             )
       ) {

        $usersid = $_SESSION['usersid'];
        $usersid = preg_replace("/[^0-9]+/", "", $usersid);
        $login_string = $_SESSION['login_string'];
        $email = $_SESSION['email'];

        // Hole den user-agent string des Benutzers.
        $user_browser = $_SERVER['HTTP_USER_AGENT'];

        if ($stmt = $mysqli->prepare("SELECT email
                                      FROM users
                                      WHERE idUsers = ? LIMIT 1")) {
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
