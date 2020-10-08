<?php 

$host = "localhost";
$username = "root";
$password = "";
$database = "csv_db";

$connection = mysqli_connect($host, $username, $password, $database);
    
if (!$connection) die("Database connection failed");

?>