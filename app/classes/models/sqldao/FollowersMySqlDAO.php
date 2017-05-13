<?php
include_once('config.php');

    /**
     * Class that operate on table 'followers'
     *
     * @author  Lukas Bosse
     * @date    2017-05-10
     */

    class FollowersMySqlDAO  {

         /**
        * Insert Follower
        * @param $follower Follower-Object
        * @return affected rows
        */

       public function insertFollower($follower) {
            $sql = 'INSERT INTO followers (leaderID, followerID, confirmed) VALUES (?, ?, 0)';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($follower->leaderID);
            $sqlQuery->set($follower->followerID);
            return $this->executeInsert($sqlQuery);
       }

       /**
        * Get all followers
        * @return followers
        */

       public function getFollowers() {
           $sql = 'SELECT * FROM followers ORDER BY ID DESC';
		   $sqlQuery = new SqlQuery($sql);
		   return $this->getList($sqlQuery);
       }

       /**
        * Get Follower by id
        * @param $id primary key
        * @return follower with primary key
        */

       public function getFollowersById($id) {
            $sql = 'SELECT * FROM followers WHERE ID = ? ORDER BY ID DESC';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($id);
            return $this->getList($sqlQuery);
       }

        /**
         * Get id of record by primary key
         * @param $usersid ID from table 'users'
         * @return follower with primary key
         */

       public function getIdByUser($usersid) {
           $sql = 'SELECT * FROM followers WHERE leaderID = ?';
           $sqlQuery = new SqlQuery($sql);
           $sqlQuery->set($usersid);
           return $this->getList($sqlQuery);
       }

        /**
         * Get id of record by primary key
         * @param $usersid ID from table 'users'
         * @return follower with primary key
         */

       public function getLeadersByUser($usersid) {
           $sql = 'SELECT * FROM followers WHERE FollowerID = ?';
           $sqlQuery = new SqlQuery($sql);
           $sqlQuery->set($usersid);
           return $this->getList($sqlQuery);
       }


       public function getFriendshipByUsers($usersid, $id) {
           $sql = 'SELECT * FROM followers WHERE followerID = ? AND leaderID = ?';
           $sqlQuery = new SqlQuery($sql);
           $sqlQuery->set($usersid);
           $sqlQuery->set($id);
           return $this->getList($sqlQuery);
       }

        /**
         * Update record in table 'followers'
         * @param FollowersMySql follower
         * @return affected rows
         */

       public function update($follower) {
            $sql = 'UPDATE followers SET confirmed = ?, leaderID = ?, followerID = ? WHERE ID = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($follower->confirmed);
            $sqlQuery->set($follower->leaderID);
            $sqlQuery->set($follower->followerID);
            $sqlQuery->set($follower->id);
            return $this->executeUpdate($sqlQuery);
       }

        /**
         * Delete follower by primary key
         * @param id of record
         * @return affected rows
         */

       public function deleteFollowerById($id) {
            $sql = 'DELETE FROM followers WHERE ID = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->setNumber($id);
            return $this->executeUpdate($sqlQuery);
       }

        /**
         * Delete follower by primary key
         * @param usersid
         * @return affected rows
         */

       public function deleteFollowerByUser($usersid) {
            $sql = 'DELETE FROM followers WHERE leaderID = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->setNumber($usersid);
            return $this->executeUpdate($sqlQuery);
       }

        /**
         * Delete all records
         */

       public function deleteFollowers() {
            $sql = 'DELETE FROM followers';
            $sqlQuery = new SqlQuery($sql);
            return $this->executeUpdate($sqlQuery);
       }
        /**
         * Read row
         *
         * @return UsersMySql
         */
        protected function readRow($row){
            $follower = new Followers();

            if(isset($row['ID'])) { $follower->id = $row['ID']; }
            if(isset($row['leaderID'])) { $follower->leaderID = $row['leaderID']; }
            if(isset($row['followerID'])) { $follower->followerID = $row['followerID']; }
            if(isset($row['confirmed'])) { $follower->confirmed = $row['confirmed']; }

            return $follower;
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
