<?php
include 'header.php';

?>
       <main class="page-content">				
				<h5 class="mb-0 text-uppercase" style="color:#03C988;">[ Unverified Song List ] </h5>
				<hr />
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example2" class="table table-striped table-bordered">
								<thead>
									<tr>
                                        <th>Song Name</th>
										<th>Production Name</th>
										<th style="background-color:#F9F9E0;">Enlisted Day</th>
										<th style="background-color:#E3651D;">Details</th>
										<th style="background-color:#6DB9EF;">Approved</th>
                                        <th style="background-color:#6DB9EF;">Reject</th>

									</tr>
								</thead>
								<tbody>

                                <?php
$spotifySql = "SELECT * FROM songs 
INNER JOIN 
user_details ON songs.content_createdBy = user_details.user_unicode
WHERE songs.content_status = 'ACTIVE'"; 
$result = $conn->query($spotifySql);

if ($result === FALSE) {
    die("Error in Spotify Balance query: " . $conn->error);
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        // $formattedIncome = $row['profit'];
        
        // //$incomeAsFloat = floatval($formattedIncome);  // Convert formatted income back to float

        // //Payee Calculation
        // $Percent10 = $formattedIncome * 0.10;
        // $distributedAmount = $formattedIncome - $Percent10;

        // //Production Revenue Calculation
        // $ProductionIncome = $distributedAmount * 0.6;

        // //Owner Income Calculation
        // $OwnerIncome = $distributedAmount * 0.4;
?>

    <tr style="text-align:center;">
        <td style="font-weight:700;"><?php echo $row['song_title']; ?></td>
        <td style="font-weight:700;"><?php echo $row['user_production_name']; ?></td>
        <td style="font-weight:700;"><?php echo $row['content_createdAt'] ?></td>
        <td>
        <a href="detailsSong.php?Key=<?php echo $row['content_unicode'];?>" class="btn btn-secondary rounded-0">Details</a></td>
        
        
        <td>
        <a href="approvedSong.php?Key=<?php echo $row['content_unicode'];?>" class="btn btn-danger rounded-0">Reject</a></td>
        
        
        <td><a href="approvedSong.php?Key=<?php echo $row['content_unicode'];?>" class="btn btn-warning rounded-0">Hold</a></td>
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