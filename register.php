<html>
<head>
<meta charset="UTF-8">
<title>PastalaVista</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body class="backgroundMain">
	<div class = "topnav">
		<a href="index.php">Home</a>
		<a href="login.php">Anmelden</a>
		<a class="active" href="register.php">Registrieren</a>
	</div>
	<div class = "center">
		<form method="post">
			<input type="text" placeholder="Username" name="username">
			<br>
			<input type="password" placeholder="Passwort" name="password"> 
			<br>
			<input type="submit" name = "Registrieren" value="Registrieren" >
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
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if(array_key_exists('Registrieren', $_POST)) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql_check_username = "SELECT * FROM users WHERE username = '$username'"; 
    $existing_entrys = mysqli_query($conn, $sql_check_username);
    $checkCount = mysqli_fetch_all($existing_entrys);
    if (!count($checkCount) > 0) {
        if ($username !== ""|| $password !=="") {
            $password_hashed = password_hash($password, PASSWORD_DEFAULT, ['cost' => 15]);
            $sql_login = "INSERT INTO users (USERNAME, PASSWORD, ISADMIN) VALUES ('$username', '$password_hashed', false)";
            mysqli_query($conn, $sql_login);
            header("location: index.php");
        }
        else{
            echo "<p> Username oder Passwort leer, bitte wiederholen </p>";
        }
    }
    else{
        echo "<p> Username bereits vergeben </p>";
    }
    
    
    mysqli_close($conn);
    
}

?>