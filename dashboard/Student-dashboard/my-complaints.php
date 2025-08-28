<?php
session_start();

if (!isset($_SESSION['email'])) {
    $base_url = '/Hostel/';
    echo "<script>alert('Please login first.'); window.location.href='" . $base_url . "componments/Login/login.php';</script>";
    exit;
}

if (!isset($base_url)) {
    $base_url = '/Hostel/';
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
} else {
    die("Student not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>My Complaints - ROSELLE Hostel</title>

  <!-- Styles -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap');

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: #f6f9ff;
      color: #0b1d51;
      height: 100vh;
      overflow: hidden;
      padding-top: 115px;
      /* Header height */
    }

    /* Main layout */
    .dashboard-container {
      display: flex;
      height: calc(100vh - 115px);
    }

    /* Main content area */
    .main-content {
      flex: 1;
      overflow-y: auto;
      padding: 30px;
      margin-left: 260px;
      /* Sidebar width */
    }
    
    /* Page title */
    .page-title {
      width: 100%;
      max-width: 1200px;
      margin-bottom: 25px;
    }
    
    .page-title h1 {
      color: #2c3e50;
      font-size: 28px;
      font-weight: 600;
      margin-bottom: 5px;
    }
    
    .page-title p {
      color: #7f8c8d;
      font-size: 16px;
    }
    
    /* Table container */
    .complaint-table-wrapper {
      width: 100%;
      max-width: 1200px;
      background: #fff;
      border-radius: 16px;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
      padding: 25px;
      margin-bottom: 30px;
      overflow: hidden;
      flex: 1;
      display: flex;
      flex-direction: column;
    }

    

    
    .complaint-table {
      width: 100%;
      border-collapse: collapse;
      min-width: 600px;
    }
    
    .complaint-table thead {
      background: #f8f9fa;
      position: sticky;
      top: 0;
      z-index: 1;
    }
    
    .complaint-table th {
      padding: 16px 20px;
      text-align: left;
      font-weight: 600;
      color: #2c3e50;
      border-bottom: 2px solid #e9ecef;
      font-size: 15px;
      background: #0b1d51;
      color: #fff;
    }
    
    .complaint-table td {
      padding: 16px 20px;
      border-bottom: 1px solid #e9ecef;
      color: #495057;
      font-size: 14px;
    }
    
    .complaint-table tbody tr {
      transition: all 0.3s ease;
    }
    
    .complaint-table tbody tr:hover {
      background-color: #f8f9fa;
    }
    
    .complaint-table tr:nth-child(even) {
      background: #f2f4fa;
    }
    
    /* Status tags */
    .status {
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 500;
      display: inline-block;
      text-align: center;
      min-width: 90px;
    }
    
    .status.pending {
      background: #fff3cd;
      color: #856404;
      border: 1px solid #ffeeba;
    }
    
    .status.in-progress {
      background: #d1ecf1;
      color: #0c5460;
      border: 1px solid #bee5eb;
    }
    
    .status.resolved {
      background: #d4edda;
      color: #155724;
      border: 1px solid #c3e6cb;
    }
    
    .status.rejected {
      background: #f8d7da;
      color: #721c24;
      border: 1px solid #f5c6cb;
    }
    
    /* Button container */
    .button-container {
      width: 100%;
      max-width: 1200px;
      display: flex;
      justify-content: flex-end;
      margin-top: 10px;
    }
    
    /* Button styling */
    .btn-new-complaint {
      padding: 14px 28px;
      background: #0b1d51;
      color: white;
      border: none;
      border-radius: 10px;
      font-family: 'Poppins', sans-serif;
      font-size: 16px;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      display: inline-flex;
      align-items: center;
      justify-content: center;
      text-decoration: none;
    }
    
    .btn-new-complaint:hover {
      background: #2e3d80;
      transform: translateY(-2px);
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }
    
    .btn-new-complaint i {
      margin-right: 8px;
    }
    
    /* Empty state */
    .empty-state {
      text-align: center;
      padding: 40px 0;
      color: #6c757d;
    }
    
    .empty-state i {
      font-size: 50px;
      margin-bottom: 15px;
      color: #dee2e6;
    }
    
    .empty-state p {
      font-size: 16px;
      margin-bottom: 20px;
    }
    
    /* Responsive design */
    @media (max-width: 1024px) {
      .main-content {
        margin-left: 0;
      }
      
      .student-sidebar {
        display: none;
      }
    }
    
    @media (max-width: 768px) {
      .main-content {
        padding: 20px 15px;
        height: calc(100vh - 70px);
      }
      
      .complaint-table-wrapper {
        padding: 15px;
      }
      
      .complaint-table {
        min-width: 100%;
      }
      
      .complaint-table th,
      .complaint-table td {
        padding: 12px 15px;
      }
      
      .page-title h1 {
        font-size: 24px;
      }
      
      .btn-new-complaint {
        width: 100%;
        padding: 12px 20px;
      }
      
      .button-container {
        justify-content: center;
      }
    }
  </style>
</head>
<body>

  <!-- Header -->
  <?php include('student-header.php'); ?>

  <!-- Layout -->
  <div class="dashboard-container">
    
    <!-- Sidebar -->
    <?php include('student-sidebar.php'); ?>

    <!-- Main Content -->
    <main class="main-content">
      <div class="page-title">
        <h1>My Complaints</h1>
      </div>
      
      <div class="complaint-table-wrapper">
        <div class="complaint-table-container">
          <table class="complaint-table">
            <thead>
              <tr>
                <th>Date</th>
                <th>Category</th>
                <th>Description</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $email = $_SESSION['email'];
              $query = "SELECT category, description, status, created_at FROM complaints WHERE email = '$email' ORDER BY created_at DESC";
              $result = mysqli_query($conn, $query);

              if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                  echo "<tr>";
                  // Format date to be more readable
                  $formattedDate = date("M j, Y g:i A", strtotime($row['created_at']));
                  echo "<td>" . htmlspecialchars($formattedDate) . "</td>";
                  echo "<td>" . htmlspecialchars($row['category']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['description']) . "</td>";

                  // Status with span class
                  $statusClass = strtolower(str_replace(' ', '-', $row['status']));
                  echo "<td><span class='status $statusClass'>" . htmlspecialchars($row['status']) . "</span></td>";
                  echo "</tr>";
                }
              } else {
                echo "<tr><td colspan='4' class='empty-state'>";
                echo "<i class='fas fa-clipboard-list'></i>";
                echo "<p>You haven't submitted any complaints yet.</p>";
                echo "</td></tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
      
      <div class="button-container">
        <a href="../Student-dashboard/complaint.php" class="btn-new-complaint">
          <i class="fas fa-plus-circle"></i> Raise New Complaint
        </a>
      </div>
    </main>
  </div>
<?php include('D:/Xampp/htdocs/Hostel/student_chatbot/chat.html'); ?>
</body>
</html>

<?php
// Close connection
mysqli_close($conn);
?>