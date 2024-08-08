<?php
include '../db/connection.php';
include 'header.php';

#Function to Add to Platform Data
if (isset($_POST['addToPlatform'])) {
    $platforms = $_POST['platforms'];
    $song_title = $_POST['song_title'];
    $song_isrc = $_POST['song_isrc'];
    $user_production_name = $_POST['production_name'];
    $content_unicode = $_GET['Key'];

    foreach ($platforms as $platform) {
        // Check if the song is already added to the platform
        $check_sql = "SELECT * FROM platforms_listed_song WHERE platforms_name = '$platform' AND song_id = '$content_unicode'";
        $check_result = $conn->query($check_sql);
    
        if ($check_result->num_rows > 0) {
            // If the song is alrea dy added to the platform, skip insertion
            echo "<script>alert('Song Already Added to the Platform')</script>";
            echo "<script>window.location.href='song_pending.php'</script>";
            //exit(); // Exit the loop if the song is already added
        } else {
            // If the song is not added to the platform, insert it
            $insert_sql = "INSERT INTO `platforms_listed_song`(`platforms_name`, `platforms_song_name`, `platforms_song_isrc`, `platforms_song_original_l2_name`, `song_id`, `createdAt`) VALUES ('$platform','$song_title','$song_isrc','$user_production_name','$content_unicode',NOW())";
            $insert_result = $conn->query($insert_sql);
    
            if ($insert_result === FALSE) {
                die("Error in Add to Platform: " . $conn->error);
            }
        }
    }
    
    header('Location: song_pending.php');
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
  <form class="row g-3" action="" method="post" enctype="multipart/form-data">
    <div class="row">
      <div class="col-xl-12 mx-auto">
        <div class="card">
          <div class="card-body">
            <h5 style="font-weight: 900;color:#03C988">[ Song Information ]</h5>
            <div class="p-4 border rounded">
              <div class="row g-3">
                <div class="col-md-4">
                  <label for="" class="form-label" style="font-weight: 800;">Spong Title</label>
                  <input type="text" class="form-control" id="" name="song_title" placeholder="Song Title" value="<?php echo $song_title; ?>" readonly>
                  <div class="valid-feedback">Looks good!</div>
                </div>
                <div class="col-md-4">
                  <label for="" class="form-label" style="font-weight: 800;">Sopng ISRC</label>
                  <input type="text" class="form-control" id="" name="song_isrc" placeholder="Song ISRC" value="<?php echo $song_isrc; ?>" readonly>
                  <div class="valid-feedback">Looks good!</div>
                </div>
                <div class="col-md-4">
                  <label for="" class="form-label" style="font-weight: 800;">Production Name</label>
                  <input type="text" class="form-control" id="" name="production_name" placeholder="Song ISRC" value="<?php echo $user_production_name; ?>" required readonly>
                  <div class="valid-feedback">Looks good!</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xl-12 mx-auto">
        <div class="card">
          <div class="card-body">
            <h5 style="font-weight: 900;color:Red">[ Add to Platform ]</h5>
            <div class="p-4 border rounded">
              <div class="row g-3">

            <?php
                $sql = "SELECT * FROM platforms_name";
                $result = $conn->query($sql);
            
                // Check if there are rows returned
                if ($result->num_rows > 0) {
                    // Loop through each row using a while loop
                    while($row = $result->fetch_assoc()) {
            ?>
                
                <div class="col-md-2">
               
                <div class="form-check form-switch">
              <?php
             $validationSQL = "SELECT * FROM platforms_listed_song WHERE song_id='$content_unicode' AND platforms_name = '" . $row['platforms_name'] . "'";

              $validResult = $conn->query($validationSQL);
              if($validResult->num_rows > 0){
              ?>
              <input class="form-check-input" name="platforms[]" value="<?php echo $row['platforms_name'] ?>" type="checkbox" role="switch" id="flexSwitchCheckDefault" checked>
                    <label class="form-check-label" for="flexSwitchCheckDefault"><?php echo $row['platforms_name'] ?></label>
              
              <?php
              }else{
              ?>
<input class="form-check-input" name="platforms[]" value="<?php echo $row['platforms_name'] ?>" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                    <label class="form-check-label" for="flexSwitchCheckDefault"><?php echo $row['platforms_name'] ?></label>
              <?php
              }
              ?>
                    
                </div>



                </div>

            <?php            
                    }
                } else {
                    echo "0 results"; // If no rows are returned
                }
            ?>
            
            
              </div>
            </div>
            <br>
            <div class="col" style="text-align:center">
            <button type="submit" name="addToPlatform" class="btn btn-danger px-5">Add To Platform Now</button>
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


