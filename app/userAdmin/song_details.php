<?php
include '../db/connection.php';
include 'header.php';

//Upload Action
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signupSubmit'])) {
      $content_type = $_POST['content_type'];
      $content_title = $_POST['content_title'];
      $content_upc = $_POST['content_upc'];
      $content_dor = $_POST['content_dor'];
      $content_gld = $_POST['content_gld'];
      $song_title = $_POST['song_title'];
      $song_isrc = $_POST['song_isrc'];
      $song_language = $_POST['song_language'];
      $song_gld = $_POST['song_gld'];
      $song_genre = $_POST['song_genre'];
      $song_subgenre = $_POST['song_subgenre'];
      $song_mood = $_POST['song_mood'];
      $song_description = $_POST['song_description'];
      $song_singer = $_POST['song_singer'];
      $song_composer = $_POST['song_composer'];
      $song_director = $_POST['song_director'];
      $song_producer = $_POST['song_producer'];
      $song_starcast = $_POST['song_starcast'];
      $song_lyricist = $_POST['song_lyricist'];
      $song_isExplicit = $_POST['song_isExplicit'];
      $crbt_title_1 = $_POST['crbt_title_1'];
      $crbt_time_1 = $_POST['crbt_time_1'];
      $crbt_title_2 = $_POST['crbt_title_2'];
      $crbt_time_2 = $_POST['crbt_time_2'];
			$content_status = "PENDING";
			$content_createdBy = $productionCode;
			$content_isPremium = "NO";
			$content_unicode = generateRandomString(10);

      if ($_FILES["audio"]["error"] == 0 && $_FILES["image"]["error"] == 0) {

        // Set file paths and names
        // $image_filename = basename($_FILES["image"]["name"]);
        // $audio_filename = basename($_FILES["audio"]["name"]);

           // Generate random and date-based filenames
        $currentDateTime = date("YmdHis");
        $randomNumber = generateRandomString(5);
    
        $image_filename = $currentDateTime . "_" . $randomNumber . ".jpg";
        $audio_filename = $currentDateTime . "_" . $randomNumber . ".wav";


        $image_path = "../public/uploads/" . $image_filename;
        $audio_path = "../public/uploads/audio/" . $audio_filename;
    
        // Validate file types
        $allowed_image_types = array("jpg", "jpeg", "png", "gif");
        $allowed_audio_types = array("wav");
    
        $imageFileType = strtolower(pathinfo($image_path, PATHINFO_EXTENSION));
        $audioFileType = strtolower(pathinfo($audio_path, PATHINFO_EXTENSION));
    
        if (!in_array($imageFileType, $allowed_image_types) || !in_array($audioFileType, $allowed_audio_types)) {
            echo "<script>alert('Invalid file type. Only JPG, JPEG, PNG, GIF, MP3, and WAV files are allowed.')</script>";
        } else {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $image_path) && move_uploaded_file($_FILES["audio"]["tmp_name"], $audio_path)) {
                    $sql="INSERT INTO `songs`(`content_type`, `content_title`, `content_upc`, `content_dor`, `content_gld`, `content_art`, `song_title`, `song_isrc`, `song_language`, `song_gld`, `song_genre`, `song_subgenre`, `song_mood`, `song_description`, `song_singer`, `song_composer`, `song_director`, `song_producer`, `song_starcast`, `song_lyricist`, `song_isExplicit`, `song_file`, `crbt_title_1`, `crbt_time_1`, `crbt_title_2`, `crbt_time_2`, `content_status`, `content_createdAt`, `content_createdBy`, `content_updatedAt`, `content_isDeleted`, `content_deletedAt`, `content_isPremium`, `content_premiumAt`, `content_unicode`) VALUES
                     ('$content_type','$content_title','$content_upc', '$content_dor', '$content_gld', '$image_filename', '$song_title', '$song_isrc', '$song_language', '$song_gld', '$song_genre', '$song_subgenre', '$song_mood', '$song_description', '$song_singer', '$song_composer', '$song_director', '$song_producer', '$song_starcast', '$song_lyricist', '$song_isExplicit', '$audio_filename', '$crbt_title_1', '$crbt_time_1', '$crbt_title_2', '$crbt_time_2', '$content_status', NOW(), '$content_createdBy', NOW(), 'NO', NOW(), '$content_isPremium', NOW(), '$content_unicode')";
    
                // Execute the SQL query
                if ($conn->query($sql) === TRUE) {
                    $platFormQuery = "INSERT INTO `platforms`(`spotify`, `gaana`, `itunes`, `youtube`, `hungama`, `jiosaavn`, `amazon`, `content_unicode`, `platforms_createdAt`, `platforms_updateAt`, `platforms_isDeleted`) VALUES ('PENDING','PENDING','PENDING','PENDING','PENDING','PENDING','PENDING','$content_unicode',NOW(),NOW(),'NO')";
                    $conn->query($platFormQuery);
                    echo "<script>alert('New record created successfully.')</script>";
                } else {
                    echo "<script>alert('Error: " . $conn->error . "')</script>";
                }
            } else {
                echo "<script>alert('Sorry, there was an error moving the uploaded files.')</script>";
            }
        }
    } else {
        echo "<script>alert('Both audio and image files must be uploaded.')</script>";
    }
}

