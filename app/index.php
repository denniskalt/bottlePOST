<?php
require_once('classes/models/include_dao.php');

// Klassen einbinden
include('classes/controllers/controller.php');
include('classes/models/include_dao.php');
include('classes/views/view.php');

// $_GET und $_POST zusammenfasen, $_COOKIE interessiert uns nicht.
$request = array_merge($_GET, $_POST);
// Controller erstellen
$controller = new Controller($request);
// Inhalt der Webanwendung ausgeben.
echo $controller->display();

?>
