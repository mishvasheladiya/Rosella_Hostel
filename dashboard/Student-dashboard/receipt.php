<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "hostel");
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

if (!isset($_SESSION['email'])) {
    header("Location: /Hostel/login.php");
    exit;
}

$email = $_SESSION['email'];

$student_stmt = $conn->prepare("SELECT * FROM student WHERE email = ?");
$student_stmt->bind_param("s", $email);
$student_stmt->execute();
$student_result = $student_stmt->get_result();

if ($student_result->num_rows === 0) {
    die("Student not found.");
}

$student = $student_result->fetch_assoc();
$roomNumber = $student['roomNumber'];

// Get last payment for that room
$payment_stmt = $conn->prepare("SELECT * FROM fees_payments WHERE room = ? ORDER BY id DESC LIMIT 1");
$payment_stmt->bind_param("s", $roomNumber);
$payment_stmt->execute();
$payment_result = $payment_stmt->get_result();

if ($payment_result->num_rows === 0) {
    echo "<script>alert('Payment pending. No receipt available yet.'); window.location.href='/Hostel/fees-payment.php';</script>";
    exit;
}

$payment = $payment_result->fetch_assoc();

// Close DB connections
$student_stmt->close();
$payment_stmt->close();
$conn->close();

// Base URL
if (!isset($base_url)) {
    $base_url = '/Hostel/';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Fees Receipt - ROSELLE Hostel</title>
  <link rel="stylesheet" href="<?= $base_url; ?>assets/css/recipe-style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
</head>
<body>

<div class="receipt-container">
  <div class="receipt-header">
    <h1>ROSELLE Hostel</h1>
    <p>Student Hostel Fee Receipt</p>
  </div>

  <div class="receipt-body">
    <div class="receipt-row">
      <div><strong>Receipt No:</strong> #R-<?= date("Y") . str_pad($payment['room'], 3, "0", STR_PAD_LEFT) ?></div>
      <div><strong>Date:</strong> <?= date("d M Y", strtotime($payment['date'])) ?></div>
    </div>
    <div class="receipt-row">
      <div><strong>Student Name:</strong> <?= htmlspecialchars($payment['name']) ?></div>
      <div><strong>Room No:</strong> <?= htmlspecialchars($payment['room']) ?></div>
    </div>
    <div class="receipt-row">
      <div><strong>Email:</strong> <?= htmlspecialchars($student['email']) ?></div>
      <div><strong>Phone no:</strong> <?= htmlspecialchars($student['phone']) ?></div>
    </div>
    <div class="receipt-row">
      <div><strong>Course:</strong> <?= htmlspecialchars($student['course']) ?></div>
      <div><strong>University:</strong> <?= htmlspecialchars($student['university']) ?></div>
    </div>
    <div class="receipt-row">
      <div><strong>Payment Mode:</strong> <?= htmlspecialchars($payment['method']) ?></div>
      <div><strong>Transaction ID:</strong> TXN<?= rand(30000, 99999999) ?></div>
    </div>
    <div class="amount-box">
      <strong>Total Amount Paid:</strong> ₹ <?= number_format($payment['amount']) ?>
    </div>
  </div>

  <div class="receipt-footer">
    <button onclick="window.print()"><i class="fa-solid fa-download"></i> Download Receipt</button>
  </div>
</div>

</body>
</html>
