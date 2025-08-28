<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management - ROSELLE Hostel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Styles -->
    <style>
        <?php 
        include('../../assets/css/admin-student.css'); 
        ?>
    </style>
</head>
<body>
    <?php
    if (!isset($base_url)) {
        $base_url = '/Hostel/';
    }

    $conn = mysqli_connect("localhost", "root", "", "hostel");
    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Check if tables exist before querying
    $tableCheck = mysqli_query($conn, "SHOW TABLES LIKE 'student'");
    if (mysqli_num_rows($tableCheck) == 0) {
        die("Error: The 'student' table doesn't exist in the database.");
    }

    // Fetch students with joined roomNumber from rooms table
    $query = "
        SELECT s.*, r.roomNumber AS actualRoomNumber
        FROM student s
        LEFT JOIN rooms r ON s.room_id = r.id
        ORDER BY s.id DESC
    ";

    $result = mysqli_query($conn, $query);

    // Check if query was successful
    if (!$result) {
        $query = "SELECT * FROM student ORDER BY id ASC";
        $result = mysqli_query($conn, $query);
        
        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }
    }

    // Get statistics
    $totalStudents = mysqli_num_rows($result);
    
    mysqli_data_seek($result, 0);
    $allocatedCount = 0;
    $pendingCount = 0;
    
    while ($student = mysqli_fetch_assoc($result)) {
        if ($student['status'] == 'Allocated') $allocatedCount++;
        if ($student['status'] == 'Pending') $pendingCount++;
    }
    
    mysqli_data_seek($result, 0);
    ?>

    <?php include('admin-header.php'); ?>
    <div class="dashboard-container">
        <?php include('admin-slidebar.php'); ?>
        <main class="main-content">
            <section class="status-section">
                <div class="status-box">
                    <h3>Total Students</h3>
                    <div class="value"><?= $totalStudents ?></div>
                </div>
                <div class="status-box">
                    <h3>Allocated</h3>
                    <div class="value"><?= $allocatedCount ?></div>
                </div>
                <div class="status-box">
                    <h3>Pending Allocation</h3>
                    <div class="value"><?= $pendingCount ?></div>
                </div>
            </section>
            
            <!-- Table Controls -->
            <div class="table-controls">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search students..." id="studentSearch">
                </div>
                
                <select class="filter-select" id="statusFilter">
                    <option value="all">All Statuses</option>
                    <option value="allocated">Allocated</option>
                    <option value="pending">Pending</option>
                </select>
            </div>

            <div class="student-container">
                <?php if (mysqli_num_rows($result) > 0): ?>
                <table id="studentsTable">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Room Type</th>
                            <th>Room Option</th>
                            <th>Room</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no = 1;
                    while ($student = mysqli_fetch_assoc($result)):
                        // Handle missing room number properly
                        $roomNumber = 'Not assigned';
                        if (isset($student['actualRoomNumber']) && !empty($student['actualRoomNumber'])) {
                            $roomNumber = htmlspecialchars($student['actualRoomNumber']);
                        } elseif (isset($student['roomNumber']) && !empty($student['roomNumber'])) {
                            $roomNumber = htmlspecialchars($student['roomNumber']);
                        }
                        
                        if ($student['status'] == 'Pending') {
                            $bedQuery = mysqli_query($conn, "
                                SELECT SUM(totalBeds - occupiedBeds) AS availableBeds
                                FROM rooms
                                WHERE roomType = '".mysqli_real_escape_string($conn, $student['roomType'])."'
                                AND totalBeds = '".intval($student['roomOption'])."'
                            ");
                            $bedData = mysqli_fetch_assoc($bedQuery);
                            $availableBeds = intval($bedData['availableBeds'] ?? 0);
                            $statusBadge = '<span class="status-badge status-pending"><i class="fa-solid fa-clock"></i> Pending (' . $availableBeds . ' beds)</span>';
                        
                        } elseif ($student['status'] == 'Allocated') {
                            $statusBadge = '<span class="status-badge status-allocated"><i class="fa-solid fa-check-circle"></i> Allocated (Room ' . $roomNumber . ')</span>';
                        
                        } else {
                            $statusBadge = '<span class="status-badge status-na"><i class="fa-solid fa-ban"></i> N/A</span>';
                        }
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= htmlspecialchars($student['firstName'] . ' ' . $student['lastName']); ?></td>
                        <td><?= htmlspecialchars($student['roomType']); ?></td>
                        <td><?= htmlspecialchars($student['roomOption']); ?></td>
                        <td><?= $roomNumber ?></td>
                        <td><?= $statusBadge ?></td>
                        <td>
                            <div class="action-menu">
                                <button class="action-btn">
                                    Actions <i class="fas fa-chevron-down"></i>
                                </button>
                                <div class="dropdown-content">
                                    <a href="../Admin-dashboard/edit-student-room.php?id=<?= $student['id']; ?>" class="edit-btn">
                                        <i class="fas fa-pen"></i> Edit Room
                                    </a>
                                    <?php if ($student['status'] == 'Pending'): ?>
                                    <a href="../Admin-dashboard/allocate_room.php?id=<?= $student['id']; ?>" class="allocate-btn">
                                        <i class="fas fa-bed"></i> Allocate Room
                                    </a>
                                    <?php endif; ?>
                                    <a href="../Admin-dashboard/delete-student.php?id=<?= $student['id']; ?>" 
                                       class="delete-btn" data-id="<?= $student['id']; ?>">
                                        <i class="fas fa-trash"></i> Delete Student
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
                <?php else: ?>
                <div class="empty-state">
                    <i class="fas fa-user-graduate"></i>
                    <h3>No Students Found</h3>
                    <p>There are no students in the database yet.</p>
                </div>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <script>
        // Search functionality
        document.getElementById('studentSearch').addEventListener('keyup', function() {
            const searchText = this.value.toLowerCase();
            const rows = document.querySelectorAll('#studentsTable tbody tr');
            
            rows.forEach(row => {
                const name = row.cells[1].textContent.toLowerCase();
                const roomType = row.cells[2].textContent.toLowerCase();
                const room = row.cells[4].textContent.toLowerCase();
                
                if (name.includes(searchText) || roomType.includes(searchText) || room.includes(searchText)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
        
        // Filter functionality
        document.getElementById('statusFilter').addEventListener('change', function() {
            const filterValue = this.value;
            const rows = document.querySelectorAll('#studentsTable tbody tr');
            
            rows.forEach(row => {
                const status = row.cells[5].textContent.toLowerCase();
                
                if (filterValue === 'all' || status.includes(filterValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
        
        // Confirm delete action
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const studentId = this.getAttribute('data-id');
                if (confirm('Are you sure you want to delete this student?')) {
                    window.location.href = this.href;
                }
            });
        });
        
        // Add Student Modal
        const modal = document.getElementById('addStudentModal');
        const addBtn = document.getElementById('addStudentBtn');
        const closeBtn = document.querySelector('.close');
        const cancelBtn = document.querySelector('.cancel-btn');
        
        if (addBtn) {
            addBtn.addEventListener('click', function() {
                modal.style.display = 'block';
            });
        }
        
        if (closeBtn) {
            closeBtn.addEventListener('click', function() {
                modal.style.display = 'none';
            });
        }
        
        if (cancelBtn) {
            cancelBtn.addEventListener('click', function() {
                modal.style.display = 'none';
            });
        }
        
        window.addEventListener('click', function(event) {
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        });
        
        // Notification function
        function showNotification(message, isError = false) {
            const notification = document.getElementById('notification');
            const notificationText = document.getElementById('notification-text');
            
            if (notification && notificationText) {
                notificationText.textContent = message;
                
                if (isError) {
                    notification.classList.add('error');
                } else {
                    notification.classList.remove('error');
                }
                
                notification.classList.add('show');
                
                setTimeout(() => {
                    notification.classList.remove('show');
                }, 3000);
            }
        }
        
        // Check for URL parameters to show notifications
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('success')) {
                showNotification('Operation completed successfully!');
            } else if (urlParams.has('error')) {
                showNotification('An error occurred. Please try again.', true);
            }
        });
    </script>
</body>
</html>