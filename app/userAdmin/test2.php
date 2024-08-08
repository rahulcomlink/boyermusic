<?php
include '../db/connection.php';

// Fetch platform details
$platformListQuery = "SELECT * FROM platforms_name";
$platformResult = $conn->query($platformListQuery);

// Dynamic construction of SUM(CASE ...) statements for platforms
$listArray = array();
if ($platformResult->num_rows > 0) {
    while ($platformRow = $platformResult->fetch_assoc()) {
        $platformName = $platformRow['platforms_name'];
        $listArray[] = "SUM(CASE WHEN platforms_name = '$platformName' THEN song_income ELSE 0 END) AS '$platformName'";
    }
}
$listString = implode(', ', $listArray);

// Construct the main SQL query
$spotifySql = "SELECT 
balance.song_name,
original_l2_name,
$listString,
content_isPremium,
content_premiumAt,
balance_date,
SUM(song_income) AS revenue
FROM 
balance
INNER JOIN 
songs ON songs.song_title = balance.song_name
WHERE 
balance.balance_date BETWEEN songs.content_premiumAt AND balance.balance_date
AND
songs.content_isPremium = 'Yes'
GROUP BY 
balance.song_name, original_l2_name, content_isPremium, content_premiumAt, balance_date;"; 

$result = $conn->query($spotifySql);

if ($result === FALSE) {
    die("Error in Spotify Balance query: " . $conn->error);
}
?>

<table id="example2" class="table table-striped table-bordered">
    <thead style="background:black;color:white;text-align:center;">
        <tr>
            <th>Song Name</th>
            <th>Production Name</th>
            <?php
            // Display platform names as table headers
            $platformResult = $conn->query($platformListQuery);
            if ($platformResult->num_rows > 0) {
                while ($platformRow = $platformResult->fetch_assoc()) {
                    echo '<th><img src="' . $platformRow['platforms_icon'] . '" style="width:20px;"> ' . $platformRow['platforms_name'] . '</th>';
                }
            }
            ?>
            <th>Label 2 Income</th>
            <th>Label 1 Income</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if($row['content_isPremium'] == "Yes"){
                    #FOR VALIDATION & CHECKING
                    $checkDate = $row['content_premiumAt'];
                    $balanceDate = $row['balance_date'];
                    $dateString = date('Y-m-d', strtotime($checkDate));
                    $balanceString = date('Y-m-d', strtotime($balanceDate));

                    $date = new DateTime($dateString);
                    $balance = new DateTime($balanceString);
                    if ($balance >= $date) {
                        echo "<tr style='text-align:center;'>";
                        echo "<td style='font-weight:700;'>" . $row['song_name'] . "</td>";
                        echo "<td style='font-weight:700;'>" . $row['original_l2_name'] . "</td>";

                        $platformResult->data_seek(0); // Reset result pointer
                        while ($platformRow = $platformResult->fetch_assoc()) {
                            $platformName = $platformRow['platforms_name'];
                            $premiumIncome = $row[$platformName];
                            echo "<td style='font-weight:700;'>₹" . number_format($premiumIncome, 2) . "</td>";
                        }
                        $formattedIncome = $row['revenue'];
                        //Payee Calculation
                        $Percent10 = $formattedIncome * 0.10;
                        $distributedAmount = $formattedIncome - $Percent10;
                        //Production Revenue Calculation
                        $ProductionIncome = $distributedAmount * 0.9;
                        //Owner Income Calculation
                        $OwnerIncome = $distributedAmount * 0.1;
                        echo '<td style="font-weight:700;">₹' . number_format($ProductionIncome, 2) . '</td>';
                        echo '<td style="font-weight:700;">₹' . number_format($OwnerIncome, 2) . '</td>';
                        echo '<td style="font-weight:700;">₹' . number_format($row['revenue'], 2) . '</td>';
                    } else {
                        // Do nothing if the balance date is not within the premium date range
                    }
                }
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No results found</td></tr>";
        }
        ?>
    </tbody>
</table>
