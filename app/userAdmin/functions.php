<?php

function platFormTable($conn){    
    $query = "SELECT * FROM platforms_name";
    $result = $conn->query($query);
    
    if (!$result) {
        die("Error in SQL query: " . $conn->error);
    }
    $platformNameList = array();
    while ($row = $result->fetch_assoc()) {
        // Assuming 'platforms_name' and 'platforms_icon' are the columns in your database table
        $platform_name = $row['platforms_name'];
        $platforms_icon = $row['platforms_icon'];

        // Generating HTML for table row
        $platformNameList[] = '<th><img src="../userAdmin/' . htmlspecialchars($platforms_icon) . '" style="width:20px;"> ' . htmlspecialchars($platform_name) . '</th>';
    }
    return $platformNameList;
}



function allPlatformList($conn){    
    $query = "SELECT * FROM platforms_name";
    $result = $conn->query($query);
    
    if (!$result) {
        die("Error in SQL query: " . $conn->error);
    }
    $platformNameList = array();
    while ($row = $result->fetch_assoc()) {
        // Assuming 'platforms_name' is the column in your database table
        $platform_name = $row['platforms_name'];
        $platformNameList[] = '<option value="' . htmlspecialchars($platform_name) . '">' . htmlspecialchars($platform_name) . '</option>';
    }
    return $platformNameList;
}



function generateRandomString($length = 8) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}


function generateUniqueId($length = 8) {
    $characters = '0123456789';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}


function formatDateWithOrdinal($date) {
    // Create DateTime object from the input date string
    $dateTime = new DateTime($date);

    // Format day with ordinal suffix
    $day = $dateTime->format('j'); // Day without leading zeros
    $dayWithSuffix = $day . getOrdinalSuffix($day);

    // Format and return the final date string
    return $dayWithSuffix . ' ' . $dateTime->format('F, Y');
}

function getOrdinalSuffix($day) {
    if (!in_array(($day % 100), array(11, 12, 13))) {
        switch ($day % 10) {
            case 1:  return 'st';
            case 2:  return 'nd';
            case 3:  return 'rd';
        }
    }
    return 'th';
}

?>
