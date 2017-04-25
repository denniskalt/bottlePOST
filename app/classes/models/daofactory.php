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


}
?>
