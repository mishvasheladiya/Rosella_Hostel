<?php
$conn = mysqli_connect("localhost", "root", "", "hostel");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$roomNumber = mysqli_real_escape_string($conn, $_GET['roomNumber'] ?? '');

$query = "SELECT id, firstName, lastName, email, phone, course, university 
          FROM student 
          WHERE roomNumber = '$roomNumber'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    echo "<h3>Students in Room $roomNumber</h3><ul>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<li><strong>{$row['firstName']} {$row['lastName']}</strong><br>
                 {$row['course']} - {$row['university']}<br>
                 📧 {$row['email']} | 📱 {$row['phone']}
              </li><hr>";
    }
    echo "</ul>";
} else {
    echo "<p>No students assigned to this room.</p>";
}
mysqli_close($conn);
?>
