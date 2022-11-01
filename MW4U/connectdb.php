<?php

$db_host = 'localhost';
$db_name = 'u_210091988_astoncv';
$username = 'u-210091988';
$password = 'O6oJKKXtRD6liiA';

try {
	$db = new PDO("mysql:dbname=$db_name;host=$db_host", $username, $password); 
} catch(PDOException $ex) {
	echo("Failed to connect to the database.<br>");
	echo($ex->getMessage());
	exit;
}
?>