<?php
if (!isset($base_url)) {
    $base_url = '/Hostel/';
}

session_start();
$conn = mysqli_connect("localhost", "root", "", "hostel");
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$email = $_SESSION['email'] ?? '';

$student = null;
if ($email) {
    $stmt = $conn->prepare("SELECT * FROM student WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>My Room - ROSELLE Hostel</title>
  <link rel="stylesheet" href="<?= $base_url; ?>assets/css/student-room.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
</head>
<body>

<?php include('student-header.php'); ?>
<?php include('student-sidebar.php'); ?>

<div class="main-content">
    <div class="room-container">
    <?php if ($student): ?>
        <div class="room-card">
            <h2>Room No: <?= htmlspecialchars($student['roomNumber'] ?? 'N/A') ?></h2>
            <div class="room-tags">
                <span class="tag ac"><?= htmlspecialchars($student['roomType'] ?? 'N/A') ?></span>
                <span class="tag beds"><?= htmlspecialchars($student['roomOption'] ?? 'N/A') ?></span>
            </div>
        </div>

        <div class="room-images">
            <h3>Room Preview</h3>
            <div class="image-grid">
                <img src="../../assets/img/room/room.png" alt="Room View 1">
                <img src="../../assets/img/study.png" alt="Room View 2">
                <img src="../../assets/img/fan.png" alt="Room View 3">
            </div>
        </div>

        <div class="room-actions">
            <a href="../Student-dashboard/complaint.php"><button>Raise Complaint</button></a>
            <a href="../Student-dashboard/complaint.php"><button>Request Room Change</button></a>
            <a href="../Student-dashboard/complaint.php"><button>Contact Warden</button></a>
        </div>
    <?php else: ?>
        <p>No room assigned yet.</p>
    <?php endif; ?>
    </div>
</div>

<?php include('D:/Xampp/htdocs/Hostel/student_chatbot/chat.html'); ?>
</body>
</html>
