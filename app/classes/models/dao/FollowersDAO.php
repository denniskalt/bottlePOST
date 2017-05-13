<?php

    /** Interface DAO 'followers'
     *
     * @author  Lukas Bosse
     * @date    2017-05-10
     *
     */

    interface FollowersDAO {

       /**
        * Insert Follower
        * @param $follower Follower-Object
        * @return affected rows
        */

       public function insertFollower($follower);

       /**
        * Get all followers
        * @return followers
        */

       public function getFollowers();

       /**
        * Get Follower by id
        * @param $id primary key
        * @return follower with primary key
        */

       public function getFollowersById($id);

        /**
         * Get id of record by primary key
         * @param $usersid ID from table 'users'
         * @return follower with primary key
         */

       public function getIdByUser($usersid);

        /**
         * Update record in table 'followers'
         * @param FollowersMySql follower
         * @return affected rows
         */

       public function update($follower);

        /**
         * Delete follower by primary key
         * @param id of record
         * @return affected rows
         */

       public function deleteFollowerById($id);

        /**
         * Delete follower by primary key
         * @param usersid
         * @return affected rows
         */

       public function deleteFollowerByUser($usersid);

        /**
         * Delete all records
         */

       public function deleteFollowers();

    }

?>
