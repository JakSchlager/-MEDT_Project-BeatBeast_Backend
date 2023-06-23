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

    $statement = "SELECT * FROM profiles WHERE userId = ".$_SESSION['user']['userId']."";
    $result = $conn->query($statement);

    header("Content-Type: application/json");
    echo json_encode($result -> fetch_assoc());
?>