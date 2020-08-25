<?php
require_once 'config.php';
global $conn;
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if(array_key_exists('Registrieren', $_POST)) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT, ['cost' => 15]);
    echo $username;
    echo $password;
    $sql = "INSERT INTO users (USERNAME, PASSWORD, ISADMIN) VALUES ('$username', '$password', false)";
    
    mysqli_query($conn, $sql);
    mysqli_close($conn);
    
}

?>
<html>
<head>
<meta charset="UTF-8">
<title>PastalaVista</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body class="backgroundMain">

	<div>
		<form method="post">
			<input type="text" placeholder="username" name="username">
			<input type="password" placeholder="password" name="password"> 
			<input type="submit" name = "Registrieren" value="Registrieren" >
		</form>
	</div>


</body>
</html>