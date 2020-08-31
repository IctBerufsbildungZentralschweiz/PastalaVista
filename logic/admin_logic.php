<?php
require_once 'config.php';
global $conn;
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

session_start();
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