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
         * @return Users
         */
        public function getUserByEmail($email);

        /**
         * Get User by username
         * @param $username username
         * @return Users
         */
        public function getIdByUsername($username);

        /**
         * Getter-Methods
         */
        public function getUsername($id);
        public function getEmail($id);
        public function getRegDate($id);
        public function getStatus($id);
        public function getProfilepic($id);
        public function getTitle($id);
        public function getForename($id);
        public function getSurname($id);
        public function getBirthdate($id);
        public function getPostcode($id);
        public function getUsersType($id);
        public function getLastLogin($id);

        /**
         * Setter-Methods
         */



        /**
         * Delete User
         * @param $id primary key
         */
        public function delete($id);



        /**
         * Update record in table
         *
         * @param Users user
         */
        public function update($user);

        /**
         * Delete all rows
         */
        public function clean();

        public function queryByName($value);

        public function queryByUsername($value);

        public function queryByEmail($value);

        public function queryByPassword($value);

        public function queryByUsertype($value);

        public function queryByBlock($value);

        public function queryBySendEmail($value);

        public function queryByGid($value);

        public function queryByRegisterDate($value);

        public function queryByLastvisitDate($value);

        public function queryByActivation($value);

        public function queryByParams($value);


        public function deleteByName($value);

        public function deleteByUsername($value);

        public function deleteByEmail($value);

        public function deleteByPassword($value);

        public function deleteByUsertype($value);

        public function deleteByBlock($value);

        public function deleteBySendEmail($value);

        public function deleteByGid($value);

        public function deleteByRegisterDate($value);

        public function deleteByLastvisitDate($value);

        public function deleteByActivation($value);

        public function deleteByParams($value);

    }

?>
