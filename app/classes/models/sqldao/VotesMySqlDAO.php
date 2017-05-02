<?php
include_once('config.php');

    /**
     * Class that operate on table 'users
     *
     * @author  Dennis Kalt
     * @date    2017-05-02
     */

    class VotesMySqlDAO  {

        /**
         * Get all Votes
         * @return Votes
         */
        public function getVotes() {
            $sql = 'SELECT * FROM votes';
		    $sqlQuery = new SqlQuery($sql);
		    return $this->getList($sqlQuery);
        }

        /**
         * Get the vote by post and user
         * @param $usersid ID from table 'users'
         * @param $postsid ID from table 'posts'
         * @return Votes
         */
        public function getVoteByPostUser($usersid, $postsid) {
            $sql = 'SELECT * FROM votes WHERE usersId = ? AND postsId = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($usersid);
            $sqlQuery->set($postsid);
            return $this->getList($sqlQuery);
        }

        /**
         * Get all votes by post
         * @param $postsid ID from table 'posts'
         * @return Votes
         */
        public function getVotesByPost($postsid) {
            $sql = 'SELECT * FROM votes WHERE postsId = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($postsid);
            return $this->getList($sqlQuery);
        }

        /**
         * Get all votes by user
         * @param $usersid ID from table 'users'
         * @return Votes
         */
        public function getVotesByUser($usersid){
            $sql = 'SELECT * FROM votes WHERE usersId = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($usersid);
            return $this->getList($sqlQuery);
        }

        /**
         * Update record in table 'votes'
         * @param UsersMySql user
         * @return affected rows
         */
        public function update($votes){
            $sql = 'UPDATE votes SET vote = ? WHERE usersId = ? AND postsId = ?';
            $sqlQuery = new SqlQuery($sql);

            $sqlQuery->set($votes->vote);
            $sqlQuery->set($votes->usersid);

            $sqlQuery->setNumber($votes->postsid);
            return $this->executeUpdate($sqlQuery);
        }

        /**
        * Saves vote
        * @param $postsid ID from table 'posts'
        * @param $usersid ID from table 'users'
        * @param $vote voting
        * @return affected rows
        */
        public function saveVote($postsid, $usersid, $vote) {
            return $this->getVoteByPostUser($usersid, $postsid);
        }

        /**
        * Delete votes from table by post
        * @param $postsid ID from table 'posts'
        * @return affected rows
        */
        public function deleteVotesByPost($postsid){
            $sql = 'DELETE FROM votes WHERE postsId = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->setNumber($postsid);
            return $this->executeUpdate($sqlQuery);
        }

        /**
        * Delete votes from table by user
        * @param $usersid ID from table 'users'
        * @return affected rows
        */
        public function deleteVotesByUser($usersid){
            $sql = 'DELETE FROM votes WHERE usersId = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->setNumber($usersid);
            return $this->executeUpdate($sqlQuery);
        }

        /**
         * Delete all rows
         */
        public function deleteVotes(){
            $sql = 'DELETE FROM votes';
            $sqlQuery = new SqlQuery($sql);
            return $this->executeUpdate($sqlQuery);
        }

        /**
         * Read row
         *
         * @return UsersMySql
         */
        protected function readRow($row){
            $votes = new Votes();

            if(isset($row['usersId'])) { $votes->usersid = $row['usersId']; }
            if(isset($row['postsId'])) { $votes->postsid = $row['postsId']; }
            if(isset($row['vote'])) { $votes->vote = $row['vote']; }

            return $votes;
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
