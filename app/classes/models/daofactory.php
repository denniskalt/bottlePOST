<?php

/**
 * DAOFactory
 * @author: http://phpdao.com
 * @date: ${date}
 */
class DAOFactory{

	/*
	 * @return AnunciantesCatDAO
	 */
	public static function getUsersDAO(){
		return new UsersMySqlDAO();
	}

    public static function getStatusDAO(){
		return new StatusMySqlDAO();
	}

    public static function getCitiesDAO(){
		return new CitiesMySqlDAO();
	}

    public static function getCommentsDAO(){
		return new CommentsMySqlDAO();
	}

    public static function getPostsDAO(){
		return new PostsMySqlDAO();
	}

    /*public static function getNotificationsDAO() {
        return new NotificationsMySqlDAO();
    }*/

    public static function getHashtagsDAO() {
        return new HashtagsMySqlDAO();
    }

    public static function getHashtagsPostsDAO() {
        return new HashtagsPostsMySqlDAO();
    }

    public static function getVotesDAO() {
        return new VotesMySqlDAO();
    }

}
?>
