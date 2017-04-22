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


}
?>
