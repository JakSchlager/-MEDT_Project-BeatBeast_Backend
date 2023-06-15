<?php
    $host = "localhost";
    $db   = "web";
    $user = "web";
    $pass = "1234"; 
    session_start();
    $conn = new mysqli($host, $user, $pass, $db);

    if($conn->connect_error) {
        die("connection failed ". $conn->connect_error);
    }

 


?>