<?php
    require_once '../logic/admin_logic.php';
?>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>PastalaVista</title>
<link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body class="backgroundMain">

	<div>
		<form method="post">
			<input type="text" placeholder="username" name="username"> 
			<br>
			<input type="password" placeholder="password" name="password"> 
			<br>
			<input type="submit" name="login" value="Anmelden">

		</form>
	</div>


</body>
</html>
