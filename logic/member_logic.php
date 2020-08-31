<?php
require_once 'config.php';
global $conn;

if (! $conn) {
    die("Connection failed: " . mysqli_connect_error());
}
session_start();
if (! isset($_SESSION['usr']) && ! isset($_SESSION['id'])) {
    header('Location: index.php');
}

function order($conn)
{
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
if (isset($_POST['logout'])) {
    logout($conn);
    header('Location: index.php');
}

function reserved($date)
{
    $date = date("d.m.Y", strtotime($_POST['pasta-date']));
    echo "<div class = \"center success\"><p>Pasta fuer den " . $date . " wurde reserviert. Vielen Dank</p></div>";
}

function blocked($reason)
{
    echo "<div class = \"center error\"><p>Diese Aktion ist fuer dich gesperrt. Grund: " . $reason . "</p></div>";
}

?>