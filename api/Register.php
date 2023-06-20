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
        echo "Es wurde kein Emailadresse eingegeben!";
    }

    if(isset($_POST['phoneNr']) && !empty($_POST['phoneNr']) && preg_match('/^[0-9]{10}+$/', $_POST['phoneNr'])) {
        $phoneNr = $_POST['phoneNr'];
        echo "Hello World";
    }
    else {
        header("location: http://localhost:5173/");
    }
    

    if (isset($_POST['password']) && !empty($_POST['password'])){
        $password = $_POST['password'];
    }   
    else {
        Response::error(HttpErrorCodes::HTTP_BAD_REQUEST, "Missing parameters")->send();
    }
    if (isset($_POST['password2']) && !empty($_POST['password2'])){
        $password2 = $_POST['password2'];
    }   
    else {
        Response::error(HttpErrorCodes::HTTP_BAD_REQUEST, "Missing parameters")->send();
    }

    if ($password != $password2) {
        header("location: http://localhost:5173/");
    }
    


    $statement = "INSERT INTO profiles (username, email, password, phoneNr) VALUES ('$username', '$email', '$password', '$phoneNr');";
    $conn->query($statement);

    header("location: http://localhost:5173/login?username=$username");
    $statement = "SELECT id, username, email, password FROM profiles where id = (SELECT LAST_INSERT_ID())";

    if($res = self::$db->query($statement)) {
        while($row = $res->fetch_assoc()) {
            $myArray[] = $row;
        }   
    }
?>