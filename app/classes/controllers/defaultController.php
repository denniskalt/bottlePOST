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
    $weather_url = 'http://samples.openweathermap.org/data/2.5/weather?id='.$idCities.'&APPID='.$appid;
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

?>
