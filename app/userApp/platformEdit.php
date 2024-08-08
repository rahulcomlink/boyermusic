<?php
error_reporting(0);
include 'db_balance.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user input to prevent SQL injection
    $platform_id = $_POST['platform_id']; // Assuming platform_id is passed to identify the record to update
    $platform_name = $conn->real_escape_string($_POST['platform_name']);

    // File upload handling
    $target_dir = "uploads/";
    $uploadOk = 1;
    $imageFileType = '';
    $target_file = '';

    if (!empty($_FILES["platform_icon"]["name"])) {
        $target_file = $target_dir . basename($_FILES["platform_icon"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["platform_icon"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["platform_icon"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["platform_icon"]["tmp_name"], $target_file)) {
                echo "The file " . htmlspecialchars(basename($_FILES["platform_icon"]["name"])) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
                $uploadOk = 0;
            }
        }
    }

    if ($uploadOk == 1) {
        // Use prepared statement to prevent SQL injection
        if (!empty($target_file)) {
            // New image was uploaded, use the new image path
            $stmt = $conn->prepare("UPDATE `platforms_name` SET `platforms_name` = ?, `platforms_icon` = ?, `createdAt` = NOW() WHERE `platforms_id` = ?");
            $stmt->bind_param("ssi", $platform_name, $target_file, $platform_id);
        } else {
            // No new image, keep the old image path
            $stmt = $conn->prepare("UPDATE `platforms_name` SET `platforms_name` = ?, `createdAt` = NOW() WHERE `platforms_id` = ?");
            $stmt->bind_param("si", $platform_name, $platform_id);
        }

        if ($stmt->execute()) {
            echo "<script>alert('Platform updated successfully!');</script>";
            header("Location: platformList.php");
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }
}

// Close the database connection
?>


<?php
if (isset($_GET['Key'])) {
    $getKey = $_GET['Key'];

    // Escape the key to prevent SQL injection
    $getKey = $conn->real_escape_string($getKey);

    // Prepare the SQL query
    $getPlatformSQL = "SELECT platforms_icon, platforms_name FROM platforms_name WHERE platforms_id='$getKey'";

    // Execute the query
    $result = $conn->query($getPlatformSQL);

    if ($result) {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Use the fetched data as needed
                $platfromIcon = htmlspecialchars($row['platforms_icon']);
                $platfromName = htmlspecialchars($row['platforms_name']);

                // echo "Platform Name: " . htmlspecialchars($row['platforms_name']) . "<br>";
            }
        } else {
            echo "No platform found with the given key.";
        }
        $result->free();
    } else {
        echo "Error executing query: " . $conn->error;
    }
} else {
    echo "Key not provided.";
}

// Close the database connection

?>


<?php include 'header.php'; ?>

<main class="page-content">      
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-xl-12 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h5 style="font-weight: 900; color: #263544">[ EDIT PLATFORM ]</h5>
                        <div class="p-4 border rounded">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label font-weight-bold" for="platform_name">Platform Name:</label>
                                    <input type="text" name="platform_name" class="form-control" id="platform_name" value="<?php echo $platfromName;?>">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label font-weight-bold" for="platform_icon">Platform Icon:</label>
                                    <input type="file" name="platform_icon" class="form-control" id="platform_icon">
                                </div>
                                <input type="hidden" value="<?php echo $getKey; ?>" name="platform_id">
                                <div class="col-md-2">
                                    <label class="form-label" for="userDate">..</label><br>
                                    <input type="submit" class="btn btn-danger" value="Create Platform" name="submit">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</main>

<?php include 'footer.php'; ?>
