<?php
    $_db_host = "localhost";
    $_db_datenbank = "foodaholic";
    $_db_username = "foodaholic";
    $_db_passwort = "foodaholic";

    session_start();

    $conn = new mysqli($_db_host, $_db_username, $_db_passwort, $_db_datenbank);

    if($conn->connect_error) {
        die("Connection failed: " .$conn->connect_error);
    }

    if(!empty($_POST['submit'])) {
        $_username = $conn->real_escape_string($_POST['username']);
        $_password = $conn->real_escape_string($_POST['password']);
       
        $_password = "saver" . $_password;

        $_sql = "SELECT * FROM profiles WHERE username='$_username' AND password='".md5($_password)."'";
        
        if($_res = $conn->query($_sql)) {
            if($_res->num_rows > 0) {
                $_SESSION["login"] = 1;
                $_SESSION["user"] = $_res->fetch_assoc();
                header("location: ".htmlentities($_SERVER['PHP_SELF'])."./../../feed.php");
            } else {
                header("location: ".htmlentities($_SERVER['PHP_SELF'])."?method=signin");
                exit;
            }

            $_res->close();
        }
    }

    $conn->close();
?>

<form method="post">
    <h3>Anmelden</h3>

    <input name="username" type="text" placeholder="Benutzername" 
            value="<?php if(isset($eingabe['username'])) echo $eingabe['username'] ?>"> <br>
    <input name="password" type="password" placeholder="Passwort"
            value="<?php if(isset($eingabe['password'])) echo $eingabe['password'] ?>"> <br>

    <input name="submit" type="submit" value="Anmelden"> 
</form>

<p style="font-size: 12px">Hast du noch keinen Account? <a href="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>?method=signup">Registrieren</a></p>