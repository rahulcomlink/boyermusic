<?php


if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['songUpload'])) {
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

    // Handle file uploads
    $audio_file = $_FILES['audio'];
    $image_file = $_FILES['image'];

    $audio_upload_path = __DIR__ . '../public/audio/' . basename($audio_file['name']);
    $image_upload_path = __DIR__ . '../public/album_art/' . basename($image_file['name']);

    if (move_uploaded_file($audio_file['tmp_name'], $audio_upload_path) && move_uploaded_file($image_file['tmp_name'], $image_upload_path)) {
        // Insert data into the songs table
        $query = "INSERT INTO songs (content_type, content_title, content_upc, content_dor, content_gld, content_art,
        song_title, song_isrc, song_language, song_gld, song_genre, song_subgenre, song_mood,
        song_description, song_singer, song_composer, song_director, song_producer, song_starcast,
        song_lyricist, song_isExplicit, song_file, crbt_title_1, crbt_time_1, crbt_title_2, crbt_time_2,
        content_status, content_createdAt, content_createdBy, content_updatedAt, content_isDeleted,
        content_deletedAt, content_isPremium, content_premiumAt, content_unicode) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,NOW(),?,NOW(),?,NOW(),?,NOW(),?);";

        // Prepare and execute the query with PDO or MySQLi, depending on your database connection method
        // For PDO:
        $stmt = $conn->prepare($query);

        // Bind parameters and execute the statement
        $stmt->bind_param("ssssssssss", $user_name, $user_email, $user_phone, $hashPassword, $user_production_name, $user_production_type, $address, $user_production_code, $user_define_code, $mailOTP);

        // For MySQLi:
        // $stmt = $conn->prepare($query);
        // $stmt->bind_param("ssssssssss", $content_type, $content_title, /* ... other values ... */, $content_status, $content_createdBy, /* ... other values ... */, $content_unicode);
        // $stmt->execute();

        // Check if the insertion was successful
        if ($stmt->execute() > 0) {
            // Insert into platforms table
            $platforms_query = "INSERT INTO platforms (spotify, gaana, itunes, youtube, hungama, jiosaavn, amazon, content_unicode, platforms_createdAt, platforms_updateAt, platforms_isDeleted) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW(), ?)";

            $platforms_stmt = $pdo->prepare($platforms_query);
            $platforms_stmt->execute(['No Action', 'No Action', 'No Action', 'No Action', 'No Action', 'No Action', 'No Action', $content_unicode, 'No']);

            // Check if the insertion into platforms table was successful

            if ($platforms_stmt->rowCount() > 0) {
                echo json_encode(["message" => "Files uploaded and data saved successfully", "AuploadPath" => $audio_upload_path]);
            } else {
                echo json_encode(["error" => "Error occurred while inserting into platforms table"]);
            }
        } else {
            echo json_encode(["error" => "Error occurred while inserting into songs table"]);
        }

    } else {
        echo json_encode(["error" => "Error occurred while uploading files"]);
    }
} else {
    echo json_encode(["error" => "Invalid request"]);
}
?>
