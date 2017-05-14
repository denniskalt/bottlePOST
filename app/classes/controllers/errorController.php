<?php

  session_start();

  // UsersId abrufen
  $usersId = $_SESSION['usersid'];
  $id = $_GET['id'];


    switch($id) {
        case 1:
            $view->assign('meldung', 'Leider wurde die Flaschenpost nicht angespült.');
            break;
        case 2:
            $view->assign('meldung', 'Das war nicht der richtige Schlüssel für die Schatztruhe.');
            break;
        case 3:
            $view->assign('meldung', 'Beim Erstellen der Schatzkarte ist ein Fehler unterlaufen.');
            break;
        case 4:
            $view->assign('meldung', 'Der Rettungsring hat sein Ziel verfehlt.');
            break;
        case 5:
            $view->assign('meldung', 'Wir haben dich beim Kapern unseres Schiffes erwischt.');
            break;
        case 6:
            $view->assign('meldung', 'Wir haben dich beim Kapern unseres Schiffes erwischt.');
            break;
        case 7:
            $view->assign('meldung', 'Du hast zu oft versucht an Deck zu kommen.');
            break;
        case 8:
            $view->assign('meldung', 'Der Schiffs-Papagei hat das neue Wort leider nicht gelernt.');
            break;
        case 9:
            $view->assign('meldung', 'Das Gewässer existiert auf der Landkarte nicht.');
            break;
    }

?>
