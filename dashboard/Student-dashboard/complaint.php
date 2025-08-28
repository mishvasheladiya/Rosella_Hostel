<?php
session_start();

if (!isset($_SESSION['email'])) {
    $base_url = '/Hostel/';
    echo "<script>alert('Please login first.'); window.location.href='" . $base_url . "componments/Login/login.php';</script>";
    exit;
}

$conn = mysqli_connect("localhost", "root", "", "hostel");
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$email = $_SESSION['email'];
$query = "SELECT * FROM student WHERE email = '$email'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $student = mysqli_fetch_assoc($result);
    $firstName = $student['firstName'];
    $lastName = $student['lastName'];
    $roomNumber = $student['roomNumber'];
    $fullName = $firstName . ' ' . $lastName;
} else {
    die("Student not found.");
}

if (!isset($base_url)) {
    $base_url = '/Hostel/';
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = mysqli_real_escape_string($conn, $fullName);
    $room = mysqli_real_escape_string($conn, $roomNumber);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $email = mysqli_real_escape_string($conn, $_SESSION['email']);

    // Check if complaints table has the required columns
    $check_table = mysqli_query($conn, "SHOW COLUMNS FROM complaints LIKE 'status'");
    $status_column_exists = (mysqli_num_rows($check_table) > 0);
    
    $check_table2 = mysqli_query($conn, "SHOW COLUMNS FROM complaints LIKE 'created_at'");
    $created_at_column_exists = (mysqli_num_rows($check_table2) > 0);
    
    if ($status_column_exists && $created_at_column_exists) {
        $sql = "INSERT INTO complaints (name, email, room_no, category, description, status, created_at)
                VALUES ('$name', '$email', '$room', '$category', '$description', 'Pending', NOW())";
    } else {
        // Fallback if columns don't exist
        $sql = "INSERT INTO complaints (name, email, room_no, category, description)
                VALUES ('$name', '$email', '$room', '$category', '$description')";
    }

    if (mysqli_query($conn, $sql)) {
        echo "
            <script>
                alert('Your complaint has been submitted successfully!');
                window.location.href='my-complaints.php';
            </script>
        ";
        exit;
    } else {
        $error_message = "Error: " . mysqli_error($conn);
        echo "
            <script>
                alert('$error_message');
            </script>
        ";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Raise a Complaint - ROSELLE Hostel</title>

  <!-- Styles -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Styles -->
  <style>
    <?php 
      include('../../assets/css/complaint-style.css'); 
    ?>
  </style>
</head>

<body>

  <!-- Top Header -->
  <?php include('student-header.php'); ?>

  <!-- Page Layout -->
  <div class="dashboard-container">
    
    <!-- Sidebar -->
    <?php include('student-sidebar.php'); ?>

    <!-- Main Content -->
    <main class="main-content">
      <div class="complaint-form-wrapper">
        <h2>Raise a Complaint</h2>
        <form class="complaint-form" method="post" action="">

          <!-- Name & Room -->
          <div class="form-row">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($fullName); ?>" readonly />
            </div>

            <div class="form-group">
              <label for="room">Room No</label>
              <input type="text" id="room" name="room" value="<?php echo htmlspecialchars($roomNumber); ?>" readonly />
            </div>
          </div>

          <!-- Email -->
          <div class="form-row">
            <div class="form-group full">
              <label for="email">Email</label>
              <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" readonly />
            </div>
          </div>

          <!-- Category -->
          <div class="form-row">
            <div class="form-group full">
              <label for="category">Complaint Category</label>
              <select id="category" name="category" required>
                <option value="" disabled selected>Select Category</option>
                <optgroup label="Infrastructure">
                  <option>Maintenance</option>
                  <option>Electricity Problems</option>
                  <option>Water Supply</option>
                  <option>WiFi/Internet Issues</option>
                  <option>Washroom/Toilet Issues</option>
                </optgroup>
                <optgroup label="Services">
                  <option>Food Quality</option>
                  <option>Laundry Services</option>
                  <option>Cleanliness</option>
                  <option>Common Area Cleanliness</option>
                </optgroup>
                <optgroup label="People">
                  <option>Roommate Issues</option>
                  <option>Staff Behavior</option>
                  <option>Noise Disturbance</option>
                  <option>Security Concerns</option>
                </optgroup>
                <option>Others</option>
              </select>
            </div>
          </div>

          <!-- Description -->
          <div class="form-row">
            <div class="form-group full">
              <label for="description">Complaint Description</label>
              <textarea id="description" name="description" placeholder="Please describe your issue in detail..." rows="5" required></textarea>
            </div>
          </div>

          <!-- Buttons -->
          <div class="form-row">
            <div class="button-group">
              <button type="submit"><i class="fas fa-paper-plane"></i> Submit Complaint</button>
              <a href="my-complaints.php">
                <button type="button"><i class="fas fa-list"></i> View My Complaints</button>
              </a>
            </div>
          </div>
          <p class="form-note">We'll address your complaint as soon as possible. Usually within 24-48 hours.</p>
        </form>
      </div>
    </main>
  </div>
  <?php include($_SERVER['DOCUMENT_ROOT'].'/Hostel/student_chatbot/chat.html'); ?>
</body>
</html>

<?php
// Close connection
mysqli_close($conn);
?>