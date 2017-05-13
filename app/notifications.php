<?php
session_start();
if(isset($_POST["view"])) {
    include("config.php");
    if($_POST["view"] != '') {
        $update_query = "UPDATE notifications SET status=1 WHERE status=0 AND recieverID = '". $_SESSION['usersid']."'";
        mysqli_query($mysqli, $update_query);
    }
    /*$query = "SELECT * FROM notifications ORDER BY idNotifications DESC LIMIT 5";*/
    $query = "SELECT users.username as username, users.title as title, users.forename as vorname, users.surname as nachname, users.profilepic as pp, notifications.time as time, notificationtypes.description as type, notifications.commentsId as commentsid FROM notifications INNER JOIN users ON notifications.usersId=users.idUsers INNER JOIN notificationtypes ON notificationtypes.idNotificationtypes=notifications.notificationtypesId WHERE notifications.recieverID = '". $_SESSION['usersid']."' ORDER BY notifications.time DESC LIMIT 5;";
    $result = mysqli_query($mysqli, $query);
    $output = '<li class="heading">Benachrichtigungen</li>';

    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_array($result)) {
            switch($row["type"]) {
                case "Post kommentiert":
                    $commentsid = $row["commentsid"];
                    $stmt = $mysqli->prepare("SELECT comments.comment as comment FROM comments WHERE idComments = ? LIMIT 1");
                    $stmt->bind_param('i', $commentsid);
                    $stmt->execute();
                    $stmt->store_result();
                    $stmt->bind_result($comment);
                    $stmt->fetch();
                    $output .=
                        '<li>
                            <div class="notification-wrapper">
                                <a class="content" href="#">
                                    <div class="notification-image">
                                        <img src="'.$row["pp"].'" />
                                    </div>
                                    <div class="notification-item">
                                        <h4 class="item-title">';
                                            if(($row["vorname"]!="") && ($row["nachname"]!="")) {
                                                $output .= $row["vorname"].' '.$row["nachname"];
                                            }
                                            else {
                                                $output .= $row["username"];
                                            }
                                        $output .=' hat deinen Post kommentiert.</h4>';
                                        $maxlength = 23;
                                        if(strlen($comment)>$maxlength) {
                                            $output .='<p class="item-subtitle">"'.substr($comment,0,$maxlength).'..."</p>';
                                        }
                                        else {
                                            $output .='<p class="item-subtitle">"'.substr($comment,0,$maxlength).'"</p>';
                                        }
                                                $time = strtotime($row["time"]);
                                                $now = time();
                                                $diff = ($now-$time);

                                                switch(TRUE) {
                                                    // bis 1 Minute
                                                    case ($diff < 60):
                                                        $diff = round($diff,0);
                                                        $output .= '<p class="item-info">vor '.$diff.' Sekunden</p>';
                                                        break;
                                                    // bis 1 Stunde
                                                    case ($diff >= 60 AND $diff <3600):
                                                        $diff = round(($diff/60),0);
                                                        if($diff>1) {
                                                            $output .= '<p class="item-info">vor '.$diff.' Minuten</p>';
                                                        }
                                                        else {
                                                            $output .= '<p class="item-info">vor '.$diff.' Minute</p>';
                                                        }
                                                        break;
                                                    // bis 24 Stunden
                                                    case ($diff >= 3600 AND $diff <86400):
                                                        $diff = round(($diff/3600),0);
                                                        if($diff>1) {
                                                            $output .= '<p class="item-info">vor '.$diff.' Stunden</p>';
                                                        }
                                                        else {
                                                            $output .= '<p class="item-info">vor '.$diff.' Stunde</p>';
                                                        }
                                                        break;
                                                    // über 24 Stunden
                                                    case ($diff >86400):
                                                        $time = date("d.m.Y", $time);
                                                        $output .= '<p class="item-info">am '.$time.'</p>';
                                                        break;
                                                }
                                        $output .='
                                    </div>
                                    <div class="notification-topic">
                                        <i class="fa fa-commenting-o"></i>
                                    </div>
                                    <div class="clear"></div>
                                </a>
                            </div>
                        </li>';
                    break;

                case "Post geliked":
                    $output .=
                        '<li>
                            <div class="notification-wrapper">
                                <a class="content" href="#">
                                    <div class="notification-image">
                                        <img src="'.$row["pp"].'" />
                                    </div>
                                    <div class="notification-item">
                                        <h4 class="item-title">';
                                            if(($row["vorname"]!="") && ($row["nachname"]!="")) {
                                                $output .= $row["vorname"].' '.$row["nachname"];
                                            }
                                            else {
                                                $output .= $row["username"];
                                            }
                                        $output .=' mag deinen Post.</h4>';
                                                $time = strtotime($row["time"]);
                                                $now = time();
                                                $diff = ($now-$time);

                                                switch(TRUE) {
                                                    // bis 1 Minute
                                                    case ($diff < 60):
                                                        $diff = round($diff,0);
                                                        $output .= '<p class="item-info">vor '.$diff.' Sekunden</p>';
                                                        break;
                                                    // bis 1 Stunde
                                                    case ($diff >= 60 AND $diff <3600):
                                                        $diff = round(($diff/60),0);
                                                        if($diff>1) {
                                                            $output .= '<p class="item-info">vor '.$diff.' Minuten</p>';
                                                        }
                                                        else {
                                                            $output .= '<p class="item-info">vor '.$diff.' Minute</p>';
                                                        }
                                                        break;
                                                    // bis 24 Stunden
                                                    case ($diff >= 3600 AND $diff <86400):
                                                        $diff = round(($diff/3600),0);
                                                        if($diff>1) {
                                                            $output .= '<p class="item-info">vor '.$diff.' Stunden</p>';
                                                        }
                                                        else {
                                                            $output .= '<p class="item-info">vor '.$diff.' Stunde</p>';
                                                        }
                                                        break;
                                                    // über 24 Stunden
                                                    case ($diff >86400):
                                                        $time = date("d.m.Y", $time);
                                                        $output .= '<p class="item-info">am '.$time.'</p>';
                                                        break;
                                                }
                                        $output .='
                                    </div>
                                    <div class="notification-topic">
                                        <i class="fa fa-heart-o"></i>
                                    </div>
                                    <div class="clear"></div>
                                </a>
                            </div>
                        </li>';
                    break;

                case "Neuer Follower":
                    $output .=
                        '<li>
                            <div class="notification-wrapper">
                                <a class="content" href="#">
                                    <div class="notification-image">
                                        <img src="'.$row["pp"].'" />
                                    </div>
                                    <div class="notification-item">
                                        <h4 class="item-title">';
                                            if(($row["vorname"]!="") && ($row["nachname"]!="")) {
                                                $output .= $row["vorname"].' '.$row["nachname"];
                                            }
                                            else {
                                                $output .= $row["username"];
                                            }
                                            if($row["title"]=="Herr"){
                                                $output .=' folgt Dir nun. Schaue Dir sein Profil an.</h4>';
                                            }
                                            else if($row["title"]=="Frau") {
                                                $output .=' folgt Dir nun. Schaue Dir ihr Profil an.</h4>';
                                            }
                                            else {
                                                $output .=' folgt Dir nun. Schaue Dir das Profil an.</h4>';
                                            }
                                                $time = strtotime($row["time"]);
                                                $now = time();
                                                $diff = ($now-$time);

                                                switch(TRUE) {
                                                    // bis 1 Minute
                                                    case ($diff < 60):
                                                        $diff = round($diff,0);
                                                        $output .= '<p class="item-info">vor '.$diff.' Sekunden</p>';
                                                        break;
                                                    // bis 1 Stunde
                                                    case ($diff >= 60 AND $diff <3600):
                                                        $diff = round(($diff/60),0);
                                                        if($diff>1) {
                                                            $output .= '<p class="item-info">vor '.$diff.' Minuten</p>';
                                                        }
                                                        else {
                                                            $output .= '<p class="item-info">vor '.$diff.' Minute</p>';
                                                        }
                                                        break;
                                                    // bis 24 Stunden
                                                    case ($diff >= 3600 AND $diff <86400):
                                                        $diff = round(($diff/3600),0);
                                                        if($diff>1) {
                                                            $output .= '<p class="item-info">vor '.$diff.' Stunden</p>';
                                                        }
                                                        else {
                                                            $output .= '<p class="item-info">vor '.$diff.' Stunde</p>';
                                                        }
                                                        break;
                                                    // über 24 Stunden
                                                    case ($diff >86400):
                                                        $time = date("d.m.Y", $time);
                                                        $output .= '<p class="item-info">am '.$time.'</p>';
                                                        break;
                                                }
                                        $output .='
                                    </div>
                                    <div class="notification-topic">
                                        <i class="fa fa-user-o"></i>
                                    </div>
                                    <div class="clear"></div>
                                </a>
                            </div>
                        </li>';
                    break;
                default:
                    $output .=
                        '<li>
                            <div class="notification-wrapper">
                                <a class="content" href="#">
                                    <div class="notification-image">
                                        <img src="" />
                                    </div>
                                    <div class="notification-item">
                                        <h4 class="item-title">Ein Problem ist aufgetreten.</h4>
                                    </div>
                                    <div class="notification-topic">
                                        <i class="fa fa-flash"></i>
                                    </div>
                                    <div class="clear"></div>
                                </a>
                            </div>
                        </li>';
                    break;
            }
        }
    }
    else {
        $output .=
                        '<li>
                            <div class="notification-wrapper">
                                <a class="content" href="#">
                                    <div class="notification-image">
                                        <img src="" />
                                    </div>
                                    <div class="notification-item">
                                        <h4 class="item-title">Ein Problem ist aufgetreten.</h4>
                                    </div>
                                    <div class="notification-topic">
                                        <i class="fa fa-flash"></i>
                                    </div>
                                    <div class="clear"></div>
                                </a>
                            </div>
                        </li>';
    }

    $query_1 = "SELECT * FROM notifications WHERE status=0 AND recieverID = '". $_SESSION['usersid']."'";
    $result_1 = mysqli_query($mysqli, $query_1);
    $count = mysqli_num_rows($result_1);
    $data = array(
        'notification'   => $output,
        'unseen_notification' => $count
    );
    echo json_encode($data);
}
?>
