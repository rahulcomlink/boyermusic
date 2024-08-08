<?php
include 'db_balance.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user input to prevent SQL injection
    $platform_name = $conn->real_escape_string($_POST['platform_name']);

    // File upload handling
    $target_dir = "uploads/"; // Specify the directory where you want to store the uploaded files
    $target_file = $target_dir . basename($_FILES["platform_icon"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["platform_icon"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
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
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["platform_icon"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["platform_icon"]["name"])). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO `platforms_name`(`platforms_name`, `platforms_icon`, `createdAt`) VALUES (?, ?, NOW())");
    $stmt->bind_param("ss", $platform_name, $target_file);

    if ($stmt->execute()) {
        echo "<script>alert('Platform Created successfully!');</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>

<?php include 'header.php'; ?>

<main class="page-content">      
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-xl-12 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h5 style="font-weight: 900; color: #03C988">[ CREATE PLATFORM ]</h5>
                        <div class="p-4 border rounded">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label font-weight-bold" for="platform_name">Platform Name:</label>
                                    <input type="text" name="platform_name" class="form-control" id="platform_name">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label font-weight-bold" for="platform_icon">Platform Icon:</label>
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
