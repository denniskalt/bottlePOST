<?php

    /** Interface DAO 'posts'
     *
     * @author  Dennis Kalt
     * @date    2017-04-27
     *
     */
    interface PostsDAO {

        /**
         * Get all Posts
         * @return Posts
         */
        public function getPosts();

        /**
         * Get Post by primary key
         * @param String $id primary key
         * @return Posts
         */
        public function getPostById($id);

        /**
         * Get Posts by usersid
         * @param $usersid ID from table 'users'
         * @return Posts with primary key
         */
        public function getIdByUser($usersid);

        /**
         * Update record in table 'posts'
         * @param PostsMySql posts
         * @return affected rows
         */
        public function update($posts);

	   /**
        * Delete post from table
        * @param $id primary key
        * @return affected rows
        */
        public function deletePostById($id);

        /**
        * Delete posts from table
        * @param $usersid ID from table 'users'
        * @return affected rows
        */
        public function deletePostsByUser($usersid);

        /**
         * Delete all rows
         */
        public function deletePosts();

    }

?>
