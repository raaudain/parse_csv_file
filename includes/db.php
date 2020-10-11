<?php 

$host = "localhost";
$username = "root";
$password = "";

// Create connection
$connection = mysqli_connect($host, $username, $password);

// Error handling
if (!$connection) die("Connection failed: " . mysqli_error($connection));

// Create database
$database = "CREATE DATABASE IF NOT EXISTS csv_db";

$data = mysqli_query($connection, $database);

if (!$data) die("Error creating database: " . mysqli_error($connection));

?>