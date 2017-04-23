<?php
include_once('config.php');

    /**
     * Class that operate on table 'status'
     *
     * @author  Dennis Kalt
     * @date    2017-04-23
     */

    class StatusMySqlDAO  {

        /**
         * Get all status
         * @return Status
         */
        public function getStatus() {
            $sql = 'SELECT * FROM status';
		    $sqlQuery = new SqlQuery($sql);
		    return $this->getList($sqlQuery);
        }

        /**
         * Get status by primary key
         * @param String $id primary key
         * @return Status
         */
        public function getStatusById($id) {
            $sql = 'SELECT * FROM status WHERE idStatus = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($id);
            return $this->getList($sqlQuery);
        }

        /**
         * Get status by description
         * @param String $description description
         * @return Status
         */
        public function getStatusByDescription($description) {
            $sql = 'SELECT * FROM status WHERE beschreibung = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($description);
            return $this->getList($sqlQuery);
        }

        /**
         * Update record in table 'status'
         * @param StatusMySql status
         * @return affected rows
         */
        public function update($status) {
            $sql = 'UPDATE status SET beschreibung = ? WHERE idStatus = ?';
            $sqlQuery = new SqlQuery($sql);

            $sqlQuery->set($status->description);

            $sqlQuery->setNumber($status->id);
            return $this->executeUpdate($sqlQuery);
        }

        /**
         * Delete status from table
         * @param $id primary key
         * @return affected rows
         */
        public function deleteStatusById($id) {
            $sql = 'DELETE FROM status WHERE idStatus = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->setNumber($id);
            return $this->executeUpdate($sqlQuery);
        }

        /**
         * Delete status from table
         * @param $description description
         * @return affected rows
         */
        public function deleteStatusByDescription($description) {
            $sql = 'DELETE FROM status WHERE beschreibung = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($description);
            return $this->executeUpdate($sqlQuery);
        }

        /**
         * Delete all rows
         */
        public function deleteStatus() {
            $sql = 'DELETE FROM status';
            $sqlQuery = new SqlQuery($sql);
            return $this->executeUpdate($sqlQuery);
        }

        /**
         * Read row
         *
         * @return StatusMySql
         */
        protected function readRow($row){
            $status = new Status();

            if(isset($row['idStatus'])) { $status->id = $row['idStatus']; }
            if(isset($row['beschreibung'])) { $status->description = $row['beschreibung']; }

            return $status;
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
         * @return StatusMySql
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
