<?php require_once '../logic/member_logic.php';?>
<html>
<head>
<meta charset="UTF-8">
<title>PastalaVista</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="events.js"></script>
<link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body class="backgroundMain">

	<div class = "center">
		<h1>Pasta reservieren</h1>
		<p>Waehle einen Tag an dem du Pasta essen willst (maximal 10 Tage im voraus, eine Bestellung muss bis am Vortag 16:00 abgegeben werden)</p>
		<form method="post">
			<?php
                $currentTime = date("H");
                if ($currentTime < 16) {
                    $min = date("Y-m-d", time() + 86400);
                } else {
                    $min = date("Y-m-d", time() + 172800);
                }
                $max = date("Y-m-d", time() + 864000);
                echo '<input type="date" name="pasta-date" value="' . $min . '" min="' . $min . '" max="' . $max . '">';
            ?>
			<br>
			<input type="submit" name="order" value="Bestellen"> 
			<br>
			<input type="submit" name="logout" value="Abmelden">
		</form>
	</div>

</body>
</html>