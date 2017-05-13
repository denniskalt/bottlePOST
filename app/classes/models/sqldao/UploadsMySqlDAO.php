<?php

include_once('config.php');

    /**
     * Class that operate on table 'uploads'
     *
     * @author  Lukas Bosse
     * @date    2017-05-05
     */

    class UploadsMySqlDAO  {

        public function setUpload($upload) {
            $sql = 'INSERT INTO uploads (userID, title, src) VALUES (?,?,?)';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($upload->userid);
            $sqlQuery->set($upload->title);
            $sqlQuery->set($upload->src);
            return $this->executeInsert($sqlQuery);
        }

        /**
         * Get all status
         * @return Status
         */
        public function getUploadsByUser($id) {
            $sql = 'SELECT * FROM uploads WHERE userID = ?';
		    $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($id);
		    return $this->getList($sqlQuery);
        }

        /**
         * Get status by primary key
         * @param String $id primary key
         * @return Status
         */
        public function getUploadsById($id) {
            $sql = 'SELECT * FROM uploads WHERE ID = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($id);
            return $this->getList($sqlQuery);
        }

        /**
         * Get status by description
         * @param String $description description
         * @return Status
         */
        public function deleteUploadById($title) {
            $sql = 'DELETE FROM uploads WHERE title = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($title);
            return $this->executeUpdate($sqlQuery);
        }

          protected function getList($sqlQuery){
            $tab = QueryExecutor::execute($sqlQuery);
            $ret = array();
            for($i=0;$i<count($tab);$i++){
                $ret[$i] = $this->readRow($tab[$i]);
            }
            return $ret;
        }

          protected function readRow($row){

            $upload = new Uploads();

            if(isset($row['ID'])) { $upload->id = $row['ID']; }
            if(isset($row['userID'])) { $upload->userid = $row['userID']; }
            if(isset($row['title'])) { $upload->title = $row['title']; }
            if(isset($row['src'])) { $upload->src = $row['src']; }

            return $upload;
        }

           /**
         * Get row
         *
         * @return UsersMySql
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
