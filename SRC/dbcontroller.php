<?php
class DBController {
	//Database credentials variables
	private $host = "localhost";
	private $user = "root";
	private $password = "";
	private $database = "MW4U";
	private $conn;
	
	function __construct() {
		$this->conn = $this->connectDB();
	}
	
	//Establish connection
	function connectDB() {
		$conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
		return $conn;
	}
	
	//Run relevant query
	function runQuery($query) {
		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		}		
		if(!empty($resultset))
			return $resultset;
	}
	
	//Get number of rows from a query
	function numRows($query) {
		$result  = mysqli_query($this->conn,$query);
		$rowcount = mysqli_num_rows($result);
		return $rowcount;	
	}
}
?>