<?php
include_once('config.php');

    /**
     * Class that operate on table 'notifications'
     *
     * @author  Lukas Bosse
     * @date    2017-05-10
     */

    class NotificationsMySqlDAO  {

        /**
         * Set notification
         * @param $notification Notification-Object
         * @return affected rows
         */
        public function setNotification($notification) {
            $sql = 'INSERT INTO notifications (notificationtypesId, usersId, commentsId, status, postsId, recieverID) VALUES (?,?,?,?,?,?)';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($notification->type);
            $sqlQuery->set($notification->usersId);
            $sqlQuery->set($notification->commentsId);
            $sqlQuery->set($notification->statusId);
            $sqlQuery->set($notification->postsId);
            $sqlQuery->set($notification->recieverId);
            return $this->executeInsert($sqlQuery);
        }

        /**
         * Get all Notifications
         * @return Notifications
         */
        public function getNotification() {
            $sql = 'SELECT * FROM notifications ORDER BY idNotifications DESC';
		    $sqlQuery = new SqlQuery($sql);
		    return $this->getList($sqlQuery);
        }

        /**
         * Get Notification by primary key
         * @param String $id primary key
         * @return Notification
         */
        public function getNotificationById($id) {
            $sql = 'SELECT * FROM notifications WHERE idNotifications = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($id);
            return $this->getList($sqlQuery);
        }

        /**
         * Get Notifications by usersid
         * @param $usersid ID from table 'users'
         * @return Notifications with primary key
         */
        public function getIdByUser($usersid) {
            $sql = 'SELECT * FROM notifications WHERE idNotifications = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($usersid);
            return $this->getList($sqlQuery);
        }

        /**
         * Update record in table 'notification'
         * @param NotificationsMySql notifications
         * @return affected rows
         */
        public function update($notification) {
            $sql = 'UPDATE notifications SET usersId = ?, commentsId = ?, status = ?, postsId = ?, recieverID = ? WHERE idNotifications = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($notification->usersId);
            $sqlQuery->set($notification->commentsId);
            $sqlQuery->set($notification->statusId);
            $sqlQuery->set($notification->postsId);
            $sqlQuery->set($notification->recieverId);
            $sqlQuery->setNumber($notification->id);
            return $this->executeUpdate($sqlQuery);
        }

	   /**
        * Delete notification from table
        * @param $id primary key
        * @return affected rows
        */
        public function deleteNotificationById($id) {
            $sql = 'DELETE FROM notifications WHERE idNotifications = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->setNumber($id);
            return $this->executeUpdate($sqlQuery);
        }

        /**
        * Delete notifications from table
        * @param $usersid ID from table 'users'
        * @return affected rows
        */
        public function deleteNotificationsByUser($usersid) {
            $sql = 'DELETE FROM notifications WHERE usersId = ?';
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->setNumber($usersid);
            return $this->executeUpdate($sqlQuery);
        }

        /**
         * Delete all rows
         */
        public function deleteNotifications() {
            $sql = 'DELETE FROM notifications';
            $sqlQuery = new SqlQuery($sql);
            return $this->executeUpdate($sqlQuery);
        }

   /**
         * Read row
         *
         * @return UsersMySql
         */
        protected function readRow($row){
            $notification = new Notification();

            if(isset($row['idNotifications'])) { $notification->id = $row['idNotifications']; }
            if(isset($row['notificationstypesId'])) { $notification->type = $row['notificationstypesId']; }
            if(isset($row['usersId'])) { $notification->usersId = $row['usersId']; }
            if(isset($row['commentsId'])) { $notification->commentsId = $row['commentsId']; }
            if(isset($row['status'])) { $notification->statusId = $row['status']; }
            if(isset($row['postsId'])) { $notification->postsId = $row['postsId']; }
            if(isset($row['recieverID'])) { $notification->recieverId = $row['recieverID']; }

            return $notification;
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
