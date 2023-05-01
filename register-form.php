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
        $_email = $conn->real_escape_string($_POST['email']);
        $_username = $conn->real_escape_string($_POST['username']);
        $_password = $conn->real_escape_string($_POST['password1']);
        if(strcmp($_password, $conn->real_escape_string($_POST['password2'])) != 0) {
            exit;
        }

        $_password = "saver" . $_password;

        $insertStatement = "INSERT INTO profiles (email, username, password) VALUES ('$_email', '$_username', '".md5($_password)."')";

        if($_res = $conn->query($insertStatement)) {
            header("location: ".htmlentities($_SERVER['PHP_SELF'])."?method=signin");
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

<form method="post">
    <h3>Registrieren</h3>

    <input name="email" type="email" placeholder="Email"
            value="<?php if(isset($eingabe["email"])) echo $eingabe["email"] ?>"> <br>
    <input name="username" type="text" placeholder="Benutzername" 
            value="<?php if(isset($eingabe['username'])) echo $eingabe['username'] ?>"> <br>
    <input name="password1" type="password" placeholder="Passwort">
    <input name="password2" type="password" placeholder="Passwort"> <br>

    <input name="submit" type="submit" value="Registrieren"> 
</form>

<p>Hast du schon einen Account? <a href="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>?method=signin">Anmelden</a></p>