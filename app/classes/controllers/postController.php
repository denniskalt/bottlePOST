<?php
    session_start();
    // UsersId abrufen
    $usersId = $_SESSION['usersid'];
    $postsid = $_GET['id'];

    // Template setzen, Nutzerdaten erhalten
    $view->setTemplate('default');
    $view->assign('site_title', 'Post '.$postsid);

    if(isset($_POST['submit_comment'])) {
            $comments = new Comments();
            $comments->usersid = $usersId;
            $comments->postsid = $postsid;
            $comments->comment = $_POST['comment_cont'];
            $commentid = DAOFactory::getCommentsDAO()->setComment($comments);

            $post = DAOFactory::getPostsDAO()->getPostById($postsid)[0]->usersid;

          /** Notification -> Like **/

        $note = new Notification();
        $note->type = 1;
        $note->usersId = $_SESSION['usersid'];
        $note->commentsId = $commentid;
        $note->statusId = 0;
        $note->postsId = $postsid;
        $note->recieverId = $post;
        $notify = DAOFactory::getNotificationDAO()->setNotification($note);

    }

    /**
     * Post-Inhalte
     */
    $res = DAOFactory::getPostsDAO()->getPostById($postsid);
    $post = array();
    $post['id']=$res[0]->id;
    $post['content']=$res[0]->content;
    //Datum
    $time = $res[0]->date;
    $time = strtotime($time);
    $now = time();
    $diff = ($now-$time);
    switch(TRUE) {
        // bis 1 Minute
        case ($diff < 60):
            $diff = round($diff,0);
            $output = 'vor '.$diff.' Sekunden';
            $post['date'] = $output;
            break;
        // bis 1 Stunde
        case ($diff >= 60 AND $diff <3600):
            $diff = round(($diff/60),0);
            if($diff>1) {
                $output = 'vor '.$diff.' Minuten';
            }
            else {
                $output = 'vor '.$diff.' Minute';
            }
            $post['date'] = $output;
            break;
        // bis 24 Stunden
        case ($diff >= 3600 AND $diff <86400):
            $diff = round(($diff/3600),0);
            if($diff>1) {
                $output = 'vor '.$diff.' Stunden';
            }
            else {
                $output = 'vor '.$diff.' Stunde';
            }
            $output =
            $post['date'] = $output;
            break;
        // über 24 Stunden
        case ($diff >86400):
            $time = date("d.m.Y", $time);
            $output = 'am '.$time.'';
            $post['date'] = $output;
            break;
    }

    // User-Daten
    $user = DAOFactory::getUsersDAO()->getUserById($res[0]->usersid);
    $post['forename'] = $user[0]->forename;
    $post['surname'] = $user[0]->surname;
    $post['profilepic'] = $user[0]->profilepic;
    $post['usersid']=$res[0]->usersid;

    // Hashtags
    $hashtags = DAOFactory::getHashtagsDAO()->getHashtagByPostsId($res[0]->id);
    for($j=0; $j<count($hashtags); $j++) {
        $post['hashtags'][$j]['description'] = $hashtags[$j]->description;
        $post['hashtags'][$j]['hashtagid'] = $hashtags[$j]->id;
    }

    // Votes
    $votes = DAOFactory::getVotesDAO()->getVoteByPostUser($usersId, $postsid);
    if(empty($votes)) {

    }
    else {
        $post['votes'] = $votes[0]->vote;
    }

    // Kommentare
    $comments = DAOFactory::getCommentsDAO()->getCommentsByPostsId($postsid);

    for($k=0; $k<count($comments); $k++) {
        // User-Daten
        $commentuser = DAOFactory::getUsersDAO()->getUserById($comments[$k]->usersid);
        $post['comments'][$k]['user']['forename'] = $commentuser[0]->forename;
        $post['comments'][$k]['user']['surname'] = $commentuser[0]->surname;
        $post['comments'][$k]['user']['profilepic'] = $commentuser[0]->profilepic;
        $post['comments'][$k]['user']['id'] = $comments[$k]->usersid;

        $post['comments'][$k]['comment'] = $comments[$k]->comment;

        //Datum
        $time = $comments[$k]->time;
        $time = strtotime($time);
        $now = time();
        $diff = ($now-$time);
        switch(TRUE) {
            // bis 1 Minute
            case ($diff < 60):
                $diff = round($diff,0);
                $output = 'vor '.$diff.' Sekunden';
                $post['comments'][$k]['comment_time'] = $output;
                break;
            // bis 1 Stunde
            case ($diff >= 60 AND $diff <3600):
                $diff = round(($diff/60),0);
                if($diff>1) {
                    $output = 'vor '.$diff.' Minuten';
                }
                else {
                    $output = 'vor '.$diff.' Minute';
                }
                $post['comments'][$k]['comment_time'] = $output;
                break;
            // bis 24 Stunden
            case ($diff >= 3600 AND $diff <86400):
                $diff = round(($diff/3600),0);
                if($diff>1) {
                    $output = 'vor '.$diff.' Stunden';
                }
                else {
                    $output = 'vor '.$diff.' Stunde';
                }
                $post['comments'][$k]['comment_time'] = $output;
                break;
            // über 24 Stunden
            case ($diff >86400):
                $time = date("d.m.Y", $time);
                $output = 'am '.$time.'';
                $post['comments'][$k]['comment_time'] = $output;
                break;
        }

    }



    //$view->assign('posts', $comments);

    $view->assign('posts', $post);

    // User
    $res = DAOFactory::getUsersDAO()->getUserById($usersId);
    $view->assign('users', $res);



?>
