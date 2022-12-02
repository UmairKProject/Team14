<?php
//Database credentials variables
$db_host = "localhost";
$username = "root";
$password = "";
$db_name = "MW4U";

//Attempt to connect to the database 
$conn = new mysqli($db_host, $username, $password, $db_name);
// Check connection
if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>