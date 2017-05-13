<?php
include_once('config.php');

    /**
     * Class that operate on table 'hashtagsPosts'
     *
     * @author  Dennis Kalt
     * @date    2017-04-30
     */

    class HashtagsPostsMySqlDAO  {

        /**
         * Set Hashtag and posts
         * @param $hashtags HashtagsPosts-Object
         * @return affected rows
         */
        public function setHashtagPosts($hashtagsposts) {
            $sql = 'INSERT INTO hashtagsPosts VALUES(?, ?)';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($hashtagsposts->hashtagsid);
            $sqlQuery->set($hashtagsposts->postsid);
            return $this->executeInsert($sqlQuery);
        }

        /**
         * Get all Hashtag-posts-relations
         * @return Hashtags
         */
        public function getHashtagsPosts() {
            $sql = 'SELECT * FROM hashtagsPosts';
            $sqlQuery = new SqlQuery($sql);
		    return $this->getList($sqlQuery);
        }

        /**
         * Get Hashtag-posts-relations by hashtag
         * @return Hashtags
         */
        public function getPostsByHashtag($hashtagsid) {
            $sql = 'SELECT * FROM hashtagsPosts WHERE hashtagsid = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($hashtagsid);
		    return $this->getList($sqlQuery);
        }

        /**
         * Delete all rows
         */
        public function deleteHashtagsPosts() {
            $sql = 'DELETE FROM hashtagsPosts';
            $sqlQuery = new SqlQuery($sql);
            return $this->executeUpdate($sqlQuery);
        }

        /**
         *  Delete Hastag by post id
         *  @param $postid as primary key
         *  @return affected rows
         */

        public function deleteHashtagsByPostID($postId) {
            $sql = 'DELETE FROM hashtagsPosts WHERE postsId = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($postId);
            return $this->executeUpdate($sqlQuery);
        }

        /**
         * Read row
         *
         * @return UsersMySql
         */
        protected function readRow($row){
            $hashtags = new Hashtags();

            if(isset($row['hashtagsId'])) { $hashtags->hashtagsid = $row['hashtagsId']; }
            if(isset($row['postsId'])) { $hashtags->postsid = $row['postsId']; }

            return $hashtags;
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
