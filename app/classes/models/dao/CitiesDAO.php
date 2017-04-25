<?php

    /** Interface DAO 'cities'
     *
     * @author  Dennis Kalt
     * @date    2017-04-24
     *
     */
    interface CitiesDAO {

        /**
         * Get all cities
         * @return Cities
         */
        public function getCities();

        /**
         * Get City by primary key
         * @param String $id primary key
         * @return Cities
         */
        public function getCityById($id);

        /**
         * Get City by name
         * @param $city name of city
         * @return Cities with idCities
         */
        public function getIdByName($city);

        /**
         * Get name of the city
         * @param $id primary key
         * @return Cities with city name
         */
        public function getCityName($id);

        /**
         * Get coordinates from city
         * @param $id primary key
         * @return Cities with lat and lon
         */
        public function getLatLon($id);

        /**
         * Get country code
         * @param $id primary key
         * @return Cities with country code (ISO 3166)
         */
        public function getCountryCode($id);

    }

?>
