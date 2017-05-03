<?php
include_once('config.php');

    /**
     * Class that operate on table 'comments'
     *
     * @author  Dennis Kalt
     * @date    2017-04-26
     */

    class CommentsMySqlDAO  {

        /**
         * Set comments
         * @return insert id
         */
        public function setComment($comments){
            $sql = 'INSERT INTO comments (usersId, postsId, comment) VALUES (?, ?, ?)';
            $sqlQuery = new SqlQuery($sql);

            $sqlQuery->set($comments->usersid);
            $sqlQuery->set($comments->postsid);
            $sqlQuery->set($comments->comment);
            return $this->executeInsert($sqlQuery);
        }

        /**
         * Get all comments
         * @return Comments
         */
        public function getComments() {
            $sql = 'SELECT * FROM comments';
		    $sqlQuery = new SqlQuery($sql);
		    return $this->getList($sqlQuery);
        }

        /**
         * Get Comment by primary key
         * @param String $id primary key
         * @return Comments
         */
        public function getCommentById($id) {
            $sql = 'SELECT * FROM comments WHERE idComments = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($id);
            return $this->getList($sqlQuery);
        }

        /**
         * Get Comments by User
         * @param $usersid ID from table 'users'
         * @return Comments
         */
        public function getCommentsByUsersId($usersid) {
            $sql = 'SELECT * FROM comments WHERE usersId = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($usersid);
            return $this->getList($sqlQuery);
        }

        /**
         * Get Comments by Post
         * @param $postsid ID from table 'posts'
         * @return Comments
         */
        public function getCommentsByPostsId($postsid) {
            $sql = 'SELECT * FROM comments WHERE postsId = ? ORDER BY idComments DESC';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($postsid);
            return $this->getList($sqlQuery);
        }

        /**
         * Get the latest comments
         * @param $quantity Quantity of Comments
         * @return Comments
         */
        public function getLatestsComments($quantity) {
            $sql = 'SELECT * FROM comments LIMIT '.$quantity;
            $sqlQuery = new SqlQuery($sql);
            return $this->getList($sqlQuery);
        }

        /**
         * Update record in table 'comments'
         * @param CommentsMySql comments
         * @return affected rows
         */
        public function update($comment) {
            $sql = 'UPDATE comments SET comment = ? WHERE idComments = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($comments->comment);
            $sqlQuery->setNumber($comments->id);
            return $this->executeUpdate($sqlQuery);
        }

	   /**
        * Delete comment from table
        * @param $id primary key
        * @return affected rows
        */
        public function deleteCommentById($id) {
            $sql = 'DELETE FROM comments WHERE idComments = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($id);
            return $this->executeUpdate($sqlQuery);
        }

        /**
        * Delete comments from table by user
        * @param $usersid ID from table 'users'
        * @return affected rows
        */
        public function deleteCommentsByUser($usersid) {
            $sql = 'DELETE FROM comments WHERE usersId = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($usersid);
            return $this->executeUpdate($sqlQuery);
        }

        /**
        * Delete comments from table by post
        * @param $postsid ID from table 'posts'
        * @return affected rows
        */
        public function deleteCommentsByPosts($postsid) {
            $sql = 'DELETE FROM comments WHERE postsId = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($postsid);
            return $this->executeUpdate($sqlQuery);
        }

        /**
         * Delete all rows
         */
        public function deleteComments() {
            $sql = 'DELETE FROM comments';
            $sqlQuery = new SqlQuery($sql);
            return $this->executeUpdate($sqlQuery);
        }

        /**
         * Read row
         *
         * @return CommentsMySql
         */
        protected function readRow($row){
            $comments = new Comments();

            if(isset($row['idComments'])) { $comments->id = $row['idComments']; }
            if(isset($row['usersId'])) { $comments->usersid = $row['usersId']; }
            if(isset($row['postsId'])) { $comments->postsid = $row['postsId']; }
            if(isset($row['comment'])) { $comments->comment = $row['comment']; }
            if(isset($row['time'])) { $comments->time = $row['time']; }
            return $comments;
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
         * @return CommentsMySql
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
