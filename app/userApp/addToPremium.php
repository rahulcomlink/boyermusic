<?php
#INCLUDES THE DATABASE CONNECTION FILE
include '../db/connection.php';

#CHECKS IF THE KEY IS SET
// if(isset($_GET['Key'])) {
//     $contentKey = $_GET['Key'];
//     $premiumSQL = "UPDATE songs SET content_isPremium = 'Yes', content_premiumAt = CURDATE() WHERE content_unicode = '$contentKey'";
//     $premiumResult = $conn->query($premiumSQL);
//     if ($premiumResult === FALSE) {
//         die("Error in Adding to Premium: " . $conn->error);
//     } else {
//         // Alert and then redirect
//         echo "<script>alert('Added to Premium Successfully'); window.location='song_list.php';</script>";
//         exit(); // Terminate script execution after redirection
//     }
// }
?>


<?php
include 'header.php';

if (isset($_POST['addToPremium'])) {
    $content_unicode = $_GET['Key'];
    $date = $_POST['userDate'];

    // Update the song to premium
    $update_sql = "UPDATE songs SET content_isPremium = 'Yes', content_premiumAt = '$date' WHERE content_unicode = '$content_unicode'";
    if ($conn->query($update_sql) === TRUE) {
        // Alert and redirect
        echo "<script>
                alert('Song has been successfully updated to premium.');
                window.location.href = 'song_list.php';
              </script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}



//Retrive Data
if (isset($_GET['Key'])) {
    $content_unicode = $_GET['Key'];
    $sql = "SELECT songs.song_title, songs.song_isrc, user_details.user_production_name  FROM songs INNER JOIN user_details ON songs.content_createdBy = user_details.user_unicode WHERE songs.content_unicode = '$content_unicode'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $song_title = $row['song_title'];
        $song_isrc = $row['song_isrc'];
        $user_production_name = $row['user_production_name'];
    }
}

?>

<main class="page-content">
  <form class="row g-3" action="" method="post">
    <div class="row">
      <div class="col-xl-12 mx-auto">
        <div class="card">
          <div class="card-body">
            <h5 style="font-weight: 900;color:#03C988">[ Song Information ]</h5>
            <div class="p-4 border rounded">
              <div class="row g-3">
                <div class="col-md-3">
                  <label for="" class="form-label" style="font-weight: 800;">Spong Title</label>
                  <input type="text" class="form-control" id="" name="song_title" placeholder="Song Title" value="<?php echo $song_title; ?>" readonly>
                  <div class="valid-feedback">Looks good!</div>
                </div>
                <div class="col-md-3">
                  <label for="" class="form-label" style="font-weight: 800;">Song ISRC</label>
                  <input type="text" class="form-control" id="" name="song_isrc" placeholder="Song ISRC" value="<?php echo $song_isrc; ?>" readonly>
                  <div class="valid-feedback">Looks good!</div>
                </div>

                 <div class="col-md-3">
                    <label class="form-label" for="userDate">Enter Date (YYYY-MM-DD):</label>
                    <input type="date" class="form-control" name="userDate" id="userDate" placeholder="YYYY-MM-DD" required>
                </div>

                <div class="col-md-3">
                    <label class="form-label" for="userDate">..</label><br>
                    <input type="submit" class="btn btn-danger" value="Add to Premium" name="addToPremium" style="background:#134B70">
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


