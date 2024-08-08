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
                                        <th></th>
                                        <th>Song Name</th>
										<th>Status</th>
                                        <th style="background-color:#E3651D;">Premium Status</th>
										<th style="background-color:#F9F9E0;">Enlisted Day</th>
										<th style="background-color:#E3651D;">Details</th>

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
        <td style="text-align:center;"><img src="../public/art/<?php echo $row['content_art']; ?>" style="width:60px;"></td>
        <td><?php echo $row['song_title']; ?></td>
        <td><?php 
        if($row['content_status'] == "ACTIVE"){
            echo "Listed on Platforms";
        }
        else if($row['content_status'] == "PENDING"){
            echo "Pending";
        }
        else if($row['content_status'] == "REJECT"){
            echo "Rejected";
        }
        ?>
        </td>

 

        <td><?php 
        if($row['content_isPremium'] == "YES"){
            echo "Yes";
        }
        else if($row['content_isPremium'] == "NO"){
            echo "No";
        }
        ?>
        </td>




        <td><?php echo $row['content_createdAt'] ?></td>
        
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