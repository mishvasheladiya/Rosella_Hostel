<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "hostel");
if (!$conn) die("DB connection failed: " . mysqli_connect_error());

include('../functions.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $stmt = $conn->prepare("SELECT * FROM complaints WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $complaint = $stmt->get_result()->fetch_assoc();

    if ($complaint) {
        $update = $conn->prepare("UPDATE complaints SET status = 'Resolved' WHERE id = ?");
        $update->bind_param("i", $id);
        if ($update->execute()) {
            $msg = "✅ Your complaint (ID: {$complaint['id']}) has been resolved.";
            addNotification($conn, $complaint['email'], $msg);

            echo "<script>alert('Complaint resolved and student notified.'); window.location.href='admin-complaints.php';</script>";
        }
    }
}
?>
