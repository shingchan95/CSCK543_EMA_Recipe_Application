<?php

// MySQL details with fallbacks for unset values
$host = getenv("DB_HOST") ?: "127.0.0.1";
$username = getenv("DB_USER") ?: "root";
$password = getenv("DB_PASSWORD") ?: "waterpolo";
$database = "recipe";
$port = 3306; // Do not pass a port argument if you are not running your own MYSQL server apart from XAMPP

// Create a connection to the database
$conn = new mysqli($host, $username, $password, $database, $port);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>