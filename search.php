<?php
$conn = mysqli_connect("localhost", "root", "", "hostel");
if (!$conn) {
  die("DB connection failed: " . mysqli_connect_error());
}

$q = trim($_GET['q'] ?? '');
if (empty($q)) {
  exit;
}

$output = "";

// 🔹 Students
$sql = "SELECT firstName, lastName, email FROM student 
        WHERE firstName LIKE ? OR lastName LIKE ? OR email LIKE ? LIMIT 5";
$stmt = mysqli_prepare($conn, $sql);
$like = "%$q%";
mysqli_stmt_bind_param($stmt, "sss", $like, $like, $like);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
if (mysqli_num_rows($result) > 0) {
  $output .= "<div class='list-group-item active'>Students</div>";
  while ($row = mysqli_fetch_assoc($result)) {
    $output .= "<a href='#' class='list-group-item list-group-item-action'>
                  👤 {$row['firstName']} {$row['lastName']} <br>
                  <small>{$row['email']}</small>
                </a>";
  }
}

// 🔹 Rooms
$sql = "SELECT roomNumber, status FROM rooms 
        WHERE roomNumber LIKE ? OR status LIKE ? LIMIT 5";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ss", $like, $like);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
if (mysqli_num_rows($result) > 0) {
  $output .= "<div class='list-group-item active'>Rooms</div>";
  while ($row = mysqli_fetch_assoc($result)) {
    $output .= "<a href='#' class='list-group-item list-group-item-action'>
                  🏠 Room {$row['roomNumber']} - {$row['status']}
                </a>";
  }
}

// 🔹 Complaints
$sql = "SELECT category, description FROM complaints 
        WHERE category LIKE ? OR description LIKE ? LIMIT 5";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ss", $like, $like);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
if (mysqli_num_rows($result) > 0) {
  $output .= "<div class='list-group-item active'>Complaints</div>";
  while ($row = mysqli_fetch_assoc($result)) {
    $shortDesc = substr($row['description'], 0, 40) . "...";
    $output .= "<a href='#' class='list-group-item list-group-item-action'>
                  ⚠️ {$row['category']} <br>
                  <small>{$shortDesc}</small>
                </a>";
  }
}


echo $output ?: "<div class='list-group-item'>No results found</div>";
