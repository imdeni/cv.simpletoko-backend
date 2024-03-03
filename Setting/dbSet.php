<?php
// Connect to the database
$host = "localhost";
$user = "root";
$password = "";
$dbname = 'florist';

$conn = mysqli_connect($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed " . $conn->connect_error);
}
?>