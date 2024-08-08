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
                        <?php
// Dynamic construction of SUM(CASE ...) statements for platforms
$platformList = "SELECT * FROM platforms_name";
$platformResult = $conn->query($platformList);
$listArray = array(); // Initialize an empty array to hold the list of SUM(CASE ...) statements
if ($platformResult->num_rows > 0) {
    while ($platformRow = $platformResult->fetch_assoc()) {
        $platformName = $platformRow['platforms_name'];
        // Append the SUM(CASE ...) statement for each platform to the list array
        $listArray[] = "SUM(CASE WHEN platforms_name = '$platformName' THEN song_income ELSE 0 END) AS '$platformName'";
    }
}
$listString = implode(', ', $listArray);

// Construct the main SQL query
$spotifySql = "SELECT 
    song_name,
    original_l2_name,
    $listString,
    SUM(song_income) as revenue 
FROM balance 
GROUP BY song_name, original_l2_name 
ORDER BY original_l2_name ASC"; 

$result = $conn->query($spotifySql);

if ($result === FALSE) {
    die("Error in Spotify Balance query: " . $conn->error);
}
?>

<table id="example2" class="table table-striped table-bordered">
    <thead style="background:black;color:white;text-align:center;">
        <tr>
            <th>Song Name</th>
            <th>Production Name</th>
            <?php
            // Display platform names as table headers
            $platformResult = $conn->query($platformList);
            if ($platformResult->num_rows > 0) {
                while ($platformRow = $platformResult->fetch_assoc()) {
                    echo '<th><img src="' . $platformRow['platforms_icon'] . '" style="width:20px;"> ' . $platformRow['platforms_name'] . '</th>';
                }
            }
            ?>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr style='text-align:center;'>";
                echo "<td style='font-weight:700;'>" . $row['song_name'] . "</td>";
                echo "<td style='font-weight:700;'>" . $row['original_l2_name'] . "</td>";

                // Display revenue for each platform
                $platformResult = $conn->query($platformList);
                if ($platformResult->num_rows > 0) {
                    while ($platformRow = $platformResult->fetch_assoc()) {
                        $platformName = $platformRow['platforms_name'];
                        // Display revenue for each platform
                        echo "<td style='font-weight:700;'>";
                        echo "₹" . number_format($row[$platformName], 2) ;
                        echo "</td>";
                    }
                }

                echo '<td style="font-weight:700;">₹' . number_format($row['revenue'], 2) . '</td>';


                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No results found</td></tr>";
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