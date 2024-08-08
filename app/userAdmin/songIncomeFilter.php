<?php
error_reporting(0);
include 'header.php';
include 'functions.php';

?>
    <main class="page-content">		
       <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
        <div class="row">
            <div class="col-xl-12 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h5 style="font-weight: 900; color:#03C988">[ Filter Balance Data ]</h5>
                        <div class="p-4 border rounded">
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <label class="form-label" for="userDate">Enter Date (YYYY-MM-DD):</label>
                                    <input type="date" class="form-control" name="userDate" id="userDate" placeholder="YYYY-MM-DD" required>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label" for="userDate">..</label><br>
                                    <input type="submit" class="btn btn-warning" value="Search Data">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>		


				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
<?php

#GET USER DATE
$user_date = $_GET['userDate'];

// Dynamic construction of SUM(CASE ...) statements for platforms
$platformList = "SELECT * FROM platforms_name";
$platformResult = $conn->query($platformList);
$listArray = array(); // Initialize an empty array to hold the list of SUM(CASE ...) statements
if ($platformResult->num_rows > 0) {
    while ($platformRow = $platformResult->fetch_assoc()) {
        $platformName = $platformRow['platforms_name'];
        // Append the SUM(CASE ...) statement for each platform to the list array
        $listArray[] = "SUM(CASE WHEN platforms_name = '$platformName' THEN song_income ELSE 0 END) AS '$platformName'";
    }
}
$listString = implode(', ', $listArray);

// Construct the main SQL query
$spotifySql = "SELECT 
song_name,
original_l2_name,
$listString,
SUM(song_income) as revenue 
FROM balance 
WHERE balance_date = '$user_date'
GROUP BY song_name, original_l2_name 
ORDER BY original_l2_name ASC"; 

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
            $platformResult = $conn->query($platformList);
            if ($platformResult->num_rows > 0) {
                while ($platformRow = $platformResult->fetch_assoc()) {
                    echo '<th><img src="' . $platformRow['platforms_icon'] . '" style="width:20px;"> ' . $platformRow['platforms_name'] . '</th>';
                }
            }
            ?>
            <th>Label 2</th>
            <th>Label 1</th>
            <th>Total</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr style='text-align:center;'>";
                echo "<td style='font-weight:700;'>" . $row['song_name'] . "</td>";
                echo "<td style='font-weight:700;'>" . $row['original_l2_name'] . "</td>";

                // Display revenue for each platform
                $platformResult = $conn->query($platformList);
                if ($platformResult->num_rows > 0) {
                    while ($platformRow = $platformResult->fetch_assoc()) {
                        $platformName = $platformRow['platforms_name'];
                        // Display revenue for each platform
                        echo "<td style='font-weight:700;'>";
                        echo "₹" . number_format($row[$platformName], 2) ;
                        echo "</td>";
                    }
                }
                $formattedIncome = $row['revenue'];
                //$incomeAsFloat = floatval($formattedIncome);  // Convert formatted income back to float
                //Payee Calculation
                $Percent10 = $formattedIncome * 0.10;
                $distributedAmount = $formattedIncome - $Percent10;
                //Production Revenue Calculation
                $ProductionIncome = $distributedAmount * 0.6;
                //Owner Income Calculation
                $OwnerIncome = $distributedAmount * 0.4;
                echo '<td style="font-weight:700;">₹' . number_format($ProductionIncome, 2) . '</td>';
                echo '<td style="font-weight:700;">₹' . number_format($OwnerIncome, 2) . '</td>';
                echo '<td style="font-weight:700;">₹' . number_format($row['revenue'], 2) . '</td>';
                echo '<td style="font-weight:700;">'.$user_date.'</td>';
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No results found</td></tr>";
        }
        ?>
    </tbody>
</table>

						</div>
					</div>
				</div>
			</main>
       <!--end page main-->


    <?php
    include 'footer.php';
    ?>