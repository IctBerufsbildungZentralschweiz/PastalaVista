<html>
<head>
<meta charset="UTF-8">
<title>PastalaVista</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body class="backgroundMain">
	
	<div class = "topnav">
		<a href="index.php">Home</a>
		<a class="active" href="login.php">Anmelden</a>
		<a href="register.php">Registrieren</a>
	</div>
	<div class = "center">
		<form method="post">
			<input type="text" placeholder="username" name="username">
			<br> 
			<input type="password" placeholder="password" name="password"> 
			<br>
			<input type="submit" name="login" value="Anmelden">

		</form>
	</div>
	<div>
		<img alt="Logo" src="img/logo_large.png" class = "logo">
	</div>


</body>
</html>
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
    $db_password = mysqli_query($conn, $sql_login);
    $db_id = mysqli_query($conn, $sql_id);
    $password_result = mysqli_fetch_row($db_password);
    $id_result = mysqli_fetch_row($db_id);
    $password_ok = password_verify($password_hashed, $password_result[0]);
    if ($password_ok) {
        if (! isset($_SESSION)) {
            session_start();
            $_SESSION['usr'] = $username;
            $_SESSION['id'] = $id_result;
            //mysqli_close($conn);
        }
        header('Location: member.php');
    }
    else{
        echo "<p>Passwort Falsch</p>";
    }
    //mysqli_close($conn);
}

?>