//Retrive Data
if (isset($_GET['Key'])) {
    $content_unicode = $_GET['Key'];
    $sql = "SELECT * FROM songs WHERE content_unicode = '$content_unicode'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $content_type = $row['content_type'];
        $content_title = $row['content_title'];
        $content_upc = $row['content_upc'];
        $content_dor = $row['content_dor'];
        $content_gld = $row['content_gld'];
        $content_art = $row['content_art'];
        $song_title = $row['song_title'];
        $song_isrc = $row['song_isrc'];
        $song_language = $row['song_language'];
        $song_gld = $row['song_gld'];
        $song_genre = $row['song_genre'];
        $song_subgenre = $row['song_subgenre'];
        $song_mood = $row['song_mood'];
        $song_description = $row['song_description'];
        $song_singer = $row['song_singer'];
        $song_composer = $row['song_composer'];
        $song_director = $row['song_director'];
        $song_producer = $row['song_producer'];
        $song_starcast = $row['song_starcast'];
        $song_lyricist = $row['song_lyricist'];
        $song_isExplicit = $row['song_isExplicit'];
        $song_file = $row['song_file'];
        $crbt_title_1 = $row['crbt_title_1'];
        $crbt_time_1 = $row['crbt_time_1'];
        $crbt_title_2 = $row['crbt_title_2'];
        $crbt_time_2 = $row['crbt_time_2'];
    }
}

?>




<!--start content-->
<main class="page-content">
  <!--breadcrumb-->
  <!--end breadcrumb-->
