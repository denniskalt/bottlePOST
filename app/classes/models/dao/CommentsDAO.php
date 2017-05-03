<?php

    /** Interface DAO 'comments'
     *
     * @author  Dennis Kalt
     * @date    2017-04-26
     *
     */
    interface CommentsDAO {

        /**
         * Set comments
         * @return insert id
         */
        public function setComment($comments);

        /**
         * Get all comments
         * @return Comments
         */
        public function getComments();

        /**
         * Get Comment by primary key
         * @param String $id primary key
         * @return Comments
         */
        public function getCommentById($id);

        /**
         * Get Comments by User
         * @param $usersid ID from table 'users'
         * @return Comments
         */
        public function getCommentsByUsersId($usersid);

        /**
         * Get Comments by Post
         * @param $postsid ID from table 'posts'
         * @return Comments
         */
        public function getCommentsByPostsId($postsid);

        /**
         * Get the latest comments
         * @param $quantity Quantity of Comments
         * @return Comments
         */
        public function getLatestsComments($quantity);

        /**
         * Update record in table 'comments'
         * @param CommentsMySql comments
         * @return affected rows
         */
        public function update($comment);

	   /**
        * Delete comment from table
        * @param $id primary key
        * @return affected rows
        */
        public function deleteCommentById($id);

        /**
        * Delete comments from table by user
        * @param $usersid ID from table 'users'
        * @return affected rows
        */
        public function deleteCommentsByUser($usersid);

        /**
        * Delete comments from table by post
        * @param $postsid ID from table 'posts'
        * @return affected rows
        */
        public function deleteCommentsByPosts($postsid);

        /**
         * Delete all rows
         */
        public function deleteComments();
    }

?>
