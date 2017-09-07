<?php
class Database {
		
	private $connection;
	

	function __construct() {
		$this->connection = $this->getConnection();
	}
	
	function __destruct() {
		mysqli_close($this->connection);
	}
	
	function exec($query) {
		$this->connection->exec($query);
	}
	
	function query($query) {
		$result = mysqli_query($this->connection, $query);
		return $result;
	}
	
	function querySingle($query) {
		$result = $this->connection->querySingle($query,true);
		return $result;
	}
	
	function prepare($query) {
		return $this->connection->prepare($query);
	}
	
	function escapeString($string) {
		return $this->connection->escapeString($string);
	}

	function fetchConnection(){
		return $this->connection;
	}
	
	private function getConnection() {
		 $username = "root";
		 $password = "";
		 $database = "STBD";
		 $host = "localhost";
		$connection = mysqli_connect($host,$username,$password,$database);
		//$ticker = $_POST[""]; /*   waiting for variable   */
		if (mysqli_connect_errno())
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		else
			return $connection;
		  
	}
}
?>