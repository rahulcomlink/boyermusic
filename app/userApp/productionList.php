<?php
include 'header.php';
include 'functions.php';

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
                                        <th>Production Name</th>
										<th>Owner Name</th>
                                        <th>Mobile Number</th>
                                        <th>Created At</th>
                                        <th>Edit</th>
									</tr>
								</thead>
								<tbody>

                                <?php
$spotifySql = "SELECT * FROM user_details"; 
$result = $conn->query($spotifySql);

if ($result === FALSE) {
    die("Error in Spotify Balance query: " . $conn->error);
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $p_id = $row['user_id'];
?>

    <tr style="text-align:left;font-size:18px;box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;width:100%;font-size:18px;background:white;font-family: times new roman;">
        <td ><?php echo $row['user_production_name']; ?></td>
        <td ><?php echo $row['user_name']; ?></td>
        <td ><?php echo $row['user_phone']; ?></td>
        <td ><?php 
        $date = $row['user_createdAt'];
        echo formatDateWithOrdinal($date) ?></td>
        <td>
            <a href="platformEdit.php?Key=<?php echo "$p_id"; ?>" class="btn btn-light" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;width:100%;font-size:18px;"><i class="fa-solid fa-file-pen" style="color: #74C0FC;"></i>  Edit</a></td>
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