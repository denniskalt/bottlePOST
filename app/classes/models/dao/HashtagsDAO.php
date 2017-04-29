<?php

    /** Interface DAO 'hashtags'
     *
     * @author  Dennis Kalt
     * @date    2017-04-29
     *
     */
    interface HashtagsDAO {

        /**
         * Set Hashtag
         * @param $hashtags Hashtags-Object
         * @return affected rows
         */
        public function setHashtag($hashtags);

        /**
         * Get all Hashtags
         * @return Hashtags
         */
        public function getHashtags();

        /**
         * Get Hashtag by primary key
         * @param String $id primary key
         * @return Hashtags
         */
        public function getHashtagById($id);

        /**
         * Get Hashtag by postsid
         * @param String $postsid ID from table 'posts'
         * @return Hashtags
         */
        public function getHashtagByPostsId($postsid);

        /**
         * Get Hashtag by description
         * @param $description description of hashtag
         * @return Hashtags with idHashtags
         */
        public function getIdByDescription($description);

        /**
         * Update record in table 'hashtags'
         * @param $hashtags Hashtags-Object
         * @return affected rows
         */
        public function update($hashtags);

        /**
         * Delete all rows
         */
        public function deleteHashtags();

    }

?>
