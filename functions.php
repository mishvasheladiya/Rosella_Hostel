<?php
function addNotification($conn, $user_email, $message) {
    $stmt = $conn->prepare("INSERT INTO notifications (user_email, message) VALUES (?, ?)");
    $stmt->bind_param("ss", $user_email, $message);
    $stmt->execute();
}
?>
