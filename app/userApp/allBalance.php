<?php
include 'header.php';

?>
       <main class="page-content">				
				<h5 class="mb-0 text-uppercase" style="color:#03C988;">[ All Balance Record ] </h5>
				<hr />
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example2" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>Production</th>
										<th style="background-color:#F9F9E0;">Total Income</th>
                                        <th style="background-color:#F9F9E0;">Tax Amount</th>
										<th style="background-color:#E3651D;">Payee</th>
										<th style="background-color:#6DB9EF;">Revenue</th>
                                        <th>Date</th>
									</tr>
								</thead>
								<tbody>

<?php
$spotifySql = "SELECT song_name, original_l2_name, SUM(song_income) AS profit,  MIN(balance_date) AS createdAt, platforms_name
FROM balance GROUP BY original_l2_name"; 
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
        $ProductionIncome = $distributedAmount * 0.4;
        //Owner Income Calculation
        $OwnerIncome = $distributedAmount * 0.6;
?>

    <tr>
        <td><?php echo $row['original_l2_name']; ?></td>
        <td style="background-color:#F9F9E0; font-weight:700"><?php echo number_format($formattedIncome, 0); ?></td>
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