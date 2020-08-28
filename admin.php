<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>PastalaVista</title>
<link rel="stylesheet" type="text/css" href="style.css">
<script src="events.js"></script>
</head>
<body class="backgroundMain">

	<div>
		<h1>Admin bereich</h1>
		<h2>Morgen:</h2>
		<?php
		  echo "<p>Fuer morgen haben sich bis jetzt ". getTomorrowsOrders() ." Leute eingetragen </p>"
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
<?php
require_once 'config.php';
global $conn;
if (! $conn) {
    die("Connection failed: " . mysqli_connect_error());
}

session_start();
//!isset($_SESSION['isadmin'])
if (!isset($_SESSION['usr']) || !isset($_SESSION['id']) || $_SESSION['isadmin'] != 1) {
    header('Location: index.php');
}

    function getTomorrowsOrders() {
        global $conn;
        $sql_get_num = "SELECT COUNT(Reservation_ID) AS count FROM pasta_reservation WHERE Reservation_Date = CURDATE() + INTERVAL 1 DAY";
        $result = mysqli_query($conn, $sql_get_num);
        $row = mysqli_fetch_array($result); 
        return $row['count'];
        
        
    }
    
    function getSpecificOrders(){
        global $conn;
        $date = $_POST['pasta-date'];
        $sql_get_num = "SELECT COUNT(Reservation_ID) AS count FROM pasta_reservation WHERE Reservation_Date = '". $date ."'";
        $result = mysqli_query($conn, $sql_get_num);
        $row = mysqli_fetch_array($result);
        return $row['count'];
    }
    
    if(isset($_POST['logout'])) {
        logout($conn);
        header('Location: index.php')
        ;
    } 
    if (isset($_POST['request'])) {
        $date = date("d.m.Y", strtotime($_POST['pasta-date']));
        echo "<p> Fuer den ".$date."  haben sich bisher ". getSpecificOrders() ." Leute eingetragen </p>";
    }
?>