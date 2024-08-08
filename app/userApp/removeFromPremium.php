<?php
#CHECKS IF THE KEY IS SET
include '../db/connection.php';

if(isset($_GET['Key'])) {
    $contentKey = $_GET['Key'];
    $premiumSQL = "UPDATE songs SET content_isPremium = 'No', content_premiumAt = CURDATE() WHERE content_unicode = '$contentKey'";
    $premiumResult = $conn->query($premiumSQL);
    if ($premiumResult === FALSE) {
        die("Error in Adding to Premium: " . $conn->error);
    } else {
        // Alert and then redirect
        echo "<script>alert('Remove From Premium Successfully'); window.location='song_list.php';</script>";
        exit(); // Terminate script execution after redirection
    }
}
?>