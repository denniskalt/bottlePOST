<?php
    session_start();
    // UsersId abrufen
    $usersId = $_SESSION['usersid'];
    // Template setzen, Nutzerdaten erhalten
    $view->setTemplate('default');
    $view->assign('site_title', 'NEWSFEED');


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

    /**
	 * Methode zum Konvertieren der Temperatur von Kelvin zu Celsius.
	 *
     * @param $temp int Temperatur in Kelvin
	 * @return String Inhalt der Applikation.
	 */
    function kelvin_to_celsius($temp) {
        if (!is_numeric($temp)) {
            return false;
        }
        else {
            return round(($temp - 273.15));
        }
    }

    /**
	 * Methode zum Herausfinden von Wavetags
	 *
     * @param $txt string Eingabe-Text
	 * @return
	 */
    function findWavetags($txt) {
        preg_match_all('/~(\\w+)/', $txt);
    }

  /**
   * Follower-Widget
   */

  $followers = DAOFactory::getFollowersDAO()->getIdByUser($usersId);
  $view->assign('followers', count($followers));

  $leaders = DAOFactory::getFollowersDAO()->getLeadersByUser($usersId);
  $view->assign('leaders', count($leaders));

    /**
   * Contact-Widget
   */

  $contacts = DAOFactory::getUsersDAO()->getUsers();
  $view->assign('contacts', $contacts);

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

    /**
	 * Wetter-Widget
	 */

    // Ort herausbekommen
    $res = DAOFactory::getUsersDAO()->getUserById($usersId);
    $idCities = DAOFactory::getUsersDAO()->getCity($usersId);
    $idCities = $idCities[0]->city;
    $view->assign('idCities', $idCities);
    $res = DAOFactory::getCitiesDAO()->getCityName($idCities);
    $view->assign('user', $res);

    // Wetter per API abrufen und entsprechend formatieren
    // Sample auf API ändern

    $appid = '721d32d59d8826ee442431c9d08d9039';
    $weather_url = 'http://api.openweathermap.org/data/2.5/weather?id='.$idCities.'&APPID='.$appid;
    $weather_json = file_get_contents($weather_url);
    $weather_array = json_decode($weather_json, true);
    // Temperatur
    $temp = $weather_array['main']['temp'];
    $temp = kelvin_to_celsius($temp);
    $view->assign('temperature', $temp);
    // Abrufzeit
    $datacalc = $weather_array['dt'];
    $datacalc = date('H:i',$datacalc);
    $view->assign('datacalc', $datacalc);
    // Windgeschwindigkeit
    $wind = $weather_array['wind']['speed'];
    $wind = round($wind);
    $view->assign('wind', $wind);
    // Wetter-Group (Thunderstorm, Drizzle, Rain, Snow, Atmosphere, Clear, Clouds, Extreme)
    $weather_icon = $weather_array['weather'][0]['icon'];
    switch($weather_icon) {
        // Day - clear sky
        case '01d':
            $view->assign('weather', 'wi-day-sunny');
            break;
        // Day - few clouds
        case '02d':
            $view->assign('weather', 'wi-day-cloudy');
            break;
        // Day - scattered clouds
        case '03d':
            $view->assign('weather', 'wi-day-cloudy-high');
            break;
        // Day - broken clouds
        case '04d':
            $view->assign('weather', 'wi-day-cloudy');
            break;
        // Day - shower rain
        case '09d':
            $view->assign('weather', 'wi-day-rain');
            break;
        // Day - rain
        case '10d':
            $view->assign('weather', 'wi-day-sleet');
            break;
        // Day - thunderstorm
        case '11d':
            $view->assign('weather', 'wi-day-sleet-storm');
            break;
        // Day - snow
        case '13d':
            $view->assign('weather', 'wi-day-snow');
            break;
        // Day - mist
        case '50d':
            $view->assign('weather', 'wi-day-fog');
            break;
        // Night - clear sky
        case '01n':
            $view->assign('weather', 'wi-night-clear');
            break;
        // Night - few clouds
        case '02n':
            $view->assign('weather', 'wi-night-alt-cloudy');
            break;
        // Night - scattered clouds
        case '03n':
            $view->assign('weather', 'wi-night-cloudy');
            break;
        // Night - broken clouds
        case '04n':
            $view->assign('weather', 'wi-night-alt-cloudy');
            break;
        // Night - shower rain
        case '09n':
            $view->assign('weather', 'wi-night-rain');
            break;
        // Night - rain
        case '10n':
            $view->assign('weather', 'wi-night-alt-rain-mix');
            break;
        // Night - thunderstorm
        case '11n':
            $view->assign('weather', 'wi-night-alt-sleet-storm');
            break;
        // Night - snow
        case '13n':
            $view->assign('weather', 'wi-night-snow');
            break;
        // Night - mist
        case '50n':
            $view->assign('weather', 'wi-night-fog');
            break;
    }

    // Tageszeit auswählen
    $time = time();
    $time = date("G", $time);
    switch(TRUE) {
        case ($time <= 12 AND $time >= 5):
            $view->assign('tageszeit', "Morgens");
            break;
        case ($time <= 17 AND $time > 12):
            $view->assign('tageszeit', "Mittags");
            break;
        case ($time <= 20 AND $time > 17):
            $view->assign('tageszeit', "Abends");
            break;
        case ($time <= 24 AND $time > 20 OR $time >= 0 AND $time < 5):
            $view->assign('tageszeit', "Nachts");
            break;
    }

    /**
	 * Post-Widget
	 */

    // Delete Post

    if(isset($_GET['del'])) {
        $delPost = DAOFactory::getPostsDAO()->deletePostById($_GET['del']);
        $delHashPost = DAOFactory::getHashtagsPostsDAO()->deleteHashtagsByPostID($_GET['del']);
    }

    // Posts
    $res = DAOFactory::getPostsDAO()->getMyLeadersPosts($usersId);
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


        if(isset($_GET['edit'])) {
          $newUser = $user;
          $newUser[0]->username = $_POST['benutzername'];
          $newUser[0]->forename = $_POST['vorname'];
          $newUser[0]->surname = $_POST['nachname'];
          $newUser[0]->birthDate = $_POST['geburtsdatum'];
          $newUser[0]->email = $_POST['email'];
          $newUser[0]->motto = $_POST['motto'];
          $updateUser = DAOFactory::getUsersDAO()->update($newUser[0]);
          header("Location: index.php?view=profile&id=".$updateUser);
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
    $view->assign('posts', $post);

    // User
    $res = DAOFactory::getUsersDAO()->getUserById($usersId);
    $view->assign('users', $res);


?>
