<?php
include 'db_balance.php';
?>


<?php
include 'header.php';
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
                                    <label class="form-label custom-font">Select Platform</label>
                                    <select class="single-select" id="platform" name="platform_name" required>
                                        <?php
                                        $platformNameList = allPlatformList($conn);
                                        foreach ($platformNameList as $option) {
                                            echo $option;
                                        }
                                        ?>
                                    </select>
                                </div>
                                
                            

                                <div class="col-md-3">
    <label class="form-label" for="userMonth">Enter Month (YYYY-MM):</label>
    <input type="month" class="form-control" name="userDate" id="userDate" placeholder="YYYY-MM" required>
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
							<table id="example2" class="table table-striped table-bordered">
								<thead>
                                <tr style="background:#263544;color:white;text-align:center;">
                                        <th>Platform</th>
                                        <th>Song Title</th>
                                        <th>Production Name</th>
										<th style="background-color:#06D001;">Revenue</th>
                                        <th>Month</th>
									</tr>
								</thead>
								<tbody>

<?php

$platformName = $_GET['platform_name'];

$userDate = $_GET['userDate']; // Expected format: YYYY-MM

// Calculate the first and last day of the selected month
$startOfMonth = date('Y-m-01', strtotime($userDate));
$endOfMonth = date('Y-m-t', strtotime($userDate));

$spotifySql = "SELECT 
    balance.original_l2_name,
    balance.platforms_name,
    songs.song_title,
    songs.content_isPremium,
    songs.content_premiumAt,
    balance.balance_date,
    SUM(balance.song_income) AS revenue
FROM 
    balance
INNER JOIN 
    songs ON songs.song_isrc = balance.song_isrc
WHERE
    balance.platforms_name = '$platformName'
    AND balance.balance_date >= songs.content_premiumAt
    AND songs.content_isPremium = 'Yes'
    AND balance.balance_date BETWEEN '$startOfMonth' AND '$endOfMonth'
    AND songs.content_createdBy = '$productionCode'
GROUP BY 
    balance.original_l2_name, balance.platforms_name, songs.song_title, songs.content_isPremium, songs.content_premiumAt, balance.balance_date;";

$spotifyResult = $conn->query($spotifySql);
if (!$spotifyResult) {
    die("Error in SQL query: " . $conn->error);
}

if ($spotifyResult->num_rows > 0) {
    while ($row = $spotifyResult->fetch_assoc()) {
        $formattedIncome = $row['revenue'];
        //$incomeAsFloat = floatval($formattedIncome);  // Convert formatted income back to float
        //Payee Calculation
        $Percent10 = $formattedIncome * 0.10;
        $distributedAmount = $formattedIncome - $Percent10;
        //Production Revenue Calculation
        $ProductionIncome = $distributedAmount * 0.9;
        //Owner Income Calculation
        $OwnerIncome = $distributedAmount * 0.1;
?>

    <tr>
        <td><?php echo $row['platforms_name']; ?></td>
        <td><?php echo $row['song_title']; ?></td>
        <td><?php echo $row['original_l2_name']; ?></td>
        <td style="background-color:#06D001; font-weight:700;text-align:center;"><?php echo number_format($ProductionIncome, 0);?></td>
        <td style="text-align:center;">
            <?php
            $timestamp = strtotime($row['balance_date']); // Convert to Unix timestamp
            $formattedDate = date('F, Y', $timestamp); // Format as "October, 2023"
            echo $formattedDate;
            ?>
        </td>
    </tr>

<?php
    }
} else {
    echo "No results found";
}
?>


									
									
								</tbody>
							</table>
						</div>
					</div>
				</div>
</main>

<?php
include 'footer.php';
?>
