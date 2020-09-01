<?php
require_once 'config.php';
global $conn;
if (! $conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (array_key_exists('Registrieren', $_POST)) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_conf'];
    $sql_check_username = "SELECT * FROM users WHERE username = '$username'";
    $existing_entrys = mysqli_query($conn, $sql_check_username);
    $checkCount = mysqli_fetch_all($existing_entrys);
    if (! count($checkCount) > 0) {
        if (trim($_POST['username']) !== "" && trim($_POST['password']) !== "") {
            if ($password === $password_confirm) {
                $password_hashed = password_hash($password, PASSWORD_DEFAULT, ['cost' => 15]);
                $sql_login = "INSERT INTO users (USERNAME, PASSWORD, ISADMIN) VALUES ('$username', '$password_hashed', false)";
                mysqli_query($conn, $sql_login);
                echo "<div class = \"center success\"><p>User wurde erstellt</p></div><br>";
            } else {
                echo "<div class = \"center error\"><p> Passw&#246;rter stimmen nicht &#252;berein </p></div> <br>";
            }
        }
    } else {
        echo "<div class = \"center error\"><p> Username oder Passwort leer, bitte wiederholen </p></div> <br>";
    }
} else {
    echo "<div class = \"center error\"  ><p> Username bereits vergeben </p></div> <br>";
}

mysqli_close($conn);
?>