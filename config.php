<?php

$servername = "cloudcomputing.crghsm7cx5ro.us-east-1.rds.amazonaws.com";
$port = 3306;
$database = "cloudcomputing";
$username = "root";
$password = "Trung123";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database, $port);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>