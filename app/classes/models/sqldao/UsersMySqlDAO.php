<?php
include_once('config.php');

    class UsersMySqlDAO implements UsersDAO {

        public function getAll() {
            // Gibt eine Instanz der Directory Klasse an $dirHandle zurück
            $dirHandle = dir("../app");
            $stack = array();
            // Verzeichnis Datei für Datei lesen
            while (($f = $dirHandle->read()) != false) {

                array_push($stack, $f);
            }

            return $stack;
        }

    }

?>
