<?php
include 'header.php';
include 'db_balance.php';

// Initialize variables for user input
$userProvidedDate = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] == UPLOAD_ERR_OK) {
        $file = $_FILES["fileToUpload"]["tmp_name"];

        //Get The Last ID   
        
        // Read the CSV file
        $csv = array_map('str_getcsv', file($file));

        // Remove header if present
        $header = array_shift($csv);

        // Get user-provided date and platform name from the form
        $userProvidedDate = $_POST['userDate'];
        $platformName = $conn->real_escape_string($_POST['platform_name']);

        // Prepare and execute the SQL statement for each row in the CSV
        foreach ($csv as $row) {

            $unique_id = generateUniqueId();
            // Escape special characters in each field
            $escapedRow = array_map([$conn, 'real_escape_string'], $row);

            // Use the user-provided date and platform name in the SQL query
            $sql = "INSERT INTO `balance`(`unique_id`,`platforms_name`, `song_name`, `song_isrc`, `song_income`, `original_l2_name`, `balance_date`) 
                    VALUES ('$unique_id','$platformName', '{$escapedRow[0]}', '{$escapedRow[1]}', '{$escapedRow[2]}', '{$escapedRow[3]}', '$userProvidedDate')";
            
            if ($conn->query($sql) !== TRUE) {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        echo "<script>alert('Data uploaded successfully!');</script>";
    } else {
        echo "Error uploading file. Please make sure you selected a file.";
    }
}

// Close the database connection
?>


<main class="page-content">		
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-xl-12 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h5 style="font-weight: 900; color:#03C988">[ Upload Balance Data ]</h5>
                        <div class="p-4 border rounded">
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <label class="form-label" for="fileToUpload">Choose CSV File:</label>
                                    <input type="file" name="fileToUpload" class="form-control" id="fileToUpload" accept=".csv">
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label custom-font">Select Platform</label>
                                    <select class="single-select" id="platform" name="platform_name" required>
                                        <option>-- Select Platform --</option>
                                        <?php
                                        $platformNameList = allPlatformList($conn);
                                        foreach ($platformNameList as $option) {
                                            echo $option;
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label" for="userDate">Enter Date (YYYY-MM-DD):</label>
                                    <input type="date" class="form-control" name="userDate" id="userDate" placeholder="YYYY-MM-DD" required>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label" for="userDate">..</label><br>
                                    <input type="submit" class="btn btn-warning" value="Upload Data">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</main>

<?php
include 'footer.php';
?>
