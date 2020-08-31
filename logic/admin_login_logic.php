<?php
require_once 'config.php';
global $conn;
if (! $conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if (array_key_exists('login', $_POST)) {
    $username = $_POST['username'];
    $password_hashed = $_POST['password'];
    $sql_login = "SELECT Password FROM users WHERE Username = '$username'";
    $sql_id = "SELECT User_ID FROM users WHERE Username = '$username'";
    $sql_admin = "SELECT IsAdmin as checkAdm FROM users WHERE Username = '$username'";
    $db_password = mysqli_query($conn, $sql_login);
    $db_id = mysqli_query($conn, $sql_id);
    $db_admin = mysqli_query($conn, $sql_admin);
    $password_result = mysqli_fetch_row($db_password);
    $id_result = mysqli_fetch_row($db_id);
    $admin_result = mysqli_fetch_row($db_admin);
    $password_ok = password_verify($password_hashed, $password_result[0]);
    if ($password_ok) {
        if (! isset($_SESSION)) {
            session_start();
            $_SESSION['usr'] = $username;
            $_SESSION['id'] = $id_result;
            $_SESSION['isadmin'] = $admin_result[0];
        }
        header('Location: admin.php');
    }
    else{
        echo "<p>Passwort Falsch</p>";
    }
    mysqli_close($conn);
}

?>