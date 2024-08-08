<?php
include 'header.php';

?>
       <main class="page-content">				
				<h5 class="mb-0 text-uppercase" style="color:#03C988;">[ Song Record ] </h5>
				<hr />
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example2" class="table table-striped table-bordered">
								<thead>
									<tr>
                                        <th>Song Name</th>
										<th>Production</th>
										<th style="background-color:#F9F9E0;">Income</th>
										<th style="background-color:#E3651D;">Payee</th>
										<th style="background-color:#6DB9EF;">Revenue</th>
                                        <th>Date</th>
									</tr>
								</thead>
								<tbody>

                                <?php
$spotifySql = "SELECT songName, original_l2_name, SUM(income) AS profit, MIN(createdAt) AS createdAt
FROM (
    SELECT song_name AS songName, original_l2_name, income, createdAt FROM tiktok_balance 
    UNION ALL
    SELECT song_name AS songName, original_l2_name, income, createdAt FROM spotify_balance
    UNION ALL
    SELECT asset_title AS songName, original_l2_name, income, createdAt FROM youtube_balance
    UNION ALL
    SELECT song_name AS songName, original_l2_name, income, createdAt FROM apple_balance
    UNION ALL
    SELECT song_name AS songName, original_l2_name, income, createdAt FROM amazon_balance
    UNION ALL
    SELECT song_name AS songName, original_l2_name, income, createdAt FROM gaana_balance
    UNION ALL
    SELECT song_name AS songName, original_l2_name, income, createdAt FROM jiosaavn_balance
    UNION ALL
    SELECT song_name AS songName, original_l2_name, income, createdAt FROM resso_balance
    UNION ALL
    SELECT song_name AS songName, original_l2_name, income, createdAt FROM facebook_balance
    UNION ALL
    SELECT songname AS songName, original_l2_name, income, createdAt FROM airtel_balance
    UNION ALL
    SELECT song_name AS songName, original_l2_name, income, createdAt FROM vodafone_balance
    UNION ALL
    SELECT song_name AS songName, original_l2_name, income, createdAt FROM bsnl_balance
) AS all_platforms
WHERE songName IN (
    SELECT song_title
    FROM songs
    WHERE content_isPremium = 'Yes'
)
GROUP BY songName, original_l2_name"; 
$result = $conn->query($spotifySql);

if ($result === FALSE) {
    die("Error in Spotify Balance query: " . $conn->error);
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        $formattedIncome = $row['profit'];
        
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
        <td><?php echo $row['songName']; ?></td>
        <td><?php echo $row['original_l2_name']; ?></td>
        <td style="background-color:#F9F9E0; font-weight:700"><?php echo number_format($distributedAmount, 0); ?></td>
        <td style="background-color:#E3651D; font-weight:700"><?php echo number_format($ProductionIncome, 0);?></td>
        <td style="background-color:#6DB9EF; font-weight:700"><?php echo number_format($OwnerIncome, 0); ?></td>
        <td><?php echo $row['createdAt']; ?></td>
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
       <!--end page main-->


    <?php
    include 'footer.php';
    ?>