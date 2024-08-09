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

<?php
$userDate = $_GET['userDate']; // Expected format: YYYY-MM

// Calculate the first and last day of the selected month
$startOfMonth = date('Y-m-01', strtotime($userDate));
$endOfMonth = date('Y-m-t', strtotime($userDate));







$platformSql = "SELECT DISTINCT platforms_name FROM platforms_name";
$platformResult = $conn->query($platformSql);

$platforms = [];
if ($platformResult && $platformResult->num_rows > 0) {
    while ($row = $platformResult->fetch_assoc()) {
        $platforms[] = $row['platforms_name'];
    }
}
$platformColumns = [];
foreach ($platforms as $platform) {
    $platformColumns[] = "SUM(CASE WHEN balance.platforms_name = '$platform' THEN balance.song_income ELSE 0 END) AS `" . $platform . "_Revenue`";
}

$platformColumnsSql = implode(', ', $platformColumns);

$spotifySql = "SELECT 
    balance.original_l2_name,
    balance.song_name,
    songs.song_title,
    $platformColumnsSql,
    SUM(balance.song_income) AS Total_Revenue
FROM 
    balance
INNER JOIN 
    songs ON songs.song_isrc = balance.song_isrc
WHERE
    (
        (songs.content_isPremium = 'Yes' AND balance.balance_date < songs.content_premiumAt)
        OR songs.content_isPremium = 'No'
    )
    AND balance.balance_date BETWEEN '$startOfMonth' AND '$endOfMonth'
GROUP BY 
    balance.original_l2_name, 
    balance.song_name, 
    songs.song_title;";

 






?>

<thead>
<tr style="background:#263544;color:white;text-align:center;">
<th>Song Title</th>
        <th>Production Name</th>
        <?php foreach ($platforms as $platform): ?>
            <th><?php echo htmlspecialchars($platform); ?></th>
        <?php endforeach; ?>
        <th>Total Revenue</th>
        <th>Month</th>
    </tr>
</thead>
<tbody>
<?php
$spotifyResult = $conn->query($spotifySql);
if (!$spotifyResult) {
    die("Error in SQL query: " . $conn->error);
}

if ($spotifyResult->num_rows > 0) {
    while ($row = $spotifyResult->fetch_assoc()) {
        // Payee Calculation
        $totalIncome = $row['Total_Revenue'];
        $Percent10 = $totalIncome * 0.10;
        $distributedAmount = $totalIncome - $Percent10;
        // Production Revenue Calculation
        $ProductionIncome = $distributedAmount * 0.4;
        // Owner Income Calculation
        $OwnerIncome = $distributedAmount * 0.6;
?>

    <tr>
        <td><?php echo htmlspecialchars($row['song_title']); ?></td>
        <td><?php echo htmlspecialchars($row['original_l2_name']); ?></td>
        <?php foreach ($platforms as $platform): ?>
            <?php
            // Retrieve platform revenue
            $platformRevenue = $row[$platform . '_Revenue'];
            // Deduct 10%
            $deductedAmount = $platformRevenue * 0.10;
            $distributedAmountX = $platformRevenue - $deductedAmount;

            // Calculate production and owner income (optional if you need these calculations for other purposes)
            $productionIncomex = $distributedAmountX * 0.40; // 40% for production
            $ownerIncomex = $distributedAmountX * 0.60; // 60% for owner

            ?>
            <td><?php echo number_format($productionIncomex, 0); ?></td> <!-- Display adjusted revenue -->
        <?php endforeach; ?>
        <td style="background-color:#06D001; font-weight:700"><?php echo number_format($ProductionIncome, 0); ?></td>
        <td style="text-align:center;">
            <?php
            $timestamp = strtotime($userDate . '-01'); // Convert to Unix timestamp
            $formattedDate = date('F, Y', $timestamp); // Format as "October, 2023"
            echo htmlspecialchars($formattedDate);
            ?>
        </td>
    </tr>

<?php
    }
} else {
    echo "<tr><td colspan='" . (count($platforms) + 4) . "'>No results found</td></tr>";
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
