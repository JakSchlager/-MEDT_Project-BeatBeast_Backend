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

    $sql = "SELECT COUNT(*) FROM favsongs WHERE songId = " . $_GET['songId'] . " AND userId = " . $_SESSION['user']['userId'];

    if ($_res = $conn -> query($sql)) {
        echo "<AiFillHeart size='23px' color='red'/>";
    }

    else {
        echo "<AiOutlineHeart size='23px' color='red'/>"; 
    }

?>