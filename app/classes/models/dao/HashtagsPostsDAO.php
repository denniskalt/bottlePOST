<?php

    /** Interface DAO 'hashtagsPosts'
     *
     * @author  Dennis Kalt
     * @date    2017-04-30
     *
     */
    interface HashtagsPostsDAO {

        /**
         * Set Hashtag and posts
         * @param $hashtags HashtagsPosts-Object
         * @return affected rows
         */
        public function setHashtagPosts($hashtagsposts);

        /**
         * Get all Hashtag-posts-relations
         * @return Hashtags
         */
        public function getHashtagsPosts();

        /**
         * Delete all rows
         */
        public function deleteHashtagsPosts();

    }

?>
