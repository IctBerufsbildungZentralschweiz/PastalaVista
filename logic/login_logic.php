<?php
require_once 'config.php';
global $conn;
if (! $conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if (array_key_exists('login', $_POST)) {
    if (trim($_POST['username']) === "" || trim($_POST['password']) === "") {
        echo "<div class = \"center\" id=\"error\"><p>Username oder Passwort leer, bitte wiederholen</p></div> <br>";
    } else {
        $username = $_POST['username'];
        $password_hashed = $_POST['password'];
        $sql_login = "SELECT Password FROM users WHERE Username = '$username'";
        $sql_id = "SELECT User_ID FROM users WHERE Username = '$username'";

        $db_password = mysqli_query($conn, $sql_login);
        $db_id = mysqli_query($conn, $sql_id);
        
        $password_result = mysqli_fetch_row($db_password);
        $id_result = mysqli_fetch_row($db_id);
        if(isset($id_result)&& isset($password_result)) {
            $password_ok = password_verify($password_hashed, $password_result[0]);
            if ($password_ok) {
                if (! isset($_SESSION)) {
                    session_start();
                    $_SESSION['usr'] = $username;
                    $_SESSION['id'] = $id_result;
                }
                header('Location: member.php');
            } else {
                echo "<div class = \"center\" id=\"error\"><p>Passwort falsch</p></div> <br>";
            }
        } else {
            echo "<div class = \"center\" id=\"error\"><p>User existiert nicht</p></div> <br>";
        }
    }
}
?>