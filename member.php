<?php
require_once 'config.php';
global $conn;

if (! $conn) {
    die("Connection failed: " . mysqli_connect_error());
}
session_start();
if (!isset($_SESSION['usr']) && !isset($_SESSION['id'])) {
    header('Location: index.php');
}

function order($conn) {
    $date = $_POST['pasta-date'];
    $ids = $_SESSION['id'];
    foreach ($ids as $id) {
        $sql_check_exists = "SELECT * FROM pasta_reservation WHERE ID_User = $id AND Reservation_Date = '$date'";
        $existing_entrys = mysqli_query($conn, $sql_check_exists);
        $checkCount = mysqli_fetch_all($existing_entrys);
        $weekday = date('N', strtotime($date));
        if (count($checkCount) > 0) {
            blocked("Du hast an diesem Datum bereits reserviert");
        } elseif ($weekday == 6 || $weekday == 7) {
            blocked("Dieses Datum ist an einem Wochenende");
        } else {
            $sql_order = "INSERT INTO pasta_reservation(ID_User, Reservation_Date) VALUES ($id, '$date')";
            mysqli_query($conn, $sql_order);
            reserved($date);
        }
    }
}



if (isset($_POST['order'])) {
    order($conn);
}
if (isset($_POST['logout'])){
    logout($conn);
    header('Location: index.php');
}

?>

<html>
<head>
<meta charset="UTF-8">
<title>PastalaVista</title>
<script src="events.js"></script>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body class="backgroundMain">

	<div>
		<h1>Pasta reservieren</h1>
		<p>Waehle einen Tag an dem du Pasta essen willst (maximal 10 Tage im voraus, Eine Bestellung muss bis am Vortag 16:00 abgegeben werden)</p>
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
		<?php

        function reserved($date)
        {
            echo "<p>Pasta fuer den " . $date . " wurde reserviert. Vielen Dank</p>";
        }

        function blocked($reason)
        {
            echo "<p>Diese Aktion ist fuer dich gesperrt. Grund: " . $reason . "</p>";
        }
?>
	</div>

</body>
</html>