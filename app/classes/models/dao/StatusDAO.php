<?php

    /** Interface DAO 'status'
     *
     * @author  Dennis Kalt
     * @date    2017-04-23
     *
     */
    interface StatusDAO {

        /**
         * Get all status
         * @return Status
         */
        public function getStatus();

        /**
         * Get status by primary key
         * @param String $id primary key
         * @return Status
         */
        public function getStatusById($id);

        /**
         * Get status by description
         * @param String $description description
         * @return Status
         */
        public function getStatusByDescription($description);

        /**
         * Update record in table 'status'
         * @param StatusMySql status
         * @return affected rows
         */
        public function update($status);

        /**
         * Delete status from table
         * @param $id primary key
         * @return affected rows
         */
        public function deleteStatusById($id);

        /**
         * Delete status from table
         * @param $description description
         * @return affected rows
         */
        public function deleteStatusByDescription($description);

        /**
         * Delete all rows
         */
        public function deleteStatus();

    }

?>
