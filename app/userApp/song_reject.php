<?php
include '../db/connection.php';

//Approved  Song
if (isset($_GET['Key'])) {
    $content_unicode = $_GET['Key'];
    $sql = "UPDATE songs SET content_status = 'REJECT' WHERE content_unicode = '$content_unicode'";
    $result = $conn->query($sql);
    if ($result === FALSE) {
        die("Error in Approved Song: " . $conn->error);
    }
    header('Location: song_pending.php');
}

?>