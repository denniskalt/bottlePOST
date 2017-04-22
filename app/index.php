<?php
require_once('classes/models/include_dao.php');

    if(isset($_GET['view'])) {
        $view = $_GET['view'];
        require 'classes/controllers/'.$view.'.php';
        $controller = new $view;
    }
    else {
        $user = new Users();
        $res = DAOFactory::getUsersDAO()->getAll();
        print_r($res);
    }
?>
