<?php
    $serverName = 'localhost';
    $dbName = 'Your localhost name';
    $userName = 'root';
    $password = '';
    $con = new mysqli($serverName, $userName, $password, $dbName);     

        if($con->connect_error)
        {
            die("Connection failed: " .$con->connect_error);
        }


?>