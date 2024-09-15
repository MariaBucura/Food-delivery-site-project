<?php
    $serverName = "localhost";
    $username = "root";
    $password = "";
    $dbName = "DelishDrop";

    $conn = new mysqli($serverName, $username, $password, $dbName);
    if($conn->mysqli_connect_error){
        die("Connection failed0" . $conn->connect_error);
    }

?>