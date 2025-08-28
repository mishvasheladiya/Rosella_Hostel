<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    echo "<script>alert('Please login first'); window.location.href='/Hostel/componments/Login/login.php';</script>";
    exit;
}

// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "hostel");
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Get email from session
$email = $_SESSION['email'];

// 1️⃣ Get student details (SAFE)
$studentSql = "SELECT * FROM student WHERE email = ?";
$stmt = $conn->prepare($studentSql);
$stmt->bind_param("s", $email);
$stmt->execute();
$studentResult = $stmt->get_result();

if (!$studentResult || $studentResult->num_rows == 0) {
    die("Student not found.");
}
$student = $studentResult->fetch_assoc();

// 2️⃣ Get fee status (use student ID instead of firstName)
$feeSql = "SELECT * FROM fees_payments WHERE email = ? AND is_active = 1 ORDER BY date DESC LIMIT 1";
$stmt = $conn->prepare($feeSql);
$stmt->bind_param("s", $student['email']); 

$stmt->execute();
$feeResult = $stmt->get_result();

$feeStatus = "Unpaid";
if ($feeResult && $feeResult->num_rows > 0) {
    $fee = $feeResult->fetch_assoc();
    $feeStatus = "Paid (₹" . htmlspecialchars($fee['amount']) . " on " . htmlspecialchars($fee['date']) . ")";
}

$base_url = '/Hostel/';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Student Dashboard - ROSELLE Hostel</title>

  <!-- Styles -->
  <link rel="stylesheet" href="<?= $base_url; ?>assets/css/student-header.css" />
  <link rel="stylesheet" href="<?= $base_url; ?>assets/css/sidebar.css" />
    <link rel="stylesheet" href="<?= $base_url; ?>assets/css/dashboard.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
</head>

<body>

  <!-- Top Bar + Navbar -->
  <?php include('student-header.php'); ?><br>

  <!-- Sidebar + Main Content Container -->
  <div class="dashboard-container">
    
    <!-- Sidebar -->
    <?php include('student-sidebar.php'); ?>

    <!-- Main Content -->
    <main class="main-content">

      <section class="status-section">
        <div class="status-box">
          <h3>Room Type</h3>
          <p><?= htmlspecialchars($student['roomType'] ?? 'N/A'); ?></p>
        </div>
        <div class="status-box">
          <h3>Fees Status</h3>
          <p><?= $feeStatus; ?></p>
        </div>
        <div class="status-box">
          <h3>Complaints</h3>
          <p>Active</p>
        </div>
      </section>

<section class="info-section">
        <h2>Personal Information
          <a href="<?= $base_url; ?>dashboard/Student-dashboard/my-profile.php" class="edit-profile-btn">
            <i class="fas fa-edit"></i> Edit
          </a>
        </h2>
        <div class="info-grid">
          <div>
            <strong>Full Name</strong>
            <?= $student['firstName'] . ' ' . $student['lastName']; ?>
          </div>
          <div>
            <strong>Username</strong>
            <?= $student['firstName'] . ' ' . $student['lastName']; ?>
          </div>
          <div>
            <strong>Email</strong>
            <?= $student['email']; ?>
          </div>
          <div>
            <strong>Phone</strong>
            <?= $student['phone']; ?>
          </div>
          <div>
            <strong>Date of Birth</strong>
            <?= $student['dob']; ?>
          </div>
          <div>
            <strong>Address</strong>
            <?= $student['city'] . ', ' . $student['state']; ?>
          </div>
        </div>
      </section>

      <section class="info-section">
        <h2>University Information
          <a href="<?= $base_url; ?>dashboard/Student-dashboard/my-profile.php" class="edit-profile-btn">
            <i class="fas fa-edit"></i> Edit
          </a>
        </h2>
        <div class="info-grid">
          <div>
            <strong>University Name</strong>
            <?= $student['university']; ?>
          </div>
          <div>
            <strong>Course</strong>
            <?= $student['course']; ?>
          </div>
        </div>
      </section>
    </main>
  </div>

  <!-- Chatbot (relative path instead of hardcoded) -->
  <?php include($_SERVER['DOCUMENT_ROOT'].'/Hostel/student_chatbot/chat.html'); ?>

</body>
</html>
