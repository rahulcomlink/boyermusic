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
        $audio_filename = $currentDateTime . "_" . $randomNumber . ".mp3";


        $image_path = "../public/uploads/" . $image_filename;
        $audio_path = "../public/uploads/audio/" . $audio_filename;
    
        // Validate file types
        $allowed_image_types = array("jpg", "jpeg", "png", "gif");
        $allowed_audio_types = array("mp3", "wav");
    
        $imageFileType = strtolower(pathinfo($image_path, PATHINFO_EXTENSION));
        $audioFileType = strtolower(pathinfo($audio_path, PATHINFO_EXTENSION));
    
        if (!in_array($imageFileType, $allowed_image_types) || !in_array($audioFileType, $allowed_audio_types)) {
            echo "<script>alert('Invalid file type. Only JPG, JPEG, PNG, GIF, MP3, and WAV files are allowed.')</script>";
        } else {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $image_path) && move_uploaded_file($_FILES["audio"]["tmp_name"], $audio_path)) {
                    $sql="INSERT INTO `songs`(`content_type`, `content_title`, `content_upc`, `content_dor`, `content_gld`, `content_art`, `song_title`, `song_isrc`, `song_language`, `song_gld`, `song_genre`, `song_subgenre`, `song_mood`, `song_description`, `song_singer`, `song_composer`, `song_director`, `song_producer`, `song_starcast`, `song_lyricist`, `song_isExplicit`, `song_file`, `crbt_title_1`, `crbt_time_1`, `crbt_title_2`, `crbt_time_2`, `content_status`, `content_createdAt`, `content_createdBy`, `content_updatedAt`, `content_isDeleted`, `content_deletedAt`, `content_isPremium`, `content_premiumAt`, `content_unicode`) VALUES
                     ('$content_type','$content_title','$content_upc', '$content_dor', '$content_gld', '$image_filename', '$song_title', '$song_isrc', '$song_language', '$song_gld', '$song_genre', '$song_subgenre', '$song_mood', '$song_description', '$song_singer', '$song_composer', '$song_director', '$song_producer', '$song_starcast', '$song_lyricist', '$song_isExplicit', '$audio_filename', '$crbt_title_1', '$crbt_time_1', '$crbt_title_2', '$crbt_time_2', '$content_status', 'NOW()', '$content_createdBy', 'NOW()', 'NO', 'NOW()', '$content_isPremium', 'NOW()', '$content_unicode')";
    
                // Execute the SQL query
                if ($conn->query($sql) === TRUE) {
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
                <input type="text" name="content_title" class="form-control" placeholder="Title" required>
                <div class="valid-feedback">Looks good!</div>
              </div>
              <div class="col-md-4">
                <label for="" class="form-label">UPC</label>
                <input type="text" class="form-control" id="" name="content_upc" placeholder="UPC" required>
              </div>
              <div class="col-md-4">
                <label for="" class="form-label">Date of Release</label>
                <div class="input-group ">
                  <span class="input-group-text" id="inputGroupPrepend">
                    <span class="far fa-calendar-alt"></span>
                  </span>
									<input type="text" class="form-control datepicker" placeholder="Date of Release" name="content_dor"/> 

                </div>
              </div>
              <div class="col-md-4">
                <label for="" class="form-label">Date of Live</label>
                <div class="input-group ">
                  <span class="input-group-text" id="inputGroupPrepend">
                    <span class="far fa-calendar-alt"></span>
                  </span>
                  <input type="text" class="form-control datepicker" placeholder="Date of Live" name="content_gld" required/> 

                  <div class="invalid-feedback">Please choose a username.</div>
                </div>
              </div>
              <div class="col-md-4">
                <label for="" class="form-label">Content Type</label>
                <select class="single-select" id="" name="content_type" required>
                  <option selected disabled value="">Choose...</option>
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
                <input type="text" class="form-control" id="" name="song_title" placeholder="Song Title" required>
                <div class="valid-feedback">Looks good!</div>
              </div>
              <div class="col-md-4">
                <label for="" class="form-label">ISRC</label>
                <input type="text" class="form-control" id="" name="song_isrc" placeholder="Song ISRC" required>
                <div class="valid-feedback">Looks good!</div>
              </div>
              <div class="col-md-4">
                <label for="" class="form-label">Language</label>
                <select class="single-select" name="song_language">
                  <option value="Kokborok">Kokborok</option>
                  <option value="Hindi">Hindi</option>
                  <option value="Bengali">Bengali</option>
                  <option value="English">English</option>
                  <option value="Gujarati">Gujarati</option>
                  <option value="Marathi">Marathi</option>
                  <option value="Bhojpuri">Bhojpuri</option>
                  <option value="Tamil">Tamil</option>
                  <option value="Assamese">Assamese</option>
                  <option value="Telugu">Telugu</option>
                  <option value="Kannada">Kannada</option>
                  <option value="Malayalam">Malayalam</option>
                  <option value="Punjabi">Punjabi</option>
                  <option value="Manipuri">Manipuri</option>
                  <option value="Odia">Odia</option>
                  <option value="Haryanvi">Haryanvi</option>
                  <option value="Sanskrit">Sanskrit</option>
                  <option value="Rajasthani">Rajasthani</option>
                  <option value="Instrumental">Instrumental</option>
                  <option value="Unknown">Unknown</option>
                  <option value="Sambalpuri">Sambalpuri</option>
                  <option value="Arabic">Arabic</option>
                  <option value="Urdu">Urdu</option>
                  <option value="Banjara">Banjara</option>
                  <option value="Nepali">Nepali</option>
                  <option value="Maithili">Maithili</option>
                  <option value="Garhwali">Garhwali</option>
                  <option value="Santali">Santali</option>
                  <option value="Himachali">Himachali</option>
                  <option value="Konkani">Konkani</option>
                  <option value="Japanese">Japanese</option>
                  <option value="Awadhi">Awadhi</option>
                  <option value="Naga">Naga</option>
                  <option value="Khasi">Khasi</option>
                  <option value="Dogri">Dogri</option>
                  <option value="Persian">Persian</option>
                  <option value="Pali">Pali</option>
                  <option value="Tibetan">Tibetan</option>
                  <option value="Mandarin">Mandarin</option>
                  <option value="Chhattisgarhi">Chhattisgarhi</option>
                  <option value="Nagpuri">Nagpuri</option>
                  <option value="Kashmiri">Kashmiri</option>
                  <option value="Sindhi">Sindhi</option>
                  <option value="Kumauni">Kumauni</option>
                  <option value="Marwari">Marwari</option>
                  <option value="Sinhala">Sinhala</option>
                  <option value="Turkish">Turkish</option>
                  <option value="Spanish">Spanish</option>
                  <option value="Ahirani">Ahirani</option>
                  <option value="Swahili">Swahili</option>
                  <option value="Ukranian">Ukranian</option>
                  <option value="French">French</option>
                  <option value="Chinese">Chinese</option>
                  <option value="Burmese">Burmese</option>
                  <option value="Javanese">Javanese</option>
                  <option value="Korean">Korean</option>
                  <option value="Latin">Latin</option>
                  <option value="Malay">Malay</option>
                  <option value="Thai">Thai</option>
                  <option value="Bodo">Bodo</option>
                </select>
              </div>
              <div class="col-md-4">
                <label for="" class="form-label">Go Live Date</label>
                <div class="input-group ">
                  <span class="input-group-text" id="inputGroupPrepend">
                    <span class="far fa-calendar-alt"></span>
                  </span>
                  <input type="date" class="form-control datepicker picker__input" id="" name="song_gld" aria-describedby="inputGroupPrepend" required placeholder="Go Live Date">
                  <div class="invalid-feedback">Please choose a username.</div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="mb-3">
                  <label class="form-label">Genre</label>
                  <select class="single-select" name="song_genre">
                    <option value="Film">Film</option>
                    <option value="Folk">Folk</option>
                    <option value="Devotional">Devotional</option>
                    <option value="Traditional">Traditional</option>
                    <option value="IndiPop">IndiPop</option>
                    <option value="Instrumental">Instrumental</option>
                    <option value="Western Classical">Western Classical</option>
                    <option value="Carnatic Classical">Carnatic Classical</option>
                    <option value="Hindustani Classical">Hindustani Classical</option>
                    <option value="Spiritual">Spiritual</option>
                    <option value="English-Pop">English-Pop</option>
                    <option value="Ghazal">Ghazal</option>
                    <option value="Regional-Pop">Regional-Pop</option>
                    <option value="Lounge">Lounge</option>
                    <option value="Fusion">Fusion</option>
                    <option value="Electronic">Electronic</option>
                    <option value="Hip Hop">Hip Hop</option>
                    <option value="Rock">Rock</option>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <label for="" class="form-label">Sub Genre</label>
                <select class="single-select" name="song_subgenre">
                  <option value="Aarti">Aarti</option>
                  <option value="Bhajan">Bhajan</option>
                  <option value="Geet">Geet</option>
                  <option value="Kirtan">Kirtan</option>
                  <option value="Mantra">Mantra</option>
                  <option value="Chalisa">Chalisa</option>
                  <option value="Rabindra Sangeet">Rabindra Sangeet</option>
                  <option value="Nazrulgeeti">Nazrulgeeti</option>
                  <option value="Rajanikantageeti">Rajanikantageeti</option>
                  <option value="Baul Geet">Baul Geet</option>
                  <option value="Bogeet">Bogeet</option>
                  <option value="Bihu">Bihu</option>
                  <option value="Mapilla">Mapilla</option>
                  <option value="Kawa Chauth Songs">Kawa Chauth Songs</option>
                  <option value="Lagna Geet">Lagna Geet</option>
                  <option value="Marriage Song">Marriage Song</option>
                  <option value="Raksha Bandhan">Raksha Bandhan</option>
                  <option value="Naat">Naat</option>
                  <option value="Qawwals">Qawwals</option>
                  <option value="Carol">Carol</option>
                  <option value="Hymn">Hymn</option>
                  <option value="Gospel">Gospel</option>
                  <option value="Chant">Chant</option>
                  <option value="Gurbani">Gurbani</option>
                  <option value="Kirtan">Kirtan</option>
                  <option value="Paath">Paath</option>
                  <option value="Shabd">Shabd</option>
                  <option value="Soundtrack">Soundtrack</option>
                </select>
              </div>
              <div class="col-md-4">
                <label for="" class="form-label">Mood</label>
                <select class="single-select" name="song_mood">
                  <option value="Romantic">Romantic</option>
                  <option value="Happy">Happy</option>
                  <option value="Sad">Sad</option>
                  <option value="Dance">Dance</option>
                  <option value="Bhangra">Bhangra</option>
                  <option value="Patriotic">Patriotic</option>
                  <option value="Nostalgic">Nostalgic</option>
                  <option value="Inspirational">Inspirational</option>
                  <option value="Enthusiastic">Enthusiastic</option>
                  <option value="Optimistic">Optimistic</option>
                  <option value="Passion">Passion</option>
                  <option value="Pessimistic">Pessimistic</option>
                  <option value="Spiritual">Spiritual</option>
                  <option value="Peppy">Peppy</option>
                  <option value="Philosophical">Philosophical</option>
                  <option value="Mellow">Mellow</option>
                  <option value="Calm">Calm</option>
                </select>
              </div>
              <div class="col-md-4">
                <label for="" class="form-label">Description</label>
                <input type="text" class="form-control" id="" name="song_description" placeholder="Song Description" required>
                <div class="valid-feedback">Looks good!</div>
              </div>
              <div class="col-md-4">
                <label for="" class="form-label">Singer</label>
                <input type="text" class="form-control" id="" name="song_singer" placeholder="Song Singer" required>
                <div class="valid-feedback">Looks good!</div>
              </div>
              <div class="col-md-4">
                <label for="" class="form-label">Composer</label>
                <input type="text" class="form-control" id="" name="song_composer" placeholder="Song Composer" required>
                <div class="valid-feedback">Looks good!</div>
              </div>
              <div class="col-md-4">
                <label for="" class="form-label">Director</label>
                <input type="text" class="form-control" id="" name="song_director" placeholder="Director" required>
                <div class="valid-feedback">Looks good!</div>
              </div>
              <div class="col-md-4">
                <label for="" class="form-label">Producer</label>
                <input type="text" class="form-control" id="" name="song_producer" placeholder="Song Producer" required>
                <div class="valid-feedback">Looks good!</div>
              </div>
              <div class="col-md-4">
                <label for="" class="form-label">Star Cast</label>
                <input type="text" class="form-control" id="" name="song_starcast" placeholder="Star Cast" required>
                <div class="valid-feedback">Looks good!</div>
              </div>
              <div class="col-md-4">
                <label for="" class="form-label">Lyricist</label>
                <input type="text" class="form-control" id="" name="song_lyricist" placeholder="Lyricist" required>
                <div class="valid-feedback">Looks good!</div>
              </div>
              <div class="col-md-4">
                <label for="" class="form-label">Is Explicit?</label>
                <select class="single-select" id="" name="song_isExplicit" required>
                  <option value="No">No</option>
                  <option value="Yes">Yes</option>
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
                <input type="text" class="form-control" id="" name="crbt_title_1" placeholder="Title">
                <div class="valid-feedback">Looks good!</div>
              </div>
              <div class="col-md-6">
                <label for="" class="form-label" style="font-weight: 800;">Start Time</label>
                <input type="text" class="form-control" placeholder="hh:mm:ss" name="crbt_time_1" id="">
                <div class="valid-feedback">Looks good!</div>
              </div>
              <div class="col-md-6">
                <label for="" class="form-label" style="font-weight: 800;">Title 2</label>
                <input type="text" class="form-control" id="" placeholder="Title" name="crbt_title_2">
                <div class="valid-feedback">Looks good!</div>
              </div>
              <div class="col-md-6">
                <label for="" class="form-label" style="font-weight: 800;">Start Time</label>
                <input type="text" class="form-control" placeholder="hh:mm:ss" id="" name="crbt_time_2">
                <div class="valid-feedback">Looks good!</div>
              </div>
            </div>
          </div>
          <br>
          <div class="col" style="text-align:center">
            <button type="submit" name="signupSubmit" class="btn btn-info px-5">Upload Now</button>
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


