<?php
    session_start();
    // UsersId abrufen
    $usersId = $_SESSION['usersid'];
    $wavetagid = $_GET['id'];

    // Template setzen, Nutzerdaten erhalten
    $view->setTemplate('default');
    $view->assign('site_title', '~Wavetag');

    /**
     * Wavetag-Anzeige
     */
    $res = DAOFactory::getHashtagsDAO()->getHashtagById($wavetagid);
    $view->assign('wavetag', $res[0]->description);

    /**
	 * Post-Widget
	 */

    // Posts
    $res = DAOFactory::getHashtagsPostsDAO()->getPostsByHashtag($wavetagid);
    for($i=0; $i<count($res); $i++) {
        $postsid = $res[$i]->postsid;
        $posts = DAOFactory::getPostsDAO()->getPostById($postsid);
        $posts = array_slice($posts, 0, 5);
        for($j=0; $j<count($posts); $j++) {
            $post[$i]['postsid'] = $res[$i]->postsid;
            $post[$i]['usersid'] = $posts[$j]->usersid;
            $post[$i]['date'] = $posts[$j]->date;
            $post[$i]['content'] = $posts[$j]->content;
            $time = $post[$i]['date'];
            $time = strtotime($time);
            $now = time();
            $diff = ($now-$time);
            switch(TRUE) {
                // bis 1 Minute
                case ($diff < 60):
                    $diff = round($diff,0);
                    $output = 'vor '.$diff.' Sekunden';
                    $post[$i]['date'] = $output;
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
                    $post[$i]['date'] = $output;
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
                    $post[$i]['date'] = $output;
                    break;
                // über 24 Stunden
                case ($diff >86400):
                    $time = date("d.m.Y", $time);
                    $output = 'am '.$time.'';
                    $post[$i]['date'] = $output;
                    break;
            }
            // User-Daten
            $user = DAOFactory::getUsersDAO()->getUserById($posts[$j]->usersid);
            $post[$i]['forename'] = $user[0]->forename;
            $post[$i]['surname'] = $user[0]->surname;
            $post[$i]['profilepic'] = $user[0]->profilepic;

            // Hashtags
            $hashtags = DAOFactory::getHashtagsDAO()->getHashtagByPostsId($res[$i]->postsid);
            for($k=0; $k<count($hashtags); $k++) {
                $post[$i]['hashtags'][$k]['description'] = $hashtags[$k]->description;
                $post[$i]['hashtags'][$k]['hashtagid'] = $hashtags[$k]->id;
            }

            // Votes
            $votes = DAOFactory::getVotesDAO()->getVoteByPostUser($usersId, $res[$i]->postsid);
            if(empty($votes)) {

            }
            else {
                $post[$i]['votes'] = $votes[0]->vote;
            }
        }
    }





        /*for($j=0; $j<count($posts); $j++) {
            $post[$j]['postid'] = $posts[$j]->id;
            $post[$j]['usersid'] = $posts[$j]->usersid;
            $post[$j]['date'] = $posts[$j]->date;
            $post[$j]['content'] = $posts[$j]->content;
            $time = $post[$j]['date'];
            $time = strtotime($time);
            $now = time();
            $diff = ($now-$time);
            switch(TRUE) {
                // bis 1 Minute
                case ($diff < 60):
                    $diff = round($diff,0);
                    $output = 'vor '.$diff.' Sekunden';
                    $post[$j]['date'] = $output;
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
                    $post[$j]['date'] = $output;
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
                    $post[$j]['date'] = $output;
                    break;
                // über 24 Stunden
                case ($diff >86400):
                    $time = date("d.m.Y", $time);
                    $output = 'am '.$time.'';
                    $post[$j]['date'] = $output;
                    break;
            }
            // User-Daten
            $user = DAOFactory::getUsersDAO()->getUserById($posts[$i]->usersid);
            $post[$j]['forename'] = $user[0]->forename;
            $post[$j]['surname'] = $user[0]->surname;
            $post[$j]['profilepic'] = $user[0]->profilepic;

            // Hashtags
            $hashtags = DAOFactory::getHashtagsDAO()->getHashtagByPostsId($postsid);
            print_r($hashtags);
            for($k=0; $k<count($hashtags); $k++) {
                $post[$j]['hashtags'][$k]['description'] = $hashtags[$k]->description;
                $post[$j]['hashtags'][$k]['hashtagid'] = $hashtags[$k]->id;

            }

            // Votes
            $votes = DAOFactory::getVotesDAO()->getVoteByPostUser($usersId, $res[$j]->id);
            if(empty($votes)) {

            }
            else {
                $post[$i]['votes'] = $votes[0]->vote;
            }
        }*/




       /* $post[$i]['postid'] = $res[$i]->id;
        $post[$i]['usersid'] = $res[$i]->usersid;
        $post[$i]['date'] = $res[$i]->date;
        $post[$i]['content'] = $res[$i]->content;
        // Datum-Anzeige
        $time = $post[$i]['date'];
        $time = strtotime($time);
        $now = time();
        $diff = ($now-$time);
        switch(TRUE) {
            // bis 1 Minute
            case ($diff < 60):
                $diff = round($diff,0);
                $output = 'vor '.$diff.' Sekunden';
                $post[$i]['date'] = $output;
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
                $post[$i]['date'] = $output;
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
                $post[$i]['date'] = $output;
                break;
            // über 24 Stunden
            case ($diff >86400):
                $time = date("d.m.Y", $time);
                $output = 'am '.$time.'';
                $post[$i]['date'] = $output;
                break;
        }


        // User-Daten
        $user = DAOFactory::getUsersDAO()->getUserById($res[$i]->usersid);
        $post[$i]['forename'] = $user[0]->forename;
        $post[$i]['surname'] = $user[0]->surname;
        $post[$i]['profilepic'] = $user[0]->profilepic;

        // Hashtags
        $hashtags = DAOFactory::getHashtagsDAO()->getHashtagByPostsId($res[$i]->id);
        for($j=0; $j<count($hashtags); $j++) {
            $post[$i]['hashtags'][$j]['description'] = $hashtags[$j]->description;
            $post[$i]['hashtags'][$j]['hashtagid'] = $hashtags[$j]->id;
        }

        // Votes
        $votes = DAOFactory::getVotesDAO()->getVoteByPostUser($usersId, $res[$i]->id);
        if(empty($votes)) {

        }
        else {
            $post[$i]['votes'] = $votes[0]->vote;
        }
        }
    }*/
    $view->assign('posts', $post);

    // User
    $res = DAOFactory::getUsersDAO()->getUserById($usersId);
    $view->assign('users', $res);


?>
