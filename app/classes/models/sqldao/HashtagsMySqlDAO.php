<?php
include_once('config.php');

    /**
     * Class that operate on table 'hashtags'
     *
     * @author  Dennis Kalt
     * @date    2017-04-29
     */

    class HashtagsMySqlDAO  {

        /**
         * Set Hashtag
         * @param $hashtags Hashtags-Object
         * @return affected rows
         */
        public function setHashtag($hashtags) {
            $sql = 'INSERT INTO hashtags (bezeichnung) VALUES (?)';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($hashtags->description);
            return $this->executeInsert($sqlQuery);
        }

        /**
         * Get all Hashtags
         * @return Hashtags
         */
        public function getHashtags() {
            $sql = 'SELECT * FROM hashtags';
		    $sqlQuery = new SqlQuery($sql);
		    return $this->getList($sqlQuery);
        }

        /**
         * Get Hashtag by primary key
         * @param String $id primary key
         * @return Hashtags
         */
        public function getHashtagById($id) {
            $sql = 'SELECT * FROM hashtags WHERE idHashtags = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($id);
            return $this->getList($sqlQuery);
        }

        /**
         * Get Hashtag by postsid
         * @param String $postsid ID from table 'posts'
         * @return Hashtags
         */
        public function getHashtagByPostsId($postsid) {
            $sql = 'SELECT hashtags.idHashtags, hashtags.bezeichnung, hashtagsposts.postsId FROM hashtags INNER JOIN hashtagsposts ON hashtags.idHashtags=hashtagsposts.hashtagsId WHERE hashtagsposts.postsId = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($postsid);
            return $this->getList($sqlQuery);
        }

        /**
         * Get Hashtag by description
         * @param $description description of hashtag
         * @return Hashtags with idHashtags
         */
        public function getIdByDescription($description) {
            $sql = 'SELECT * FROM hashtags WHERE bezeichnung = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($description);
            return $this->getList($sqlQuery);
        }

        /**
         * Update record in table 'hashtags'
         * @param $hashtags Hashtags-Object
         * @return affected rows
         */
        public function update($hashtags) {
            $sql = 'UPDATE hashtags SET bezeichnung = ? WHERE idHashtags = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($hashtags->description);
            $sqlQuery->setNumber($hashtags->id);
            return $this->executeUpdate($sqlQuery);
        }

        /**
         * Delete all rows
         */
        public function deleteHashtags() {
            $sql = 'DELETE FROM hashtags';
            $sqlQuery = new SqlQuery($sql);
            return $this->executeUpdate($sqlQuery);
        }

        /**
         * Find Hashtags in input
         * @param $content string input message
         * @return Array $keywords
         */
        public function findHashtags($content, $str = 1) {
            preg_match_all('/~(\w+)/',$content,$matches);
            $i = 0;
            if ($str) {
                foreach ($matches[1] as $match) {
                    $count = count($matches[1]);
                    $keywords .= "$match";
                    $i++;
                    if ($count > $i) $keywords .= ", ";
                }
            } else {
                foreach ($matches[1] as $match) {
                    $keyword[] = $match;
                }
                    if(isset($keyword)) {
                        $keywords = $keyword;
                    } else {
                        $keywords = array();
                    }
                    }
            return $keywords;
        }

        /**
         * Read row
         *
         * @return UsersMySql
         */
        protected function readRow($row){
            $hashtags = new Hashtags();

            if(isset($row['idHashtags'])) { $hashtags->id = $row['idHashtags']; }
            if(isset($row['bezeichnung'])) { $hashtags->description = $row['bezeichnung']; }
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
