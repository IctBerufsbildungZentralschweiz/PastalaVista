<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>PastalaVista</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body class="backgroundMain">
	<?php 
	   require_once 'navbar.php';
	   showNavbar("register");
    ?>
	<div class = "center">
		<form method="post">
			<input type="text" placeholder="Username" name="username">
			<br>
			<input type="password" placeholder="Passwort" name="password"> 
			<br>
			<input type="submit" name = "Registrieren" value="Registrieren" >
		</form>
	</div>

	<?php 
	   require_once 'logo_footer.php';
	?>

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
        if (trim($username) !== ""|| trim($password !=="")) {
            $password_hashed = password_hash($password, PASSWORD_DEFAULT, ['cost' => 15]);
            $sql_login = "INSERT INTO users (USERNAME, PASSWORD, ISADMIN) VALUES ('$username', '$password_hashed', false)";
            mysqli_query($conn, $sql_login);
            header("location: index.php");
        }
        else{
            echo "<div class = \"center\" id = \"error\"><p> Username oder Passwort leer, bitte wiederholen </p></div>";
        }
    }
    else{
        echo "<div class = \"center\" id = \"error\" ><p> Username bereits vergeben </p></id>";
    }
    
    
    mysqli_close($conn);
    
}
?>