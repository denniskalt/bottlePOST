<?php

    /** Interface DAO 'notifications'
     *
     * @author  Lukas Bosse
     * @date    2017-05-10
     *
     */
    interface NotificationDAO {

        /**
         * Set notification
         * @param $notification Notification-Object
         * @return affected rows
         */
        public function setNotification($notification);

        /**
         * Get all Notifications
         * @return Notifications
         */
        public function getNotification();

        /**
         * Get Notification by primary key
         * @param String $id primary key
         * @return Notification
         */
        public function getNotificationById($id);

        /**
         * Get Notifications by usersid
         * @param $usersid ID from table 'users'
         * @return Notifications with primary key
         */
        public function getIdByUser($usersid);

        /**
         * Update record in table 'notification'
         * @param NotificationsMySql notifications
         * @return affected rows
         */
        public function update($notification);

	   /**
        * Delete notification from table
        * @param $id primary key
        * @return affected rows
        */
        public function deleteNotificationById($id);

        /**
        * Delete notifications from table
        * @param $usersid ID from table 'users'
        * @return affected rows
        */
        public function deleteNotificationsByUser($usersid);

        /**
         * Delete all rows
         */
        public function deleteNotifications();

    }

?>
