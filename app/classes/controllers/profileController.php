<?php

  session_start();

  // UsersId abrufen
  $usersId = $_SESSION['usersid'];
  $id = $_GET['id'];

  if($usersId != $id) {
      $state = DAOFactory::getUsersDAO()->getUserById($id);
      if(empty($state)) {
          header("Location: index.php?vew=error&id=9");
      }
  }

  /**
   * User-Widget
   */

  $user = DAOFactory::getUsersDAO()->getUserById($usersId);
  $view->assign('profil', $user[0]->profilepic);
  $view->assign('username', $user[0]->username);
  $view->assign('email', $user[0]->email);
  $view->assign('erstelltam', $user[0]->regDate);
  $view->assign('vorname', $user[0]->forename);
  $view->assign('nachname', $user[0]->surname);
  $view->assign('name', $user[0]->forename . $user[0]->surname);
  $view->assign('lastlogin', $user[0]->regDate);
  $view->assign('geburtstag', $user[0]->birthDate);
  $view->assign('motto', $user[0]->motto);
  $view->assign('imageIndex', $user[0]->imageType);

  /**
   * Profil-Widget
   */

  $user = DAOFactory::getUsersDAO()->getUserById($id);
  $view->assign('foreignprofil', $user[0]->profilepic);
  $view->assign('foreignusername', $user[0]->username);
  $view->assign('foreignemail', $user[0]->email);
  $view->assign('foreignerstelltam', $user[0]->regDate);
  $view->assign('foreignvorname', $user[0]->forename);
  $view->assign('foreignnachname', $user[0]->surname);
  $view->assign('foreignname', $user[0]->forename .' '. $user[0]->surname);
  $view->assign('foreignlastlogin', $user[0]->regDate);
  $view->assign('foreigngeburtstag', $user[0]->birthDate);
  $view->assign('foreignimageIndex', $user[0]->imageType);

  $friends = DAOFactory::getFollowersDAO()->getFriendshipByUsers($usersId, $id);
  $view->assign('foreignfriendship', $friends);

  /**
   * Contact-Widget
   */

  $contacts = DAOFactory::getUsersDAO()->getUsers();
  $view->assign('contacts', $contacts);

  /**
   * Follower-Widget
   */

  $followers = DAOFactory::getFollowersDAO()->getIdByUser($id);
  $view->assign('followers', count($followers));

  /**
   * Postings-Widget
   */

  $postings = DAOFactory::getPostsDAO()->getMyPosts($id);
  $view->assign('postings', count($postings));


  /**
   * Like-Widget
   */

  $likes = DAOFactory::getVotesDAO()->getVotesByUser($id);
  $view->assign('likes', count($likes));

  /**
   * Comment-Widget
   */

  $comments = DAOFactory::getCommentsDAO()->getCommentsByUsersId($id);
  $view->assign('comments', count($comments));

  /**
   * User-Update
   */

  if(isset($_GET['edit'])) {
      $newUser = $user;
      $newUser[0]->username = $_POST['benutzername'];
      $newUser[0]->forename = $_POST['vorname'];
      $newUser[0]->surname = $_POST['nachname'];
      $newUser[0]->birthDate = $_POST['geburtsdatum'];
      $newUser[0]->email = $_POST['email'];
      $newUser[0]->motto = $_POST['motto'];
      $updateUser = DAOFactory::getUsersDAO()->update($newUser[0]);
      header("Location: index.php?view=profile&id=". $_SESSION['usersid']);
  }

  /**
   * Upload-Widget
   */

  $upload = DAOFactory::getUploadsDAO()->getUploadsByUser($id);
  $upload = array_slice($upload, 0, 4);
  for($i = 0; $i < count($upload); $i++) {
      $uploads[$i]['id'] = $upload[$i]->id;
      $uploads[$i]['userid'] = $upload[$i]->userid;
      $uploads[$i]['title'] = $upload[$i]->title;
      $uploads[$i]['src'] = $upload[$i]->src;
  }

  if(isset($uploads)) {
    $view->assign('uploads', $uploads);
  }

    /**
     * Image-Widget
     */

    if(isset($_POST['title'])) {

        $titel = $_POST['title'];
        $target_dir = "images/uploads";
        $target_file = basename($_FILES["url"]["name"]);
        $imageURL = $target_dir . $target_file;
        $ext=pathinfo($imageURL,PATHINFO_EXTENSION);

        if(file_exists($imageURL)) {
            $imageURL = $imageURL.rand(1,500).".".$ext;
        }

        if(move_uploaded_file($_FILES['url']['tmp_name'], $imageURL) == false) {
            echo "Upload failed!";
        }

        $upload = new Uploads();
        $upload->userid = $usersId;
        $upload->title = $titel;
        $upload->src = $imageURL;

        $uploadID = DAOFactory::getUploadsDAO()->setUpload($upload);

        header("Refresh:0");

    }

    if(isset($_POST['deleteIMG']) && isset($_POST['imgID'])) {
        $deleteID = DAOFactory::getUploadsDAO()->deleteUploadById($_POST['imgID']);
        header("Refresh:0");
    }

    if(isset($_POST['submit_profilimage']) && isset($_POST['optradio'])) {

        $imageURL = "inc/upload/" . basename($_FILES["url"]["name"]);
        $type = $_POST['optradio'];
        $imageType = 0;

        if($type == "Standardbild 3") {

            $target_dir = "images/user/";
            $target_file = addslashes($target_dir . basename($_FILES["url"]["name"]));
            $uploadOk = 1;
             $check = getimagesize($_FILES["url"]["tmp_name"]);
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            move_uploaded_file($_FILES['url']['tmp_name'], $target_file);
            $imageType = 2;
            if($check !== false) {
                $uploadOk = 1;
            } else {
                $uploadOk = 0;
            }

        } else if($type == "Standardbild 2") {
            $imageType = 1;
            $imageURL = "images/user/profile-placeholder_female.jpg";
        } else if($type == "Standardbild 1") {
            $imageType = 0;
            $imageURL = "images/user/profile-placeholder.jpg";
        }

        $profilupdate = DAOFactory::getUsersDAO()->updateProfilepic($imageURL, $usersId);
        $imageupdater = DAOFactory::getUsersDAO()->updateImageType($imageType, $usersId);
        header("Refresh: 0");

    }

    /**
     * Follow-Widget
     */

        if(isset($_GET['follow'])) {

        $neuerFollower = new Followers();
        $neuerFollower->leaderID = $_GET['follow'];
        $neuerFollower->followerID = $_SESSION['usersid'];
        $neuerFollower->confirmed = 1;

        $follow = DAOFactory::getFollowersDAO()->insertFollower($neuerFollower);

        /** Notification -> Follow **/

        $note = new Notification();
        $note->type = 3;
        $note->usersId = $_SESSION['usersid'];
        $note->commentsId = 0;
        $note->statusId = 0;
        $note->postsId = 0;
        $note->recieverId = $_GET['follow'];
        $notify = DAOFactory::getNotificationDAO()->setNotification($note);

        }

        if(isset($_GET['disfollow'])) {
            $followID = DAOFactory::getFollowersDAO()->getFriendshipByUsers($usersId, $id);
            $disfollow = DAOFactory::getFollowersDAO()->deleteFollowerById($followID[0]->id);
            header("Location: index.php?view=profile&id=" . $_GET['id']);
        }

    /**
	 * Post-Widget
	 */

    if(isset($_GET['liked'])) {
        $voting = new Votes();
        $voting->usersid = $_GET['id'];
        $voting->postsid = $_GET['liked'];
        $voting->vote = '1';
        if($vote = DAOFactory::getVotesDAO()->getVotesByPost($_GET['liked'])) {
            $voteIT = DAOFactory::getVotesDAO()->update($voting);
        } else {
            $voteIT = DAOFactory::getVotesDAO()->insertVote($voting);
        }

        /** Notification -> Like **/

        $note = new Notification();
        $note->type = 2;
        $note->usersId = $_SESSION['usersid'];
        $note->commentsId = 0;
        $note->statusId = 0;
        $note->postsId = $_GET['liked'];
        $note->recieverId = $_GET['id'];
        $notify = DAOFactory::getNotificationDAO()->setNotification($note);

    }

    if(isset($_GET['disliked'])) {
        $voting = new Votes();
        $voting = new Votes();
        $voting->usersid = $_GET['id'];
        $voting->postsid = $_GET['disliked'];
        $voting->vote = '-1';
        if($vote = DAOFactory::getVotesDAO()->getVotesByPost($_GET['disliked'])) {
            $voteIT = DAOFactory::getVotesDAO()->update($voting);
        } else {
            $voteIT = DAOFactory::getVotesDAO()->insertVote($voting);
        }
    }

    if(isset($_GET['del'])) {
        $delPost = DAOFactory::getPostsDAO()->deletePostById($_GET['del']);
        $delHashPost = DAOFactory::getHashtagsPostsDAO()->deleteHashtagsByPostID($_GET['del']);
    }

    if(isset($_POST['submit_post'])) {

        $content = $_POST['posting'];
        $id = $_POST['usersid'];
        $posting = new Posts();
        $posting->usersid = $id;
        $posting->content = $content;
        $postid = DAOFactory::getPostsDAO()->setPost($posting);

        // Hashtags filtern
        $hashtags = DAOFactory::getHashtagsDAO()->findHashtags($content, $str = 0);

        // Hashtags aus Post auslesen
        for($k=0; $k<count($hashtags); $k++) {
            $counter=0;
            $res = DAOFactory::getHashtagsDAO()->getHashtags();
            //print_r($hashtags[$k]);
            //print_r($res[$k]->description);
            // Alle Hashtags der DB durchlaufen
            for($l=0; $l<count($res); $l++) {
                if($hashtags[$k]===$res[$l]->description) {
                    //$hashpost = new HashtagsPosts();
                    //$hashpost->id = $hashtags[$k];
                    //$res = DAOFactory::getHashtagsDAO()->setHashtag($hash);
                    //echo "<h2>Gefunden:</h2>";
                    // id für Hashtag-ID
                    // echo "<h2>".$res[$l]->description."</h2>";
                    $hashtagsid = $res[$l]->id;
                    // Speichern von Beziehung
                    $counter--;
                }
                else {

                }
            }
            if($counter!=0) {
                // Speichern Beziehung
                $hashpost = new HashtagsPosts();
                $hashpost->hashtagsid = $hashtagsid;
                $hashpost->postsid = $postid;
                DAOFactory::getHashtagsPostsDAO()->setHashtagPosts($hashpost);
            }
            else {
                $hash = new Hashtags();
                $hash->description = $hashtags[$k];
                $hashtagid = DAOFactory::getHashtagsDAO()->setHashtag($hash);
                $hashpost = new HashtagsPosts();
                $hashpost->hashtagsid = $hashtagid;
                $hashpost->postsid = $postid;
                DAOFactory::getHashtagsPostsDAO()->setHashtagPosts($hashpost);
            }
        }

    }

    // Posts
    $res = DAOFactory::getPostsDAO()->getMyPosts($id);
    $res = array_slice($res, 0, 5);
    for($i=0; $i<count($res); $i++) {
        $post[$i]['postid'] = $res[$i]->id;
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

    if(isset($post)) {
        $view->assign('posts', $post);
    }
    // User
    $res = DAOFactory::getUsersDAO()->getUserById($usersId);
    $view->assign('users', $res);

?>
