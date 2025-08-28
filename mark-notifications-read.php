<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "hostel");
if (!$conn) die("DB connection failed: " . mysqli_connect_error());

$email = $_SESSION['email'] ?? '';
if (!empty($email)) {
    $stmt = $conn->prepare("UPDATE notifications SET is_read = 1 WHERE user_email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
}
?>
