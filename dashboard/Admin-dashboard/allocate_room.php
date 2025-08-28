<?php
if (!isset($base_url)) {
    $base_url = '/Hostel/';
}

$conn = mysqli_connect("localhost", "root", "", "hostel");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// First, let's check the structure of the student table
$result = mysqli_query($conn, "DESCRIBE student");
$studentColumns = [];
while ($row = mysqli_fetch_assoc($result)) {
    $studentColumns[] = $row['Field'];
}

$studentId = intval($_GET['id'] ?? 0);
$student = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM student WHERE id=$studentId"));

if (!$student) {
    die("Student not found");
}

// Extract bed count from roomOption (e.g., "4-Bed")
$requiredBeds = 0;
if (!empty($student['roomOption'])) {
    if (preg_match('/(\d+)\s*-?\s*Bed/i', $student['roomOption'], $matches)) {
        $requiredBeds = (int)$matches[1];
    } else {
        $requiredBeds = intval($student['roomOption']);
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $roomId = intval($_POST['room_id'] ?? 0);

    // Get room details
    $roomResult = mysqli_query($conn, "SELECT roomNumber FROM rooms WHERE id = $roomId");
    if (!$roomResult || mysqli_num_rows($roomResult) == 0) {
        die("Selected room not found.");
    }
    $room = mysqli_fetch_assoc($roomResult);
    $roomNumberStr = $room['roomNumber'];

    // Update student table: store both room_id and roomNumber
    $updateStudent = mysqli_query($conn, "
        UPDATE student 
        SET status='Allocated', 
            room_id=$roomId,
            roomNumber='$roomNumberStr'
        WHERE id=$studentId
    ");

    if (!$updateStudent) {
        die("Failed to update student: " . mysqli_error($conn));
    }

    // Increment occupiedBeds
    $updateRoom = mysqli_query($conn, "
        UPDATE rooms 
        SET occupiedBeds = occupiedBeds + 1 
        WHERE id=$roomId
    ");
    
    if (!$updateRoom) {
        die("Failed to update room occupancy: " . mysqli_error($conn));
    }

    // Redirect after success
    header("Location: {$base_url}dashboard/Admin-dashboard/admin-student.php?success=1");
    exit;
}

// Fetch available rooms
$query = "
    SELECT * 
    FROM rooms
    WHERE roomType = '" . mysqli_real_escape_string($conn, $student['roomType']) . "'
      AND occupiedBeds < totalBeds
";
if ($requiredBeds > 0) {
    $query .= " AND totalBeds = $requiredBeds";
}
$query .= " ORDER BY CAST(roomNumber AS UNSIGNED) ASC";

$roomsQuery = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Allocate Room</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="<?= $base_url; ?>assets/css/admin-allocate_room.css">
</head>
<body>
    <?php include('admin-header.php'); ?>
    <div class="dashboard-container">
        <?php include('admin-slidebar.php'); ?>
        
        <main class="main-content">
            <div class="page-header">
                <h1 class="page-title">Allocate Room</h1>
            </div>
            
            <div class="allocation-container">
                <div class="student-info">
                    <h3>Student Information</h3>
                    <p><b>Name:</b> <?= htmlspecialchars($student['firstName'] . ' ' . $student['lastName']); ?></p>
                    <p><b>Email:</b> <?= htmlspecialchars($student['email']); ?></p>
                    <p><b>Room Type:</b> <?= htmlspecialchars($student['roomType']); ?></p>
                    <p><b>Room Option:</b> <?= htmlspecialchars($student['roomOption']); ?></p>
                </div>

                <?php if (mysqli_num_rows($roomsQuery) > 0): ?>
                    <form method="POST" class="form-box">
                        <div class="form-group">
                            <label for="room_id">Select Room:</label>
                            <select name="room_id" id="room_id" required>
                                <option value="">-- Choose Room --</option>
                                <?php while ($room = mysqli_fetch_assoc($roomsQuery)): ?>
                                    <?php
                                        if ($room['occupiedBeds'] == $room['totalBeds']) {
                                            $statusClass = 'option-full';
                                        } elseif ($room['occupiedBeds'] > 0) {
                                            $statusClass = 'option-partial';
                                        } else {
                                            $statusClass = 'option-available';
                                        }
                                    ?>
                                    <option value="<?= $room['id']; ?>" class="<?= $statusClass; ?>">
                                        Room <?= htmlspecialchars($room['roomNumber']); ?> 
                                        (<?= $room['occupiedBeds']; ?>/<?= $room['totalBeds']; ?> beds occupied)
                                        - <?= $room['roomType']; ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <div class="form-actions">
                            <button type="submit" name="submit" class="action-btn">
                                <i class="fas fa-bed"></i> Allocate Room
                            </button>
                            <a href="<?= $base_url ?>dashboard/Admin-dashboard/admin-student.php" class="btn btn-cancel">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                        </div>
                    </form>
                <?php else: ?>
                    <div class="alert alert-error">
                        <i class="fas fa-exclamation-circle"></i> 
                        No available rooms match this student's preference.
                    </div>
                    <div class="form-actions">
                        <a href="<?= $base_url ?>dashboard/Admin-dashboard/admin-student.php" class="btn btn-cancel">
                            <i class="fas fa-arrow-left"></i> Back to Students
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <script>
        // Form submission loading state
        document.querySelector('form')?.addEventListener('submit', function() {
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.classList.add('loading');
            submitBtn.innerHTML = '<i class="fas fa-spinner"></i> Allocating...';
        });
        
        // Add visual indicator for disabled options
        const roomSelect = document.getElementById('room_id');
        if (roomSelect) {
            for (let i = 0; i < roomSelect.options.length; i++) {
                if (roomSelect.options[i].classList.contains('option-full')) {
                    roomSelect.options[i].style.backgroundColor = '#f8d7da';
                    roomSelect.options[i].style.color = '#721c24';
                }
            }
        }
    </script>
</body>
</html>
