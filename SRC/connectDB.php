<?php
//Database credentials variables
$db_host = 'localhost';
$db_name = 'MW4U';
$username = 'root';
$password = '';

//Attempt to connect to the database
try {
	$db = new PDO("mysql:dbname=$db_name;host=$db_host", $username, $password); 
} catch(PDOException $ex) {
	echo("Failed to connect to the database.<br>");
	echo($ex->getMessage());
	exit;
}
?>