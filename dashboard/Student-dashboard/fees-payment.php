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

// Get student info
$student_stmt = $conn->prepare("SELECT * FROM student WHERE email = ?");
$student_stmt->bind_param("s", $email);
$student_stmt->execute();
$student_result = $student_stmt->get_result();

if ($student_result->num_rows === 0) {
    die("Student not found.");
}

$student = $student_result->fetch_assoc();
$roomNumber = $student['roomNumber'];
$name = $student['firstName'] . ' ' . $student['lastName'];

$message = '';
$hasPayment = false;

// ✅ Check global lock from fees_lock
$lockResult = mysqli_query($conn, "SELECT is_locked FROM fees_lock WHERE id = 1");
if ($lockResult && mysqli_num_rows($lockResult) > 0) {
    $lockRow = mysqli_fetch_assoc($lockResult);
    $globalLock = $lockRow['is_locked'] == 1;
} else {
    $globalLock = 0; // default unlocked if no record
}


// If admin unlocked → reset hasPayment
if (!$globalLock) {
    $hasPayment = false;
}


// Handle form submission only if not locked
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$globalLock) {
    $amount = $_POST['amount'];
    $method = $_POST['method'];
    $date   = $_POST['date'];

    $insert_stmt = $conn->prepare(
        "INSERT INTO fees_payments (`name`, `email`, `room`, `amount`, `method`, `date`, `is_active`, `status`) 
         VALUES (?, ?, ?, ?, ?, ?, 1, 'Paid')"
    );
    // name (s), email (s), room (s), amount (d), method (s), date (s)
$insert_stmt->bind_param("ssssss", $name, $email, $roomNumber, $amount, $method, $date);

    if ($insert_stmt->execute()) {
        $message = "✅ Your fees payment has been recorded successfully!";
        $hasPayment = true;
    } else {
        $message = "❌ Error recording payment: " . $conn->error;
    }
    $insert_stmt->close();
} else {
    // Check if an active payment exists
    $payment_stmt = $conn->prepare(
        "SELECT id FROM fees_payments 
         WHERE `email` = ? AND `room` = ? AND `is_active` = 1 
         ORDER BY id DESC LIMIT 1"
    );
    $payment_stmt->bind_param("ss", $email, $roomNumber);
    $payment_stmt->execute();
    $payment_result = $payment_stmt->get_result();
    if ($payment_result && $payment_result->num_rows > 0) {
        $hasPayment = true;
    }
    $payment_stmt->close();
}

$student_stmt->close();
$conn->close();

if (!isset($base_url)) {
    $base_url = '/Hostel/';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Student Dashboard - ROSELLE Hostel</title>
  <link rel="stylesheet" href="<?= $base_url; ?>assets/css/fees-style.css" />
</head>
<body>

<?php include('student-header.php'); ?>
<div class="dashboard-container">
  <?php include('student-sidebar.php'); ?>

  <main class="main-content">
    <div class="fees-form-wrapper">

    <?php if ($globalLock): ?>
        <p class="info-message" style="color:red;">🚫 Payments are currently locked. You cannot pay now.</p>
    <?php elseif ($message): ?>
        <p class="success-message"><?= htmlspecialchars($message) ?></p>
    <?php elseif ($hasPayment): ?>
        <p class="info-message">
        ✅ Payment already made. Download your receipt below.
        </p>
    <?php endif; ?>

    <?php if (!$globalLock): ?>
    <form action="" method="POST" class="fees-form">

  <!-- Full Name -->
  <div class="form-row">
    <div class="form-group full">
      <label>Full Name:</label>
      <input type="text" value="<?= htmlspecialchars($name) ?>" readonly>
    </div>
  </div>

  <!-- Email and Room Number side by side -->
  <div class="form-row">
    <div class="form-group">
      <label>Email:</label>
      <input type="text" value="<?= htmlspecialchars($email) ?>" readonly>
    </div>
    <div class="form-group">
      <label>Room Number:</label>
      <input type="text" value="<?= htmlspecialchars($roomNumber) ?>" readonly>
    </div>
  </div>

  <!-- Amount -->
  <div class="form-row">
    <div class="form-group full">
      <label>Amount:</label>
      <input type="number" name="amount" step="0.01" placeholder="Enter amount" required>
    </div>
  </div>

  <!-- Payment Method and Date side by side -->
  <div class="form-row">
    <div class="form-group">
      <label>Payment Method:</label>
      <select name="method" required>
        <option value="" disabled selected>Select payment method</option>
        <option value="Cash">Cash</option>
        <option value="Card">Debit/Credit Card</option>
        <option value="Online">Online</option>
      </select>
    </div>
    <div class="form-group">
      <label>Date:</label>
      <input type="date" name="date" required>
    </div>
  </div>

  <!-- Submit Button -->
  <div class="form-row center">
    <button type="submit" class="submit-btn">Submit Payment</button>
  </div>
</form>

<?php endif; ?>


    <?php if ($hasPayment): ?>
        <div class="receipt-download">
            <p>📥 Download your receipt:</p>
            <a href="receipt.php" class="download-btn">Download Receipt</a>
        </div>
    <?php endif; ?>

  </main>
</div>
  <!-- Chatbot (relative path instead of hardcoded) -->
  <?php include($_SERVER['DOCUMENT_ROOT'].'/Hostel/student_chatbot/chat.html'); ?>
</body>
</html>
