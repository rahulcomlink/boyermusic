<?php
include 'header.php';
?>
       <main class="page-content">				
				<h5 class="mb-0 text-uppercase" style="color:#03C988;">[ Platform Song List ] </h5>
				<hr />
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example2" class="table table-striped table-bordered">
								<thead style="background:black;color:white;text-align:center;">
									<tr>
                                        <th>Song Name</th>
                                        <?php
                                        $platformNameList = platFormTable($conn);
                                        foreach ($platformNameList as $option) {
                                            echo $option;
                                        }
                                        ?>
									</tr>
								</thead>
								<tbody>

                                <?php
$spotifySql = "SELECT * FROM songs WHERE content_status = 'ACTIVE' AND content_createdBy = '$productionCode'"; 
$result = $conn->query($spotifySql);

if ($result === FALSE) {
    die("Error in Spotify Balance query: " . $conn->error);
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $content_unicode = $row['content_unicode'];
?>

    <tr style="text-align:center;">
        <td style="font-weight:700;text-align:left;"><?php echo $row['song_title']; ?></td>

        <?php
        $platformSql = "SELECT * FROM platforms_name";
        $platformResult = $conn->query($platformSql);
        if ($platformResult->num_rows > 0) {
            while ($platformRow = $platformResult->fetch_assoc()) {
                $platformName = $platformRow['platforms_name'];
                $platformStatus = "Pending"; // Default status
        
                $listPlatformSQL = "SELECT * FROM platforms_listed_song WHERE song_id = '$content_unicode' AND platforms_name = '$platformName'";
                $listPlatformResult = $conn->query($listPlatformSQL);
        
                if ($listPlatformResult->num_rows > 0) {
                    $platformStatus = "Approved";
                }
        
                //echo "Platform: $platformName, Status: $<br>";
                echo "<td style='font-weight:700;'>$platformStatus</td>";

            }
        }
        ?>


        


       
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