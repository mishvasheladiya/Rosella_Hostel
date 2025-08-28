<?php
if (!isset($base_url)) {
    $base_url = '/Hostel/';
}

$conn = mysqli_connect("localhost", "root", "", "hostel");
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $studentId = intval($_GET['id']);

    // Fetch student info (to check if allocated to a room)
    $studentQuery = mysqli_query($conn, "SELECT * FROM student WHERE id = $studentId");
    $student = mysqli_fetch_assoc($studentQuery);

    if ($student) {
        // If student has an allocated room, update occupiedBeds
        if (!empty($student['roomNumber'])) {
            $roomId = intval($student['roomNumber']);
            mysqli_query($conn, "UPDATE rooms SET occupiedBeds = occupiedBeds - 1 WHERE id = $roomId AND occupiedBeds > 0");
        }

        // Delete student
        $deleteQuery = mysqli_query($conn, "DELETE FROM student WHERE id = $studentId");

        if ($deleteQuery) {
            echo "<script>
                alert('Student deleted successfully!');
                window.location.href = 'admin-student.php';
            </script>";
        } else {
            echo "<script>
                alert('Error deleting student!');
                window.location.href = 'admin-student.php';
            </script>";
        }
    } else {
        echo "<script>
            alert('Student not found!');
            window.location.href = 'admin-student.php';
        </script>";
    }
} else {
    header("Location: admin-student.php");
    exit;
}