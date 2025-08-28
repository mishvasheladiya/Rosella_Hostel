<?php
session_start();

if (!isset($base_url)) {
    $base_url = '/Hostel/';
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = mysqli_connect("localhost", "root", "", "hostel");
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

if (!isset($_GET['id'])) {
    header("Location: admin-student.php");
    exit;
}
$student_id = intval($_GET['id']);

$student_query = "SELECT * FROM student WHERE id = ?";
$stmt = $conn->prepare($student_query);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$student = $stmt->get_result()->fetch_assoc();

if (!$student) {
    die("Student not found.");
}

$current_room = $student['roomNumber'] ?? null;

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_room = $_POST['roomNumber']; // store actual roomNumber (string)

    // Get old room info
    if (!empty($current_room)) {
        $oldRoomStmt = $conn->prepare("UPDATE rooms SET occupiedBeds = GREATEST(occupiedBeds - 1,0), status = 'Available' WHERE roomNumber = ?");
        $oldRoomStmt->bind_param("s", $current_room);
        $oldRoomStmt->execute();
    }

    // Get new room details
    $room_check = $conn->prepare("SELECT totalBeds, occupiedBeds FROM rooms WHERE roomNumber = ?");
    $room_check->bind_param("s", $new_room);
    $room_check->execute();
    $room_result = $room_check->get_result()->fetch_assoc();

    if ($room_result && $room_result['occupiedBeds'] < $room_result['totalBeds']) {
        // Update student with new room
        $update_stmt = $conn->prepare("UPDATE student SET roomNumber = ? WHERE id = ?");
        $update_stmt->bind_param("si", $new_room, $student_id);

        if ($update_stmt->execute()) {
            // Increment new room occupancy
            $update_room = $conn->prepare("UPDATE rooms SET occupiedBeds = occupiedBeds + 1, status = IF(occupiedBeds+1 >= totalBeds,'Occupied','Available') WHERE roomNumber = ?");
            $update_room->bind_param("s", $new_room);
            $update_room->execute();

            $_SESSION['success_message'] = 'Room updated successfully!';
            header("Location: admin-student.php");
            exit;
        } else {
            $error_message = "Error updating student: " . $conn->error;
        }
    } else {
        $error_message = "Selected room is already full!";
    }
}

// Fetch all rooms
$rooms_result = $conn->query("SELECT roomNumber, roomType, totalBeds, occupiedBeds, status FROM rooms");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student Room - ROSELLE Hostel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="<?= $base_url; ?>assets/css/admin-edit-style.css" />
</head>
<body>
    <?php include('admin-header.php'); ?>
    <div class="dashboard-container">
        <?php include('admin-slidebar.php'); ?>
        
        <main class="main-content">
            <div class="page-header">
                <h1 class="page-title">Edit Student Room</h1>
            </div>
            
            <?php if (isset($error_message)): ?>
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i> <?php echo $error_message; ?>
            </div>
            <?php endif; ?>
            
            <div class="edit-container">
                <div class="student-info">
                    <h3>Student Information</h3>
                    <p><b>Name:</b> <?= htmlspecialchars($student['firstName'] . ' ' . ($student['lastName'] ?? '')) ?></p>
                    <p><b>Email:</b> <?= htmlspecialchars($student['email']) ?></p>
                    <p><b>Current Room:</b> <?= htmlspecialchars($current_room ?? 'Not Assigned') ?></p>
                </div>

                <form method="POST" class="form-box">
                    <div class="form-group">
                        <label for="roomNumber">Select New Room:</label>
                        <select name="roomNumber" id="roomNumber" required>
                            <option value="">-- Choose Room --</option>
                            <?php 
                            if ($rooms_result) {
                                while ($room = $rooms_result->fetch_assoc()): 
                                    $isFull = ($room['occupiedBeds'] >= $room['totalBeds']);
                                    $statusClass = $isFull ? 'room-full' : 'room-available';
                                    $statusText = $isFull ? 'Full' : 'Available';
                            ?>
                                <option value="<?= htmlspecialchars($room['roomNumber']) ?>" 
                                    <?= ($room['roomNumber'] == $current_room) ? 'selected' : '' ?>
                                    <?= $isFull ? 'disabled' : '' ?>>
                                    <?= htmlspecialchars($room['roomNumber']) ?> (<?= $room['roomType'] ?>) 
                                    - <?= $room['occupiedBeds'] ?>/<?= $room['totalBeds'] ?> beds
                                    <span class="room-status <?= $statusClass ?>"><?= $statusText ?></span>
                                </option>
                            <?php 
                                endwhile;
                            } else {
                                echo '<option value="">No rooms available</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="action-btn">
                            <i class="fas fa-bed"></i> Update Room
                        </button>
                        <a href="admin-student.php" class="btn btn-cancel">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script>
        // Form submission loading state
        document.querySelector('form').addEventListener('submit', function() {
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.classList.add('loading');
            submitBtn.innerHTML = '<i class="fas fa-spinner"></i> Updating...';
        });
        
        // Enhance select element with room information tooltips
        document.getElementById('roomNumber').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            if (selectedOption.disabled) {
                alert('This room is already full. Please select another room.');
                this.value = '';
            }
        });
        
        // Add visual indicator for disabled options
        const roomSelect = document.getElementById('roomNumber');
        for (let i = 0; i < roomSelect.options.length; i++) {
            if (roomSelect.options[i].disabled) {
                roomSelect.options[i].style.backgroundColor = '#f8d7da';
                roomSelect.options[i].style.color = '#721c24';
            }
        }
    </script>
</body>
</html>