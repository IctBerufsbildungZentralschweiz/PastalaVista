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
showNavbar("login")?>
	<div class="center">
		<form method="post">
			<input type="text" placeholder="username" name="username"> 
			<br> 
			<input type="password" placeholder="password" name="password"> 
			<br> 
			<input type="submit" name="login" value="Anmelden">

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
if (! $conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if (array_key_exists('login', $_POST)) {
    if (trim($_POST['username']) === "" || trim($_POST['password']) === "") {
        echo "<div class = \"center\" id=\"error\"><p>Username oder Passwort leer, bitte wiederholen</p></div>";
    } else {
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
            }
            header('Location: member.php');
        } else {
            echo "<div class = \"center\" id=\"error\"><p>Falsches Passwort</p></div>";
        }
    }
}

?>