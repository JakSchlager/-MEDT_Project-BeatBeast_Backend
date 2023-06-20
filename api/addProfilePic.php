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

    if(isset($_POST['submit'])) {
        $_email = $conn->real_escape_string($_POST['updateEmail']);
        $_username = $conn->real_escape_string($_POST['updateUsername']);
        $_password = $conn->real_escape_string($_POST['password']);
        $_phoneNr = $conn->real_escape_string($_POST['updatedPhoneNr']);

        $_password = "saver" . $_password;
        $_profilePic = "";
        $valid = true;
        var_dump($_FILES);
        if(isset($_FILES['profilePicture']['name'])) {
            echo "ijasdjibasdob";
            $target_dir = "./uploads";
            $target_file = $targetdir ."/profilePic".".jpg";
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            // Check if image file is a actual image or fake image

            $check = getimagesize($_FILES["profilePicture"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "<h1>File is not an image.</h1>";
                $uploadOk = 0;
                $valid = false;
            }
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                echo "<h1>Sorry, only JPG, JPEG, PNG files are allowed.</h1>";
                $uploadOk = 0;
                $valid = false;
            }

            if (move_uploaded_file($_FILES["profilePicture"]["tmp_name"], $target_file)) {
                echo "<h1>The file ". basename( $_FILES["profilePicture"]["name"]). " has beenuploaded.</h1>";
                $_profilePic = $target_file;
            }
        } 
        
        else {
            $_profilePic = "./img/profilepic.png";
        }

        if($valid) {
            $insertStatement = "UPDATE profiles SET username=$_username, email=$_email, password=$_password, profilePic=$_profilePic"; 
        }

        if($_res = $conn->query($insertStatement)) {
            header("location: http://localhost:5173/home");
        } else {
            $eingabe = array();
            $error = array();

            if(isset($_POST['email'])) {
                $eingabe['email'] = $_POST['email'];
            } else {
                $error['email'] = "Email existiert schon.";
            }

            if(isset($_POST['username'])) {
                $eingabe['username'] = $_POST['username'];
            } else {
                $error['username'] = 'Benutzername existirt nicht';
            }

            if(isset($_POST['password'])) {
                $eingabe['password'] = $_POST['password'];
            } else {
                $error['password'] = 'Passwort nicht korrekt';
            }
        }
    }

?>