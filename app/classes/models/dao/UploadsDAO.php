<?php

    /** Interface DAO 'uploads'
     *
     * @author  Dennis Kalt
     * @date    2017-04-27
     *
     */
    interface UploadsDAO {

        public function setUpload($id, $title, $src);

        /**
         * Get all Posts
         * @return Posts
         */
        public function getUploadsByUser($userID);

        /**
         * Get Post by primary key
         * @param String $id primary key
         * @return Posts
         */
        public function getUploadsById($id);

        /**
         * Get Posts by usersid
         * @param $usersid ID from table 'users'
         * @return Posts with primary key
         */

        public function deleteUploadById($id);

    }

?>
