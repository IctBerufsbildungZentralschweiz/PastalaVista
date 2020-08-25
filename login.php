<?php
require_once 'config.php';
global $conn;
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if(array_key_exists('login', $_POST)) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT Password FROM users WHERE Username = '$username'";
    $db_password = mysqli_query($conn, $sql);
    $result = mysqli_fetch_row($db_password);
    $password_ok = password_verify($password, $result[0]);
    if ($password_ok) {
        header('Location: member.php');
    }
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
			<input type="submit" name="login" value="Anmelden">

		</form>
	</div>


</body>
</html>