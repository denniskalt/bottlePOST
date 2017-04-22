<?php

    /** Interface DAO 'users'
     *
     * @author  Dennis Kalt
     * @date    2017-04-22
     *
     */
    interface UsersDAO {

        /**
         *
         * Get Users object by primary key
         *
         * @param String $id primary key
         * @return Users
         *
         */
        public function getAll();

    }

?>
