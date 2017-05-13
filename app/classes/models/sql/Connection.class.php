<?php
/*
 * Object represents connection to database
 *
 * @author: http://phpdao.com
 * @date: 27.11.2007
 */
class Connection{

    private $connection;

	public function Connection(){
		$this->connection = ConnectionFactory::getConnection();
	}

    public function getError() {
        return $this->connection->error;
    }

    public function getAffectedRows() {
        return $this->connection->affected_rows;
    }

    public function getInsertID() {
        return $this->connection->insert_id;
    }

	public function close(){
		ConnectionFactory::close($this->connection);
	}

	public function executeQuery($sql){
		return mysqli_query($this->connection, $sql);
	}
}
?>
