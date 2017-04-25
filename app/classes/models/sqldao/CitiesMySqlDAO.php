<?php
include_once('config.php');

    /**
     * Class that operate on table 'cities'
     *
     * @author  Dennis Kalt
     * @date    2017-04-22
     */

    class CitiesMySqlDAO  {

        /**
         * Get all cities
         * @return Cities
         */
        public function getCities() {
            $sql = 'SELECT * FROM cities';
		    $sqlQuery = new SqlQuery($sql);
		    return $this->getList($sqlQuery);
        }

        /**
         * Get City by primary key
         * @param String $id primary key
         * @return Cities
         */
        public function getCityById($id) {
            $sql = 'SELECT * FROM cities WHERE idCities = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($id);
            return $this->getList($sqlQuery);
        }

        /**
         * Get City by name
         * @param $city name of city
         * @return Cities with idCities
         */
        public function getIdByName($city) {
            $sql = 'SELECT idCities FROM cities WHERE city = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($city);
            return $this->getList($sqlQuery);
        }

        /**
         * Get name of the city
         * @param $id primary key
         * @return Cities with city name
         */
        public function getCityName($id) {
            $sql = 'SELECT city FROM cities WHERE idCities = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($id);
            return $this->getList($sqlQuery);
        }

        /**
         * Get coordinates from city
         * @param $id primary key
         * @return Cities with lat and lon
         */
        public function getLatLon($id) {
            $sql = 'SELECT lat, lon FROM cities WHERE idCities = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($id);
            return $this->getList($sqlQuery);
        }

        /**
         * Get country code
         * @param $id primary key
         * @return Cities with country code (ISO 3166)
         */
        public function getCountryCode($id) {
            $sql = 'SELECT countryCode FROM cities WHERE idCities = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($id);
            return $this->getList($sqlQuery);
        }

        /**
         * Read row
         *
         * @return CitiesMySql
         */
        protected function readRow($row){
            $city = new Cities();

            if(isset($row['idCities'])) { $city->id = $row['idCities']; }
            if(isset($row['city'])) { $city->name = $row['city']; }
            if(isset($row['lat'])) { $city->lat = $row['lat']; }
            if(isset($row['lon'])) { $city->lon = $row['lon']; }
            if(isset($row['countryCode'])) { $city->countryCode = $row['countryCode']; }

            return $city;
        }

        protected function getList($sqlQuery){
            $tab = QueryExecutor::execute($sqlQuery);
            $ret = array();
            for($i=0;$i<count($tab);$i++){
                $ret[$i] = $this->readRow($tab[$i]);
            }
            return $ret;
        }

        /**
         * Get row
         *
         * @return citysMySql
         */
        protected function getRow($sqlQuery){
            $tab = QueryExecutor::execute($sqlQuery);
            if(count($tab)==0){
                return null;
            }
            return $this->readRow($tab[0]);
        }

        /**
         * Execute sql query
         */
        protected function execute($sqlQuery){
            return QueryExecutor::execute($sqlQuery);
        }


        /**
         * Execute sql query
         */
        protected function executeUpdate($sqlQuery){
            return QueryExecutor::executeUpdate($sqlQuery);
        }

        /**
         * Query for one row and one column
         */
        protected function querySingleResult($sqlQuery){
            return QueryExecutor::queryForString($sqlQuery);
        }

        /**
         * Insert row to table
         */
        protected function executeInsert($sqlQuery){
            return QueryExecutor::executeInsert($sqlQuery);
        }

    }

?>
