<?php
include '../db/connection.php';
$query = "SELECT * FROM user_details";
$result = $conn->query($query);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        echo $row['user_name']; 
        // Process each row of data
    }
    $result->free(); // Free the result set
} else {
    echo "Error: " . $conn->error;
}

?>