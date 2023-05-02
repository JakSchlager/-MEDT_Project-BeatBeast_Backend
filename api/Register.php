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
    
    if (isset($_POST['username']) && !empty($_POST['username'])){
        $username = $_POST['username'];
    }
    else {
        header("location: http://localhost:5173/");
        echo "Es wurde kein Username eingegeben!";
    }

    if (isset($_POST['email']) && !empty($_POST['email'])){
        $email = $_POST['email'];
    }
    else {
        header("location: http://localhost:5173/");
        echo "Es wurde kein Passwort eingegeben!";
    }

    if (isset($_POST['password1']) && !empty($_POST['password1'])){
        $password = $_POST['password1'];
    }   
    else {
        Response::error(HttpErrorCodes::HTTP_BAD_REQUEST, "Missing parameters")->send();
    }

    $statement = "INSERT INTO profiles (username, email, password) VALUES ('$username', '$email', '$password');";
    $conn->query($statement);

    header("location: http://localhost:5173/login?username=$username");
    $statement = "SELECT id, username, email, password FROM profiles where id = (SELECT LAST_INSERT_ID())";

    if($res = self::$db->query($statement)) {
        while($row = $res->fetch_assoc()) {
            $myArray[] = $row;
        }
    }
?>