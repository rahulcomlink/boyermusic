<?php
include '../db/connection.php';

// $platformList = "SELECT * FROM platforms_name";
// $platformResult = $conn->query($platformList);
// $listArray = array(); // Initialize an empty array to hold the list of SUM(CASE ...) statements
// if ($platformResult->num_rows > 0) {
//     while ($platformRow = $platformResult->fetch_assoc()) {
//         $platformName = $platformRow['platforms_name'];
//         // Append the SUM(CASE ...) statement for each platform to the list array
//         $listArray[] = "SUM(CASE WHEN platforms_name = '$platformName' THEN song_income ELSE 0 END) AS '$platformName";
//     }
// }

// $listString = implode(', ', $listArray);



// Construct the SQL query
$spotifySql = "SELECT balance.song_name,
original_l2_name,
content_isPremium,
content_premiumAt,
balance_date,
SUM(song_income) as revenue
FROM balance
INNER JOIN songs ON songs.song_title = balance.song_name
GROUP BY balance.song_name, original_l2_name"; 


// Execute the query
$result = $conn->query($spotifySql);

// Check for errors
if ($result === FALSE) {
    die("Error in Spotify Balance query: " . $conn->error);
}



while($row = $result->fetch_assoc()) {
    if($row['content_isPremium'] == "Yes") {
        $checkDate = $row['content_premiumAt'];
        $isContent = "Yes";
      
        $dateString = date('Y-m-d', strtotime($checkDate));
        #Now Date should be less than the current date#
        $balanceDate = $row['balance_date'];
        
        // Convert date strings to DateTime objects
        $date = DateTime::createFromFormat('Y-m-d', $dateString);
        $balance = DateTime::createFromFormat('Y-m-d', $balanceDate);

        if ($balance >= $date) {
            $balanceSheet = $row['revenue'];
            $totalBalance = $balanceSheet + 100;
            echo $totalBalance;
        } else {
            $balanceSheet = $row['revenue'];
            $totalBalance = $balanceSheet - 100;
            echo $totalBalance;
        }
    }


}



    

?>