<?php

    /** Interface DAO 'users'
     *
     * @author  Dennis Kalt
     * @date    2017-04-22
     *
     */
    interface UsersDAO {

        /**
         * Get all Users
         * @return Users with idUsers, username, email
         */
        public function getUsers();

        /**
         * Get User by primary key
         * @param String $id primary key
         * @return Users
         */
        public function getUserById($id);

        /**
         * Get User by email adress
         * @param $email email adress
         * @return Users with idUsers
         */
        public function getIdByEmail($email);

        /**
         * Get User-ID by username
         * @param $username username
         * @return Users with idUsers
         */
        public function getIdByUsername($username);

        /**
         * Get Username
         * @param $id primary key
         * @return Users with username
         */
        public function getUsername($id);

        /**
         * Get email adress
         * @param $id primary key
         * @return Users with email
         */
        public function getEmail($id);

        /**
         * Get registry date
         * @param $id primary key
         * @return Users with regDate
         */
        public function getRegDate($id);

        /**
         * Get status code
         * @param $id primary key
         * @return Users with status
         */
        public function getStatus($id);

        /**
         * Get profile picture path
         * @param $id primary key
         * @return Users with profilepic
         */
        public function getProfilepic($id);

        /**
         * Get title
         * @param $id primary key
         * @return Users with title
         */
        public function getTitle($id);

        /**
         * Get forename
         * @param $id primary key
         * @return Users with forename
         */
        public function getForename($id);

        /**
         * Get surname
         * @param $id primary key
         * @return Users with surname
         */
        public function getSurname($id);

        /**
         * Get birthdate
         * @param $id primary key
         * @return Users with birthDate
         */
        public function getBirthdate($id);

        /**
         * Get postcode
         * @param $id primary key
         * @return Users with postcode
         */
        public function getPostcode($id);

        /**
         * Get the code of user type
         * @param $id primary key
         * @return Users with usersTypesId
         */
        public function getUsersType($id);

        /**
         * Get date of last login
         * @param $id primary key
         * @return Users with lastLogin
         */
        public function getLastLogin($id);

        /**
         * Get all users ordered by field
         * @param $orderColumn column name
         * @return Users with idUsers, username, email
         */
        public function getUsersOrderBy($orderColumn);

        /**
         * Update record in table 'users'
         * @param UsersMySql user
         * @return affected rows
         */
        public function update($user);

	   /**
        * Delete user from table
        * @param $id primary key
        * @return affected rows
        */
        public function deleteUserById($id);

        /**
        * Delete user from table
        * @param $email email adress
        * @return affected rows
        */
        public function deleteUserByEmail($email);

        /**
        * Delete user from table
        * @param $status status code
        * @return affected rows
        */
        public function deleteUserByStatus($status);

        /**
        * Delete user from table
        * @param $userType user types id
        * @return affected rows
        */
        public function deleteUserByUserType($userType);

        /**
        * Delete user from table
        * @param $lastLogin date of last login
        * @return affected rows
        */
        public function deleteUserByLastLogin($lastLogin);

        /**
         * Delete all rows
         */
        public function deleteUsers();

    }

?>
