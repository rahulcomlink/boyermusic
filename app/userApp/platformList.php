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
                                        <th>Platform Name</th>
										<th>Created Date</th>
                                        <th>Edit</th>
                                        <th>Delete</th>


                                        
									</tr>
								</thead>
								<tbody>

                                <?php
$spotifySql = "SELECT * FROM platforms_name"; 
$result = $conn->query($spotifySql);

if ($result === FALSE) {
    die("Error in Spotify Balance query: " . $conn->error);
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $p_id = $row['platforms_id'];
?>

    <tr style="text-align:center;font-size:18px;box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;width:100%;font-size:18px;background:white;">
        <td style="font-weight:700;"><img src="<?php echo $row['platforms_icon'] ?>" style="width:30px"> <?php echo $row['platforms_name']; ?></td>
        <td style="font-weight:700;"><?php echo $row['createdAt']; ?></td>
        <td style="font-weight:700;">
            <a href="platformEdit.php?Key=<?php echo "$p_id"; ?>" class="btn btn-light" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;width:100%;font-size:18px;"><i class="fa-solid fa-file-pen" style="color: #74C0FC;"></i>  Edit</a></td>
        </td>
        <td style="font-weight:700;">
            <a href="approvedSong.php?Key=<?php echo "$p_id"; ?>" class="btn btn-danger" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;width:100%;font-size:18px;"><i class="fa-solid fa-trash-can" style="color: white;"></i>  Delete</a></td>
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