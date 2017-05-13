<?php

  session_start();

  // UsersId abrufen
  $usersId = $_SESSION['usersid'];
  $id = $_GET['id'];


    switch($id) {
        case 1:
            $view->assign('meldung', 'Fehler 1');
            break;
        case 2:
            $view->assign('meldung', 'Fehler 2');
            break;
        case 3:
            $view->assign('meldung', 'Fehler 3');
            break;
        case 4:
            $view->assign('meldung', 'Fehler 4');
            break;
        case 5:
            $view->assign('meldung', 'Fehler 5');
            break;
        case 6:
            $view->assign('meldung', 'Fehler 6');
            break;
        case 7:
            $view->assign('meldung', 'Fehler 7');
            break;
        case 8:
            $view->assign('meldung', 'Fehler 8');
            break;
        case 9:
            $view->assign('meldung', 'Fehler 9');
            break;
    }

?>
