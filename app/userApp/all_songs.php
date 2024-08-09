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
									<tr style="background:#263544;color:white;text-align:center;">
                                        <th></th>
                                        <th>Song Name</th>
										<th>Status</th>
                                        <th style="background-color:#06D001;">Type</th>
										<th>Enlisted Day</th>
										<th></th>

									</tr>
								</thead>
								<tbody>

                                <?php
$spotifySql = "SELECT * FROM songs WHERE content_createdBy = '$productionCode'"; 
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

    <tr style="text-align:left;font-size:18px;vertical-align:text-top;text-color:black;">
    <td style="text-align:center;">
    <?php
    $artPath = '../public/art/' . $row['content_art'];
    $defaultImagePath = "../public/productionImage/$productionIcon"; // Path to your default image

    // Check if the content_art exists or is null
    if (!empty($row['content_art']) && file_exists($artPath)) {
        echo '<img src="' . $artPath . '" style="width:60px;">';
    } else {
        echo '<img src="' . $defaultImagePath . '" style="width:60px;">';
    }
    ?>
</td>
<td>
<!-- Rest of your code -->

            <?php echo $row['song_title']; ?></td>
        <td style="text-align:center;"><?php 
        if($row['content_status'] == "ACTIVE"){
            echo '<span class="badge bg-primary">Active</span>';
        }
        else if($row['content_status'] == "PENDING"){
            echo '<span class="badge bg-info ">Pending</span>';
        }
        else if($row['content_status'] == "REJECT"){
            echo '<span class="badge bg-danger">Rejected</span>';
        }
        ?>
        </td>

 

        <td style="text-align:center;"><?php 
        if($row['content_isPremium'] == "Yes"){
            echo '<span class="badge bg-success">Premium</span>';
        }
        else if($row['content_isPremium'] == "NO"){
            echo '<span class="badge bg-warning text-dark">Free</span>';
        }
        ?>
        </td>




        <td style="text-align:center;"><?php
// Assuming $row['content_createdAt'] contains the timestamp (e.g., '2024-07-13 02:46:32')
$timestamp = strtotime($row['content_createdAt']); // Convert to Unix timestamp

// Format the date as "13th July 2024"
$formattedDate = date('jS F Y', $timestamp);

echo $formattedDate; // Output: 13th July 2024
?>
</td>
        
        <td>
            <a href="song_details.php?Key=<?php echo $row['content_unicode'];?>" class="btn btn-light" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;width:100%;font-size:18px;"><i class="fa-solid fa-laptop-file" style="color: #B197FC;"></i>  Details</a>
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
       <!--end page main-->


    <?php
    include 'footer.php';
    ?>