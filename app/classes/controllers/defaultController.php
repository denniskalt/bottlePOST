<?php
    $res = DAOFactory::getUsersDAO()->getUsers();
    $view->setTemplate('default');
    $view->assign('users', $res);
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


    $weather_url = 'http://samples.openweathermap.org/data/2.5/weather?q=Hameln&appid=b1b15e88fa797225412429c1c50c122a1';
    $weather_json = file_get_contents($weather_url);
    $weather_array = json_decode($weather_json, true);
    $temp = $weather_array['main']['temp'];
    $temp = kelvin_to_celsius($temp);
    $view->assign('site_title', $temp);
?>
