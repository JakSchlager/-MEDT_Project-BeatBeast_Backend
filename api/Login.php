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

    if (isset($_POST['password']) && !empty($_POST['password'])){
        $password = $_POST['password'];
    }   

    $_sql = "SELECT * FROM profiles WHERE username='$username' AND password='$password'";

    if($_res = $conn->query($_sql)) {
        if($_res->num_rows > 0) {
            $_SESSION["login"] = 1;
            $_SESSION["user"] = $_res->fetch_assoc();
            header("location: http://localhost:5173/home");
        } else {
            header("location: http://localhost:5173/login");
            exit;
        }

        $_res->close();
    }

?>