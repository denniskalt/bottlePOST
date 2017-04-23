<?php
require_once('classes/models/include_dao.php');

    if(isset($_GET['view'])) {
        $view = $_GET['view'];
        require 'classes/controllers/'.$view.'.php';
        $controller = new $view;
    }
    else {
        /*$user = new Users();
        $user->username = "tester";
        $user->email = "test@test.de";
        $user->idUsers = 4;
        $res = DAOFactory::getUsersDAO()->update($user);
        echo "Affected Rows: <br/>";
        print_r($res);*/
        $res = DAOFactory::getUsersDAO()->deleteUserByEmail('klassen@test.de');
        print_r($res);
    }
?>
