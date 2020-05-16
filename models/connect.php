<?php
class Database
{
	public $conn;
	public $result;

	public function dbConnect() {
		$this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		if ($this->conn->connect_error) {
			$this->error('Failed to connect to MySQL - ' . $this->connection->connect_error);
		}
		$this->conn->set_charset(CHARSET);
	}
	public function execute($sql){
	    $this->dbConnect();
		$this->result = $this->conn->query($sql);
		return 	$this->result;
	}
}

?>