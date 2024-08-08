{{>user_header}}
<!--start content-->
<main class="page-content">
  <!--breadcrumb-->
  <!--end breadcrumb-->
{{#each data}}
<form class="row g-3" action="/user/api/songUploadAction" method="post" enctype="multipart/form-data">

  <div class="row">
    <div class="col-xl-12 mx-auto">
      <div class="card">
        <div class="card-body">
          <h5 style="font-weight: 900;color:#03C988">[ Basic Information ]</h5>
          <div class="p-4 border rounded">
            <div class="row g-3 ">
              <div class="col-md-4">
                <label for="" class="form-label" style="font-weight: 800;">Title</label>
                <input type="text" name="content_title" class="form-control" placeholder="Title" required value="{{content_title}}">
                <div class="valid-feedback">Looks good!</div>
              </div>
              <div class="col-md-4">
                <label for="" class="form-label">UPC</label>
                <input type="text" class="form-control" id="" name="content_upc" placeholder="UPC" required value="{{content_upc}}">
              </div>
              <div class="col-md-4">
                <label for="" class="form-label">Date of Release</label>
                <div class="input-group ">
                  <span class="input-group-text" id="inputGroupPrepend">
                    <span class="far fa-calendar-alt"></span>
                  </span>
                  <input type="date" name="content_dor" placeholder="Date of Release" class="form-control" id="" aria-describedby="inputGroupPrepend" required value="{{content_dor}}">
                  <div class="invalid-feedback">Please choose a username.</div>
                </div>
              </div>
              <div class="col-md-4">
                <label for="" class="form-label">Date of Live</label>
                <div class="input-group ">
                  <span class="input-group-text" id="inputGroupPrepend">
                    <span class="far fa-calendar-alt"></span>
                  </span>
                  <input type="date" class="form-control" id="" name="content_gld" aria-describedby="inputGroupPrepend" required value="{{content_gld}}">
                  <div class="invalid-feedback">Please choose a username.</div>
                </div>
              </div>
              <div class="col-md-4">
                <label for="" class="form-label">Content Type</label>
                <select class="form-select" id="" name="content_type" required>
                    <option value="Album" {{#select content_type}}Active{{/select}}>Album</option>
                    <option value="Film" {{#select content_type}}Terminate{{/select}}>Film</option>
                </select>
                <div class="invalid-feedback">Please select a valid state.</div>
              </div>
              <div class="col-md-4">
    <label for="" class="form-label">Album Art</label>
    <input class="form-control" type="file" id="imageInput" name="image">
    <div id="imagePreview">
            <img src="{{content_art}}" alt="Album Art" style="max-width: 20%; height: 30px;">
    </div>
</div>

<script>
    // Get the input element
    const imageInput = document.getElementById('imageInput');
    // Get the preview element
    const imagePreview = document.getElementById('imagePreview');

    // Add an event listener to the input field
    imageInput.addEventListener('change', function () {
        const file = imageInput.files[0];
        // Check if a file is selected
        if (file) {
            const reader = new FileReader();
            // Read the file as a data URL
            reader.readAsDataURL(file);
            reader.onload = function () {
                // Set the preview element's HTML to display the selected image
                imagePreview.innerHTML = `<img src="${reader.result}" alt="Album Art" style="max-width: 20%; height: 50px;">`;
            };
        } else {
            // If no file is selected, clear the preview
            imagePreview.innerHTML = '';
        }
    });
</script>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  {{!-- Song Details --}}
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
                  <input type="date" class="form-control" id="" name="song_gld" aria-describedby="inputGroupPrepend" required>
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
                <select class="form-select" id="" name="song_isExplicit" required>
                  <option selected disabled value="No">No</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
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
  {{!-- Caller Tune --}}
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
            <button type="submit" name="sub" class="btn btn-info px-5">Upload Now</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  </form>
  <!--end row-->
</main>
{{/each}}
<!--end page main-->
{{>admin_footer}}