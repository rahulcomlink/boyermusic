<?php include 'header.php'; ?>

<?php
error_reporting(E_ALL); // Enable full error reporting
ini_set('display_errors', 1); // Display errors for debugging
include 'db_balance.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user input to prevent SQL injection
    $platform_id = $productionCode; // Assuming platform_id is passed to identify the record to update

    // File upload handling
    $target_dir = "../public/productionImage/";
    $uploadOk = 1;
    $imageFileType = '';
    $target_file = '';
    $file_name = '';

    if (!empty($_FILES["platform_icon"]["name"])) {
        $file_name = basename($_FILES["platform_icon"]["name"]);
        $target_file = $target_dir . $file_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a valid image
        $check = getimagesize($_FILES["platform_icon"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
            echo "<script>alert('File is not an image.');</script>";
        }

        // Check if file already exists and rename if necessary
        if (file_exists($target_file)) {
            $file_name = uniqid() . '.' . $imageFileType;
            $target_file = $target_dir . $file_name;
        }

        // Check file size
        if ($_FILES["platform_icon"]["size"] > 500000) {
            $uploadOk = 0;
            echo "<script>alert('Sorry, your file is too large.');</script>";
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $uploadOk = 0;
            echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');</script>";
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "<script>alert('Sorry, your file was not uploaded.');</script>";
        } else {
            if (move_uploaded_file($_FILES["platform_icon"]["tmp_name"], $target_file)) {
                echo "<script>alert('The file has been uploaded.');</script>";
            } else {
                echo "<script>alert('There was an error uploading your file.');</script>";
                $uploadOk = 0;
            }
        }
    }

    if ($uploadOk == 1 && !empty($file_name)) {
        // Update the `user_mail_otp` column with the file name
        $stmt = $conn->prepare("UPDATE `user_details` SET `user_mail_otp` = ? WHERE `user_unicode` = ?");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        // Use `bind_param` to safely inject the values into the query
        $stmt->bind_param("ss", $file_name, $platform_id);
        if (!$stmt->execute()) {
            echo "<script>alert('Error updating icon: " . $stmt->error . "');</script>";
        } else {
            echo "<script>alert('Icon updated successfully!'); window.location.href = 'dashboard.php';</script>";
        }

        // Close the statement
        $stmt->close();
    } else {
        // Handle the case where no file is uploaded or $uploadOk is 0
        echo "<script>alert('No file uploaded or file upload failed.');</script>";
    }
}

// Close the database connection
$conn->close();
?>

<main class="page-content">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-xl-6 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h5 style="font-weight: 900; color: #263544">[ EDIT SETTINGS ]</h5>
                        <div class="p-4 border rounded">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label font-weight-bold" for="platform_name">Platform Name:</label>
                                    <input type="text" name="platform_name" class="form-control" id="platform_name" value="<?php echo htmlspecialchars($productionName); ?>" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label font-weight-bold" for="platform_icon">Production Icon:</label>
                                    <input type="file" name="platform_icon" class="form-control" id="platform_icon">
                                </div>
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
