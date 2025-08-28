<?php

// 1. id
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['id'])) {
    http_response_code(400);
    echo 'Missing complaint ID';
    exit;
}

$complaintId = (int)$_POST['id'];
if ($complaintId <= 0) {
    http_response_code(400);
    echo 'Invalid complaint ID';
    exit;
}

// 2. Connect to the database
$conn = mysqli_connect("localhost", "root", "", "hostel");
if (!$conn) {
    http_response_code(500);
    echo 'Database connection failed: ' . mysqli_connect_error();
    exit;
}

// 3. Update complaint status to 'Resolved'
$sql = "UPDATE complaints SET status = 'Resolved' WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
if (!$stmt) {
    http_response_code(500);
    echo 'Prepare failed: ' . mysqli_error($conn);
    exit;
}

mysqli_stmt_bind_param($stmt, "i", $complaintId);
if (!mysqli_stmt_execute($stmt)) {
    http_response_code(500);
    echo 'Update failed: ' . mysqli_stmt_error($stmt);
    exit;
}

// 4. Success response
echo 'ok';

// 5. Cleanup
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
