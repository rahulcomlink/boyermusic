<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "music_app";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables for user input
$userProvidedDate = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["fileToUpload"])) {
        $file = $_FILES["fileToUpload"]["tmp_name"];
        
        // Read the CSV file
        $csv = array_map('str_getcsv', file($file));

        // Remove header if present
        $header = array_shift($csv);

        // Get user-provided date from the form
        $userProvidedDate = $_POST['userDate'];

        // Prepare and execute the SQL statement for each row in the CSV
        foreach ($csv as $row) {
            // Escape special characters in each field
            $escapedRow = array_map([$conn, 'real_escape_string'], $row);

            // Use the user-provided date in the SQL query
            $sql = "INSERT INTO `youtube_balance`(`adjustment_type`, `day`, `country`, `video_id`, `asset_id`, `asset_title`, `asset_labels`, `asset_channel_id`, `asset_type`, `custom_id`, `isrc`, `upc`, `grid`, `artist`, `album`, `label`, `claim_type`, `content_type`, `administer_publish_rights`, `total`, `income`, `month`, `file_name`, `admin_Exp`, `royality`, `id`, `Main_Label`, `Sub_Label`, `Label_Identification`, `original_l1_name`, `original_l2_name`, `company`, `createdAt`) VALUES ('$escapedRow[0]', '$escapedRow[1]', '$escapedRow[2]', '$escapedRow[3]', '$escapedRow[4]', '$escapedRow[5]', '$escapedRow[6]', '$escapedRow[7]', '$escapedRow[8]', '$escapedRow[9]', '$escapedRow[10]', '$escapedRow[11]', '$escapedRow[12]', '$escapedRow[13]', '$escapedRow[14]', '$escapedRow[15]', '$escapedRow[16]', '$escapedRow[17]', '$escapedRow[18]', '$escapedRow[19]', '$escapedRow[20]', '$escapedRow[21]', '$escapedRow[22]', '$escapedRow[23]', '$escapedRow[24]', '$escapedRow[25]', '$escapedRow[26]', '$escapedRow[27]', '$escapedRow[28]', '$escapedRow[29]', '$escapedRow[30]','$escapedRow[31]', '$userProvidedDate')";


            
            if ($conn->query($sql) !== TRUE) {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        echo "Data uploaded successfully!";
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload CSV Form</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <label for="fileToUpload">Choose CSV File:</label>
        <input type="file" name="fileToUpload" id="fileToUpload" accept=".csv">
        <br>
        <label for="userDate">Enter Date (YYYY-MM-DD):</label>
        <input type="text" name="userDate" id="userDate" placeholder="YYYY-MM-DD" required>
        <br>
        <input type="submit" value="Upload Data">
    </form>
</body>
</html>
