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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $university = mysqli_real_escape_string($conn, $_POST['university']);
    $course = mysqli_real_escape_string($conn, $_POST['course']);

    $email = $_SESSION['email'];
    
    $update_query = "UPDATE student SET 
                    phone = '$phone',
                    dob = '$dob',
                    city = '$city',
                    university = '$university',
                    course = '$course'
                    WHERE email = '$email'";
    
    if (mysqli_query($conn, $update_query)) {
        $success = "Profile updated successfully!";
    } else {
        $error = "Error updating profile: " . mysqli_error($conn);
    }
}

// Fetch student data using email from session
$email = $_SESSION['email'];
$query = "SELECT * FROM student WHERE email = '$email'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $student = mysqli_fetch_assoc($result);
    $firstName = $student['firstName'];
} else {
    die("Student not found.");
}

$base_url = '/Hostel/';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Profile - Student Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="<?= $base_url; ?>assets/css/my-profile.css" />
    <link rel="stylesheet" href="<?= $base_url; ?>assets/css/dashboard.css" />
</head>

<body>
  <?php include('../Student-dashboard/student-header.php'); ?>

  <div class="dashboard-container">
    <?php include('student-sidebar.php'); ?>

    <main class="main-content">
      <h1>My Profile</h1>
      
      <?php if (isset($success)): ?>
        <div class="alert alert-success"><?= $success ?></div>
      <?php endif; ?>
      
      <?php if (isset($error)): ?>
        <div class="alert alert-error"><?= $error ?></div>
      <?php endif; ?>
      
      <form class="profile-form" method="POST" action="">
        <section class="info-section">
          <h2>Personal Information</h2>
          <div class="info-grid">
            <div class="form-group">
              <label for="firstName">First Name</label>
              <input type="text" id="firstName" name="firstName" value="<?= htmlspecialchars($student['firstName']) ?>" readonly class="read-only-field">
            </div>
            
            <div class="form-group">
              <label for="lastName">Last Name</label>
              <input type="text" id="lastName" name="lastName" value="<?= htmlspecialchars($student['lastName']) ?>" readonly class="read-only-field">
            </div>
            
            <div class="form-group">
              <label>Email</label>
              <input type="text" value="<?= htmlspecialchars($student['email']) ?>" readonly class="read-only-field">
            </div>
            
            <div class="form-group">
              <label for="phone">Phone</label>
              <input type="tel" id="phone" name="phone" value="<?= htmlspecialchars($student['phone']) ?>" required>
            </div>
            
            <div class="form-group">
              <label for="dob">Date of Birth</label>
              <input type="date" id="dob" name="dob" value="<?= htmlspecialchars($student['dob']) ?>" required>
            </div>
            
            <div class="form-group">
              <label for="city">City</label>
              <input type="text" id="city" name="city" value="<?= htmlspecialchars($student['city']) ?>" required>
            </div>
          </div>
        </section>

        <section class="info-section">
          <h2>University Information</h2>
          <div class="info-grid">
            <div class="form-group">
              <label for="university">University Name</label>
              <input type="text" id="university" name="university" value="<?= htmlspecialchars($student['university']) ?>" required>
            </div>
            
            <div class="form-group">
              <label for="course">Course</label>
              <input type="text" id="course" name="course" value="<?= htmlspecialchars($student['course']) ?>" required>
            </div>
          </div>
        </section>
        
        <div class="form-actions">
          <a href="<?= $base_url ?>dashboard/Student-dashboard/student-dashboard.php" class="btn btn-secondary">Cancel</a>
          <button type="submit" class="edit-profile-btn">Save Changes</button>
        </div>
      </form>
    </main>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Smooth scroll for main content
      const mainContent = document.querySelector('.main-content');
      if (mainContent) {
        mainContent.scrollTop = 0;
      }
    });
  </script>
</body>
</html>