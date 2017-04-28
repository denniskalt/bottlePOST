<?php
    session_start();
    // UsersId abrufen
    $usersId = $_SESSION['usersid'];
    // Template setzen, Nutzerdaten erhalten
    $view->setTemplate('default');
    $view->assign('site_title', 'NEWSFEED');

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

    // Posts
    $res = DAOFactory::getPostsDAO()->getPosts();
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

    }
    $view->assign('posts', $post);

    // User
    $res = DAOFactory::getUsersDAO()->getUserById($usersId);
    $view->assign('users', $res);


?>
