<?php require_once '../logic/login_logic.php';?>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>PastalaVista</title>
<link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body class="backgroundMain">
	
	<?php
require_once 'navbar.php';
showNavbar("login")?>
	<div class="center">
		<form method="post">
			<input type="text" placeholder="Username" name="username"> 
			<br> 
			<input type="password" placeholder="Passwort" name="password"> 
			<br> 
			<input type="submit" name="login" value="Anmelden">
		</form>
	</div>
	<?php
require_once 'logo_footer.php';
?>

</body>
</html>
