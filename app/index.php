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

    /*if(isset($_GET['view'])) {
        $view = $_GET['view'];
        require 'classes/controllers/'.$view.'.php';
        $controller = new $view;
    }
    else {

        echo '<h1>Users</h1>';

        $id = 4;
        $email = 'test@test.de';
        $username = 'tester';

        echo '<h3>getUsers()</h3>';
        $user = new Users();
        $res = DAOFactory::getUsersDAO()->getUsers();
        print_r($res);

        echo '<h3>getUserById($id)</h3>';
        $user = new Users();
        $res = DAOFactory::getUsersDAO()->getUserById($id);
        print_r($res);

        echo '<h3>getIdByEmail($email)</h3>';
        $user = new Users();
        $res = DAOFactory::getUsersDAO()->getIdByEmail($email);
        print_r($res);

        echo '<h3>getIdByUsername($username)</h3>';
        $user = new Users();
        $res = DAOFactory::getUsersDAO()->getIdByUsername($username);
        print_r($res);

        echo '<h3>getUsername($id)</h3>';
        $user = new Users();
        $res = DAOFactory::getUsersDAO()->getUsername($id);
        print_r($res);

        echo '<h3>getEmail($id)</h3>';
        $user = new Users();
        $res = DAOFactory::getUsersDAO()->getEmail($id);
        print_r($res);

        echo '<h3>getRegDate($id)</h3>';
        $user = new Users();
        $res = DAOFactory::getUsersDAO()->getRegDate($id);
        print_r($res);

        echo '<h3>getStatus($id)</h3>';
        $user = new Users();
        $res = DAOFactory::getUsersDAO()->getStatus($id);
        print_r($res);

        echo '<h3>getProfilepic($id)</h3>';
        $user = new Users();
        $res = DAOFactory::getUsersDAO()->getProfilepic($id);
        print_r($res);

        echo '<h3>getTitle($id)</h3>';
        $user = new Users();
        $res = DAOFactory::getUsersDAO()->getTitle($id);
        print_r($res);

        echo '<h3>getForename($id)</h3>';
        $user = new Users();
        $res = DAOFactory::getUsersDAO()->getForename($id);
        print_r($res);

        echo '<h3>getSurname($id)</h3>';
        $user = new Users();
        $res = DAOFactory::getUsersDAO()->getSurname($id);
        print_r($res);

        echo '<h3>getBirthdate($id)</h3>';
        $user = new Users();
        $res = DAOFactory::getUsersDAO()->getBirthdate($id);
        print_r($res);

        echo '<h3>getPostcode($id)</h3>';
        $user = new Users();
        $res = DAOFactory::getUsersDAO()->getPostcode($id);
        print_r($res);

        echo '<h3>getUsersType($id)</h3>';
        $user = new Users();
        $res = DAOFactory::getUsersDAO()->getUsersType($id);
        print_r($res);

        echo '<h3>getLastLogin($id)</h3>';
        $user = new Users();
        $res = DAOFactory::getUsersDAO()->getLastLogin($id);
        print_r($res);

        echo '<h3>update($user)</h3>';
        $user = new Users();
        $user->username = $username;
        $user->email = $email;
        $user->idUsers = $id;
        $res = DAOFactory::getUsersDAO()->update($user);
        echo "Affected Rows: ";
        print_r($res);*/

        /*echo '<h3>deleteUserById($id)</h3>';
        $user = new Users();
        $res = DAOFactory::getUsersDAO()->deleteUserById($id);
        echo "Affected Rows: ";
        print_r($res);*/

        /*echo '<h3>deleteUserByEmail($email)</h3>';
        $user = new Users();
        $res = DAOFactory::getUsersDAO()->deleteUserByEmail($email);
        echo "Affected Rows: ";
        print_r($res);*/

        /*echo '<h3>deleteUserByStatus($status)</h3>';
        $user = new Users();
        $res = DAOFactory::getUsersDAO()->deleteUserByStatus($status);
        echo "Affected Rows: ";
        print_r($res);*/

        /*echo '<h3>deleteUserByUserType($userType)</h3>';
        $user = new Users();
        $res = DAOFactory::getUsersDAO()->deleteUserByUserType($userType);
        echo "Affected Rows: ";
        print_r($res);*/

        /*echo '<h3>deleteUserByLastLogin($lastLogin)</h3>';
        $user = new Users();
        $res = DAOFactory::getUsersDAO()->deleteUserByLastLogin($lastLogin);
        echo "Affected Rows: ";
        print_r($res);*/

        /*echo '<h3>deleteUsers()</h3>';
        $user = new Users();
        $res = DAOFactory::getUsersDAO()->deleteUsers();
        echo "Affected Rows: ";
        print_r($res);*/

        /*echo '<h1>Status</h1>';

        $id = 1;
        $description = 'inaktiv';

        echo '<h3>getStatus()</h3>';
        $status = new Status();
        $res = DAOFactory::getStatusDAO()->getStatus();
        print_r($res);

        echo '<h3>getStatusById($id)</h3>';
        $status = new Status();
        $res = DAOFactory::getStatusDAO()->getStatusById($id);
        print_r($res);

        echo '<h3>getStatusByDescription($description)</h3>';
        $status = new Status();
        $res = DAOFactory::getStatusDAO()->getStatusByDescription($description);
        print_r($res);

        echo '<h3>update($status)</h3>';
        $status = new Status();
        $status->id = $id;
        $status->description = $description;
        $res = DAOFactory::getStatusDAO()->update($status);
        echo "Affected Rows: ";
        print_r($res);*/

        /*echo '<h3>deleteStatusById($id)</h3>';
        $status = new Status();
        $res = DAOFactory::getStatusDAO()->deleteStatusById($id);
        echo "Affected Rows: ";
        print_r($res);*/

        /*echo '<h3>deleteStatusByDescription($description)</h3>';
        $status = new Status();
        $res = DAOFactory::getStatusDAO()->deleteStatusByDescription($description);
        echo "Affected Rows: ";
        print_r($res);*/

        /*echo '<h3>deleteStatus()</h3>';
        $status = new Status();
        $res = DAOFactory::getStatusDAO()->deleteStatus();
        echo "Affected Rows: ";
        print_r($res);*/

    //}
?>
