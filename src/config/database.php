<?php

$host = "localhost"; // Your MySQL host
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$database = "recipedb"; // Your MySQL database name

// Create a connection to the database
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>