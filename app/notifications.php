<?php
if(isset($_POST["view"])) {
    include("config.php");
    if($_POST["view"] != '') {
        $update_query = "UPDATE notifications SET status=1 WHERE status=0";
        mysqli_query($mysqli, $update_query);
    }
    $query = "SELECT * FROM notifications ORDER BY idNotifications DESC LIMIT 5";
    $result = mysqli_query($mysqli, $query);
    $output = '<li class="heading">Benachrichtigungen</li>';

    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_array($result)) {
            $output .= '
                <li>
                    <div class="notification-wrapper">
                        <a class="content" href="#">
                            <div class="notification-image">
                                <img src="images/user/default-0.jpg" />
                            </div>
                            <div class="notification-item">
                                <h4 class="item-title">Dennis Kalt hat deinen Post kommentiert.</h4>
                                <p class="item-subtitle">'.$row["message"].'</p>
                                <p class="item-info">vor 4 Stunden</p>
                            </div>
                            <div class="notification-topic">
                                <i class="fa fa-commenting-o"></i>
                            </div>
                            <div class="clear"></div>
                        </a>
                    </div>
                </li>';
        }
    }
    else {
        $output .= '<li><a href="#" class="text-bold text-italic">No Notification Found</a></li>';
    }

    $query_1 = "SELECT * FROM notifications WHERE status=0";
    $result_1 = mysqli_query($mysqli, $query_1);
    $count = mysqli_num_rows($result_1);
    $data = array(
        'notification'   => $output,
        'unseen_notification' => $count
    );
    echo json_encode($data);
}
?>
