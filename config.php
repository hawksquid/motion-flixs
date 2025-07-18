<?php
$servername = "localhost";
$username = "root";
$password = ""; // Change if your MySQL root user has a password
$database = "movies";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
