<?php
include_once('config.php');

    /**
     * Class that operate on table 'users
     *
     * @author  Dennis Kalt
     * @date    2017-04-22
     */

    class UsersMySqlDAO  {

        /**
         * Get all Users
         * @return Users with idUsers, username, email
         */
        public function getUsers() {
            $sql = 'SELECT idUsers, username, email FROM users';
		    $sqlQuery = new SqlQuery($sql);
		    return $this->getList($sqlQuery);
        }

        /**
         * Get User by primary key
         * @param String $id primary key
         * @return Users
         */
        public function getUserById($id) {
            $sql = 'SELECT * FROM users WHERE idUsers = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($id);
            return $this->getList($sqlQuery);
        }

        /**
         * Get User by email adress
         * @param $email email adress
         * @return Users with idUsers
         */
        public function getIdByEmail($email) {
            $sql = 'SELECT idUsers FROM users WHERE email = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($email);
            return $this->getList($sqlQuery);
        }

        /**
         * Get User-ID by username
         * @param $username username
         * @return Users with idUsers
         */
        public function getIdByUsername($username) {
            $sql = 'SELECT idUsers FROM users WHERE username = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($username);
            return $this->getList($sqlQuery);
        }

        /**
         * Get Username
         * @param $id primary key
         * @return Users with username
         */
        public function getUsername($id) {
            $sql = 'SELECT username FROM users WHERE idUsers = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($id);
            return $this->getList($sqlQuery);
        }

        /**
         * Get email adress
         * @param $id primary key
         * @return Users with email
         */
        public function getEmail($id) {
            $sql = 'SELECT email FROM users WHERE idUsers = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($id);
            return $this->getList($sqlQuery);
        }

        /**
         * Get registry date
         * @param $id primary key
         * @return Users with regDate
         */
        public function getRegDate($id) {
            $sql = 'SELECT regDate FROM users WHERE idUsers = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($id);
            return $this->getList($sqlQuery);
        }

        /**
         * Get status code
         * @param $id primary key
         * @return Users with status
         */
        public function getStatus($id) {
            $sql = 'SELECT status FROM users WHERE idUsers = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($id);
            return $this->getList($sqlQuery);
        }

        /**
         * Get profile picture path
         * @param $id primary key
         * @return Users with profilepic
         */
        public function getProfilepic($id) {
            $sql = 'SELECT profilepic FROM users WHERE idUsers = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($id);
            return $this->getList($sqlQuery);
        }

        /**
         * Get title
         * @param $id primary key
         * @return Users with title
         */
        public function getTitle($id) {
            $sql = 'SELECT title FROM users WHERE idUsers = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($id);
            return $this->getList($sqlQuery);
        }

        /**
         * Get forename
         * @param $id primary key
         * @return Users with forename
         */
        public function getForename($id) {
            $sql = 'SELECT forename FROM users WHERE idUsers = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($id);
            return $this->getList($sqlQuery);
        }

        /**
         * Get surname
         * @param $id primary key
         * @return Users with surname
         */
        public function getSurname($id) {
            $sql = 'SELECT surname FROM users WHERE idUsers = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($id);
            return $this->getList($sqlQuery);
        }

        /**
         * Get birthdate
         * @param $id primary key
         * @return Users with birthDate
         */
        public function getBirthdate($id) {
            $sql = 'SELECT birthDate FROM users WHERE idUsers = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($id);
            return $this->getList($sqlQuery);
        }

        /**
         * Get postcode
         * @param $id primary key
         * @return Users with postcode
         */
        public function getPostcode($id) {
            $sql = 'SELECT postcode FROM users WHERE idUsers = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($id);
            return $this->getList($sqlQuery);
        }

        /**
         * Get the code of user type
         * @param $id primary key
         * @return Users with usersTypesId
         */
        public function getUsersType($id) {
            $sql = 'SELECT usersTypesId FROM users WHERE idUsers = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($id);
            return $this->getList($sqlQuery);
        }

        /**
         * Get date of last login
         * @param $id primary key
         * @return Users with lastLogin
         */
        public function getLastLogin($id) {
            $sql = 'SELECT lastLogin FROM users WHERE idUsers = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($id);
            return $this->getList($sqlQuery);
        }

        /**
         * Get all users ordered by field
         * @param $orderColumn column name
         * @return Users with idUsers, username, email
         */
        public function getUsersOrderBy($orderColumn){
            $sql = 'SELECT idUsers, username, email FROM users ORDER BY '.$orderColumn;
            $sqlQuery = new SqlQuery($sql);
            return $this->getList($sqlQuery);
        }

        /**
         * Update record in table 'users'
         * @param UsersMySql user
         * @return affected rows
         */
        public function update($user){
            $sql = 'UPDATE users SET username = ?, email = ? WHERE idUsers = ?';
            $sqlQuery = new SqlQuery($sql);

            $sqlQuery->set($user->username);
            $sqlQuery->set($user->email);

            $sqlQuery->setNumber($user->idUsers);
            return $this->executeUpdate($sqlQuery);
        }

	   /**
        * Delete user from table
        * @param $id primary key
        * @return affected rows
        */
        public function deleteUserById($id){
            $sql = 'DELETE FROM notifications WHERE usersId = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->setNumber($id);
            $this->executeUpdate($sqlQuery);
            $sql = 'DELETE FROM users WHERE idUsers = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->setNumber($id);
            return $this->executeUpdate($sqlQuery);
        }

        /**
        * Delete user from table
        * @param $email email adress
        * @return affected rows
        */
        public function deleteUserByEmail($email){
            $sql = 'DELETE FROM users WHERE email = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($email);
            return $this->executeUpdate($sqlQuery);
        }

        /**
        * Delete user from table
        * @param $status status code
        * @return affected rows
        */
        public function deleteUserByStatus($status){
            $sql = 'DELETE FROM users WHERE status = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->setNumber($status);
            return $this->executeUpdate($sqlQuery);
        }

        /**
        * Delete user from table
        * @param $userType user types id
        * @return affected rows
        */
        public function deleteUserByUserType($userType){
            $sql = 'DELETE FROM users WHERE userTypesId = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->setNumber($userType);
            return $this->executeUpdate($sqlQuery);
        }

        /**
        * Delete user from table
        * @param $lastLogin date of last login
        * @return affected rows
        */
        public function deleteUserByLastLogin($lastLogin){
            $sql = 'DELETE FROM users WHERE lastLogin = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->setNumber($lastLogin);
            return $this->executeUpdate($sqlQuery);
        }

        /**
         * Delete all rows
         */
        public function deleteUsers(){
            $sql = 'DELETE FROM users';
            $sqlQuery = new SqlQuery($sql);
            return $this->executeUpdate($sqlQuery);
        }

        /**
         * Read row
         *
         * @return UsersMySql
         */
        protected function readRow($row){
            $user = new Users();

            if(isset($row['idUsers'])) { $user->id = $row['idUsers']; }
            if(isset($row['username'])) { $user->username = $row['username']; }
            if(isset($row['email'])) { $user->email = $row['email']; }
            if(isset($row['regDate'])) { $user->regDate = $row['regDate']; }
            if(isset($row['status'])) { $user->status = $row['status']; }
            if(isset($row['profilepic'])) { $user->profilepic = $row['profilepic']; }
            if(isset($row['title'])) { $user->title = $row['title']; }
            if(isset($row['forename'])) { $user->forename = $row['forename']; }
            if(isset($row['surname'])) { $user->surname = $row['surname']; }
            if(isset($row['birthDate'])) { $user->birthDate = $row['birthDate']; }
            if(isset($row['postcode'])) { $user->postcode = $row['postcode']; }
            if(isset($row['usersTypesId'])) { $user->usersTypesId = $row['usersTypesId']; }
            if(isset($row['lastLogin'])) { $user->lastLogin = $row['lastLogin']; }

            return $user;
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