<form class="row g-3" action="" method="post" enctype="multipart/form-data">

  <div class="row">
    <div class="col-xl-12 mx-auto">
      <div class="card">
        <div class="card-body">
          <h5 style="font-weight: 900;color:#03C988">[ Basic Information ]</h5>
          <div class="p-4 border rounded">
            <div class="row g-3 ">
              <div class="col-md-4">
                <label for="" class="form-label" style="font-weight: 800;">Title</label>
                <input type="text" value="<?php echo $content_type; ?>" name="content_title" class="form-control" placeholder="Title" required>
                <div class="valid-feedback">Looks good!</div>
              </div>
              <div class="col-md-4">
                <label for="" class="form-label">UPC</label>
                <input type="text" value="<?php echo $content_upc; ?>" class="form-control" id="" name="content_upc" placeholder="UPC" required>
              </div>
              <div class="col-md-4">
                <label for="" class="form-label">Date of Release</label>
                <div class="input-group ">
                  <span class="input-group-text" id="inputGroupPrepend">
                    <span class="far fa-calendar-alt"></span>
                  </span>
									<input type="text" value="<?php echo $content_dor; ?>" class="form-control datepicker" placeholder="Date of Release" name="content_dor"/> 

                </div>
              </div>
              <div class="col-md-4">
                <label for="" class="form-label">Date of Live</label>
                <div class="input-group ">
                  <span class="input-group-text" id="inputGroupPrepend">
                    <span class="far fa-calendar-alt"></span>
                  </span>
                  <input type="text" value="<?php echo $content_gld ?>" class="form-control datepicker" placeholder="Date of Live" name="content_gld" required/> 

                  <div class="invalid-feedback">Please choose a username.</div>
                </div>
              </div>
              <div class="col-md-4">
                <label for="" class="form-label">Content Type</label>
                <select class="single-select" id="" name="content_type" required>
                  <option selected disabled value=""><?php echo $content_type; ?></option>
                  <option value="Album">Album</option>
                  <option value="Single">Film</option>
                </select>
                <div class="invalid-feedback">Please select a valid state.</div>
              </div>
              <div class="col-md-4">
                <label for="" class="form-label">Album Art</label>
                <input class="form-control" type="file" name="image">
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
          <h5 style="font-weight: 900;color:#03C988">[ Song Information ]</h5>
          <div class="p-4 border rounded">
            <div class="row g-3">
              <div class="col-md-4">
                <label for="" class="form-label" style="font-weight: 800;">Title</label>
                <input type="text" class="form-control" id="" name="song_title" placeholder="Song Title" value="<?php echo $song_title; ?>" required>
                <div class="valid-feedback">Looks good!</div>
              </div>
              <div class="col-md-4">
                <label for="" class="form-label">ISRC</label>
                <input type="text" class="form-control" id="" name="song_isrc" placeholder="Song ISRC" value="<?php echo $song_isrc; ?>" required>
                <div class="valid-feedback">Looks good!</div>
              </div>
              <div class="col-md-4">
                <label for="" class="form-label">Language</label>
                <select class="single-select" name="song_language">
                  <option value="<?php echo $song_language; ?>"><?php echo $song_language; ?></option>
                  
                </select>
              </div>
              <div class="col-md-4">
                <label for="" class="form-label">Go Live Date</label>
                <div class="input-group ">
                  <span class="input-group-text" id="inputGroupPrepend">
                    <span class="far fa-calendar-alt"></span>
                  </span>
                  <input type="date" class="form-control datepicker picker__input" id="" name="song_gld" aria-describedby="inputGroupPrepend" required placeholder="Go Live Date" value="<?php echo $content_gld; ?>">
                  <div class="invalid-feedback">Please choose a username.</div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="mb-3">
                  <label class="form-label">Genre</label>
                  <select class="single-select" name="song_genre">
                    <option value="<?php echo $song_genre; ?>"><?php echo $song_genre; ?></option>
                    
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <label for="" class="form-label">Sub Genre</label>
                <select class="single-select" name="song_subgenre">
                  <option value="<?php echo $song_subgenre; ?>"><?php echo $song_subgenre; ?></option>
                </select>
              </div>
              <div class="col-md-4">
                <label for="" class="form-label">Mood</label>
                <select class="single-select" name="song_mood">
                  <option value="<?php echo $song_mood; ?>"><?php echo $song_mood; ?></option>
                 
                </select>
              </div>
              <div class="col-md-4">
                <label for="" class="form-label">Description</label>
                <input type="text" class="form-control" id="" name="song_description" placeholder="Song Description" required value="<?php echo $song_description; ?>">
                <div class="valid-feedback">Looks good!</div>
              </div>
              <div class="col-md-4">
                <label for="" class="form-label">Singer</label>
                <input type="text" class="form-control" id="" name="song_singer" placeholder="Song Singer" required value="<?php echo $song_singer; ?>">
                <div class="valid-feedback">Looks good!</div>
              </div>
              <div class="col-md-4">
                <label for="" class="form-label">Composer</label>
                <input type="text" class="form-control" id="" name="song_composer" placeholder="Song Composer" required value="<?php echo $song_composer; ?>">
                <div class="valid-feedback">Looks good!</div>
              </div>
              <div class="col-md-4">
                <label for="" class="form-label">Director</label>
                <input type="text" class="form-control" id="" name="song_director" placeholder="Director" required value="<?php echo $song_director; ?>">
                <div class="valid-feedback">Looks good!</div>
              </div>
              <div class="col-md-4">
                <label for="" class="form-label">Producer</label>
                <input type="text" class="form-control" id="" name="song_producer" placeholder="Song Producer" required value="<?php echo $song_producer; ?>">
                <div class="valid-feedback">Looks good!</div>
              </div>
              <div class="col-md-4">
                <label for="" class="form-label">Star Cast</label>
                <input type="text" class="form-control" id="" name="song_starcast" placeholder="Star Cast" required value="<?php echo $song_starcast; ?>">
                <div class="valid-feedback">Looks good!</div>
              </div>
              <div class="col-md-4">
                <label for="" class="form-label">Lyricist</label>
                <input type="text" class="form-control" id="" name="song_lyricist" placeholder="Lyricist" required value="<?php echo $song_lyricist; ?>">
                <div class="valid-feedback">Looks good!</div>
              </div>
              <div class="col-md-4">
                <label for="" class="form-label">Is Explicit?</label>
                <select class="single-select" id="" name="song_isExplicit" required>
                  <option value="No"><?php echo $song_isExplicit; ?></option>
                </select>
                <div class="invalid-feedback">Please select a valid state.</div>
              </div>
              <div class="col-md-12">
                <label for="" class="form-label">Audio File : <br>Filename should be Track Title + (wav) or Track ISRC + (.wav) </label>
                <input class="form-control" type="file" name="audio">
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
          <h5 style="font-weight: 900;color:#03C988">CRBT [Caller Ring Back Tone ]</h5>
          <div class="p-4 border rounded">
            <div class="row g-3 " >
              <div class="col-md-6">
                <label for="" class="form-label" style="font-weight: 800;">Title 1</label>
                <input type="text" class="form-control" id="" name="crbt_title_1" placeholder="Title" value="<?php echo $crbt_title_1; ?>">
                <div class="valid-feedback">Looks good!</div>
              </div>
              <div class="col-md-6">
                <label for="" class="form-label" style="font-weight: 800;">Start Time</label>
                <input type="text" class="form-control" placeholder="hh:mm:ss" name="crbt_time_1" id="" value="<?php echo $crbt_time_1 ?>">
                <div class="valid-feedback">Looks good!</div>
              </div>
              <div class="col-md-6">
                <label for="" class="form-label" style="font-weight: 800;">Title 2</label>
                <input type="text" class="form-control" id="" placeholder="Title" name="crbt_title_2" value="<?php echo $crbt_title_2; ?>">
                <div class="valid-feedback">Looks good!</div>
              </div>
              <div class="col-md-6">
                <label for="" class="form-label" style="font-weight: 800;">Start Time</label>
                <input type="text" class="form-control" placeholder="hh:mm:ss" id="" name="crbt_time_2" value="<?php echo $crbt_time_2; ?>">
                <div class="valid-feedback">Looks good!</div>
              </div>
            </div>
          </div>
          <br>
          <div class="col" style="text-align:center">
            <a href="song_approved.php?Key=<?php echo $content_unicode ?>" type="submit" name="signupSubmit" class="btn btn-danger px-5">Approved Now</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  </form>
  <!--end row-->
</main>
<!--end page main-->
<?php
include 'footer.php';
?>


