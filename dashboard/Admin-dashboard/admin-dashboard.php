<?php
if (!isset($base_url)) {
  $base_url = '/Hostel/';
}

$conn = mysqli_connect("localhost", "root", "", "hostel");
if (!$conn) {
  die("Database connection failed: " . mysqli_connect_error());
}

// Total Students
$totalStudents = $conn->query("SELECT COUNT(*) AS total FROM student")->fetch_assoc()['total'];

// Available Rooms
$availableRooms = $conn->query("SELECT COUNT(*) AS total FROM rooms WHERE status = 'available'")->fetch_assoc()['total'];

// Pending Complaints
$pendingComplaints = $conn->query("SELECT COUNT(*) AS total FROM complaints WHERE status = 'pending'")->fetch_assoc()['total'];

// Total Fees Collected
$totalFees = $conn->query("SELECT SUM(amount) AS total FROM fees_payments")->fetch_assoc()['total'];
if (!$totalFees) {
  $totalFees = 0;
}

// Check if fees_lock table exists, if not create it
$tableCheck = $conn->query("SHOW TABLES LIKE 'fees_lock'");
if ($tableCheck->num_rows == 0) {
    // Create the fees_lock table if it doesn't exist
    $conn->query("CREATE TABLE fees_lock (
        id INT PRIMARY KEY AUTO_INCREMENT,
        is_locked TINYINT(1) DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    
    // Insert initial row
    $conn->query("INSERT INTO fees_lock (is_locked) VALUES (0)");
}

// Check if fees_payments table exists, if not create it
$tableCheck2 = $conn->query("SHOW TABLES LIKE 'fees_payments'");
if ($tableCheck2->num_rows == 0) {
    // Create the fees_payments table if it doesn't exist
    $conn->query("CREATE TABLE fees_payments (
        id INT PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(100) NOT NULL,
        room VARCHAR(50) NOT NULL,
        amount DECIMAL(10,2) NOT NULL,
        method VARCHAR(50) NOT NULL,
        date DATE NOT NULL,
        is_active TINYINT(1) DEFAULT 1,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
} else {
    // Check if is_active column exists in fees_payments table
    $columnCheck = $conn->query("SHOW COLUMNS FROM fees_payments LIKE 'is_active'");
    if ($columnCheck->num_rows == 0) {
        // Add the is_active column if it doesn't exist
        $conn->query("ALTER TABLE fees_payments ADD COLUMN is_active TINYINT(1) DEFAULT 1 AFTER date");
    }
}

// ----- GLOBAL LOCK HANDLING -----
if (isset($_GET['lock_all'])) {
  $conn->query("UPDATE fees_lock SET is_locked = 1 WHERE id = 1");
  $lockMessage = "<div class='notification error'><i class='fas fa-lock'></i> All student payments are now LOCKED.</div>";
}
if (isset($_GET['unlock_all'])) {
  $conn->query("UPDATE fees_lock SET is_locked = 0 WHERE id = 1");
  $lockMessage = "<div class='notification success'><i class='fas fa-unlock'></i> All student payments are now UNLOCKED.</div>";
}

// Get lock status
$lockResult = $conn->query("SELECT is_locked FROM fees_lock WHERE id = 1");
$lockRow = $lockResult->fetch_assoc();
$isLocked = (int)$lockRow['is_locked'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Dashboard - ROSELLE Hostel</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
  <link rel="stylesheet" href="<?= $base_url; ?>assets/css/admin-dashboard-style.css" />
</head>

<body>
  <!-- Include Top Bar + Nav -->
  <?php include('admin-header.php'); ?>

  <div class="dashboard-container">
    <?php include('admin-slidebar.php'); ?>

    <!-- Main Content -->
    <main class="main-content">
      <section class="status-section">
        <div class="status-box">
          <div class="card-icon">
            <i class="fa-solid fa-user-graduate"></i>
          </div>
          <div class="card-content">
            <h2><?= $totalStudents; ?></h2>
            <p>Total Students</p>
          </div>
        </div>
        <div class="status-box">
          <div class="card-icon">
            <i class="fa-solid fa-bed"></i>
          </div>
          <div class="card-content">
            <h2><?= $availableRooms; ?></h2>
            <p>Available Rooms</p>
          </div>
        </div>
        <div class="status-box">
          <div class="card-icon">
            <i class="fa-solid fa-file-circle-check"></i>
          </div>
          <div class="card-content">
            <h2><?= $pendingComplaints; ?></h2>
            <p>Pending Complaints</p>
          </div>
        </div>
        <div class="status-box">
          <div class="card-icon">
            <i class="fa-solid fa-sack-dollar"></i>
          </div>
          <div class="card-content">
            <h2>₹ <?= $totalFees; ?></h2>
            <p>Total Fees Collected</p>
          </div>
        </div>
      </section>

      <!-- Admin Payment Management - UNCHANGED -->
      <div class="table-container">
        <div class="table-header">
          <h2>Manage Student Payments</h2>
          <div class="lock-controls">
            <?php if ($isLocked): ?>
              <a href="?unlock_all=1" class="lock-btn unlock">
                <i class="fas fa-unlock"></i> Unlock All Payments
              </a>
            <?php else: ?>
              <a href="?lock_all=1" class="lock-btn lock">
                <i class="fas fa-lock"></i> Lock All Payments
              </a>
            <?php endif; ?>
          </div>
        </div>

        <?php
        // Display lock message if set
        if (isset($lockMessage)) {
          echo $lockMessage;
        }
        ?>

        <table>
          <thead>
            <tr>
              <th>Student Name</th>
              <th>Room</th>
              <th>Last Payment Amount</th>
              <th>Method</th>
              <th>Date</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $query = "
              SELECT fp.*
              FROM fees_payments fp
              INNER JOIN (
                SELECT name, room, MAX(id) AS max_id
                FROM fees_payments
                GROUP BY name, room
              ) latest ON fp.id = latest.max_id
              ORDER BY fp.date DESC, fp.id DESC
            ";
            $result = $conn->query($query);

            if ($result && $result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                $rowName  = htmlspecialchars($row['name']);
                $rowRoom  = htmlspecialchars($row['room']);
                $amount   = htmlspecialchars($row['amount']);
                $method   = htmlspecialchars($row['method']);
                $date     = htmlspecialchars($row['date']);
                $status   = (int)$row['is_active'] === 1 
                            ? "<span class='status allocated'>Active</span>"
                            : "<span class='status resolved'>Reset</span>";

                echo "<tr>
                        <td>{$rowName}</td>
                        <td>{$rowRoom}</td>
                        <td>₹ {$amount}</td>
                        <td>{$method}</td>
                        <td>{$date}</td>
                        <td>{$status}</td>
                      </tr>";
              }
            } else {
              echo "<tr><td colspan='6'>No payment records found.</td></tr>";
            }

            $conn->close();
            ?>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</body>
</html>
