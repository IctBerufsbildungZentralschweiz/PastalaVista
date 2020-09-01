<?php require_once '../logic/admin_logic.php';?>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>PastalaVista</title>
<link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body class="backgroundMain">

	<div>
		<h1>Admin bereich</h1>
		<h2>Morgen:</h2>
		<?php
		  echo "<p>F&#252;r morgen haben sich bis jetzt ". getTomorrowsOrders() ." Leute eingetragen </p>"
		?>
		<h2>Anderes Datum:</h2>
		<form method="post">
			<?php
                $min = date("Y-m-d", time() + 172800);
                echo '<input type="date" name="pasta-date" value="' . $min . '" min="' . $min . '">';
                
            ?>
            <br>
            <input type="submit" name="request" value="Abfragen">
		</form>
		<form method = "post" >
			<input type="submit" name="logout" value="Abmelden">
		</form>
	</div>

</body>
</html>
