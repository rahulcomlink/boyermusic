<?php
$hostname = "localhost";  // Change this to your MySQL server hostname
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password
$database = "music_app"; // Change this to your MySQL database name

// Create connection
$conn = new mysqli($hostname, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully";
    // You can perform database operations here
}

// Close connection (recommended when you're done with database operations)
?>
