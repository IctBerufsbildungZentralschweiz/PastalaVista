<?php

$servername = "localhost";
$database = "pastalavista";
$username = "root";
$password = "";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$name = $_POST['Username'];
$password = password_hash($_POST['Password'], PASSWORD_DEFAULT);

$sql = "INSERT INTO users(Username, Password, IsAdmin) VALUES ('$name', '$password' false)";
if (mysqli_query($conn, $sql)) {
    echo "New record has been added successfully !";
} else {
    echo "Error: " . $sql . ":-" . mysqli_error($conn);
}
mysqli_close($conn);

?>