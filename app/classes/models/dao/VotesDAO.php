<?php

    /** Interface DAO 'votes'
     *
     * @author  Dennis Kalt
     * @date    2017-05-02
     *
     */
    interface VotesDAO {

        /**
         * Get all Votes
         * @return Votes
         */
        public function getVotes();

        /**
         * Get the vote by post and user
         * @param $usersid ID from table 'users'
         * @param $postsid ID from table 'posts'
         * @return Votes
         */
        public function getVoteByPostUser($usersid, $postsid);

        /**
         * Get all votes by post
         * @param $postsid ID from table 'posts'
         * @return Votes
         */
        public function getVotesByPost($postsid);

        /**
         * Get all votes by user
         * @param $usersid ID from table 'users'
         * @return Votes
         */
        public function getVotesByUser($usersid);

        /**
         * Update record in table 'votes'
         * @param UsersMySql user
         * @return affected rows
         */
        public function update($votes);

        /**
        * Saves vote
        * @param $postsid ID from table 'posts'
        * @param $usersid ID from table 'users'
        * @param $vote voting
        * @return affected rows
        */
        public function saveVote($postsid, $usersid, $vote);

        /**
        * Delete votes from table by post
        * @param $postsid ID from table 'posts'
        * @return affected rows
        */
        public function deleteVotesByPost($postsid);

        /**
        * Delete votes from table by user
        * @param $usersid ID from table 'users'
        * @return affected rows
        */
        public function deleteVotesByUser($usersid);

        /**
         * Delete all rows
         */
        public function deleteVotes();

    }

?>
