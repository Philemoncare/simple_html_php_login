<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "prestige_lab";

// Connect to MySQL server without selecting a database first
$conn = mysqli_connect($host, $user, $password);

if(!$conn){
    die("Connection Failed: " . mysqli_connect_error());
}

// Ensure the database exists
$sql_db = "CREATE DATABASE IF NOT EXISTS `$database`";
mysqli_query($conn, $sql_db);

// Select the database
mysqli_select_db($conn, $database);

// Ensure the users table exists
$sql_table = "
CREATE TABLE IF NOT EXISTS `users` (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `fullname` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `username` VARCHAR(100) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
mysqli_query($conn, $sql_table);
?>
