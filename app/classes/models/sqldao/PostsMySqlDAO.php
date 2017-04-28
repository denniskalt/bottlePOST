<?php
include_once('config.php');

    /**
     * Class that operate on table 'posts'
     *
     * @author  Dennis Kalt
     * @date    2017-04-27
     */

    class PostsMySqlDAO  {

        /**
         * Set post
         * @return affected rows
         */
        public function setPost($posts){
            $sql = 'INSERT INTO posts (content, usersid) VALUES (?, ?)';
            $sqlQuery = new SqlQuery($sql);

            $sqlQuery->set($posts->content);
            $sqlQuery->set($posts->usersid);

            //$sqlQuery->setNumber($posts->id);
            $this->executeUpdate($sqlQuery);
        }

        /**
         * Get all Posts
         * @return Posts
         */
        public function getPosts() {
            $sql = 'SELECT * FROM posts ORDER BY idPosts DESC';
		    $sqlQuery = new SqlQuery($sql);
		    return $this->getList($sqlQuery);
        }

        /**
         * Get Post by primary key
         * @param String $id primary key
         * @return Posts
         */
        public function getPostById($id) {
            $sql = 'SELECT * FROM posts WHERE idPosts = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($id);
            return $this->getList($sqlQuery);
        }

        /**
         * Get Posts by usersid
         * @param $usersid ID from table 'users'
         * @return Posts with primary key
         */
        public function getIdByUser($usersid) {
            $sql = 'SELECT * FROM posts WHERE usersId = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($usersid);
            return $this->getList($sqlQuery);
        }

        /**
         * Update record in table 'posts'
         * @param PostsMySql posts
         * @return affected rows
         */
        public function update($posts){
            $sql = 'UPDATE posts SET content = ? WHERE idPosts = ?';
            $sqlQuery = new SqlQuery($sql);

            $sqlQuery->set($posts->content);

            $sqlQuery->setNumber($posts->id);
            return $posts;//$this->executeUpdate($sqlQuery);
        }

	   /**
        * Delete post from table
        * @param $id primary key
        * @return affected rows
        */
        public function deletePostById($id) {
            $sql = 'DELETE FROM posts WHERE idPosts = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->setNumber($id);
            return $this->executeUpdate($sqlQuery);
        }

        /**
        * Delete posts from table
        * @param $usersid ID from table 'users'
        * @return affected rows
        */
        public function deletePostsByUser($usersid) {
            $sql = 'DELETE FROM posts WHERE usersId = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->setNumber($usersid);
            return $this->executeUpdate($sqlQuery);
        }

        /**
         * Delete all rows
         */
        public function deletePosts() {
            $sql = 'DELETE FROM posts';
            $sqlQuery = new SqlQuery($sql);
            return $this->executeUpdate($sqlQuery);
        }

        /**
         * Read row
         *
         * @return UsersMySql
         */
        protected function readRow($row){
            $posts = new Posts();

            if(isset($row['idPosts'])) { $posts->id = $row['idPosts']; }
            if(isset($row['content'])) { $posts->content = $row['content']; }
            if(isset($row['usersId'])) { $posts->usersid = $row['usersId']; }
            if(isset($row['date'])) { $posts->date = $row['date']; }

            return $posts;
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
