<?php 

$host = "localhost";
$username = "root";
$password = "";
$database = "csv_db";

// Connect to server
$connection = mysqli_connect($host, $username, $password, $database);

// Error handling
if (!$connection) die("Database connection failed");

?>