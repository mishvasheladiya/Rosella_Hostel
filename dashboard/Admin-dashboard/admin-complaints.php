<?php
session_start();
if (!isset($base_url)) {
  $base_url = '/Hostel/';          
}


$conn = mysqli_connect("localhost", "root", "", "hostel");
if (!$conn) {
  die("Database connection failed: " . mysqli_connect_error());
}

$result = $conn->query("SELECT * FROM complaints ORDER BY created_at DESC");

$stmt = mysqli_prepare($conn, "SELECT id, name, category, description, room_no, status FROM complaints ORDER BY id DESC");

mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Dashboard - ROSELLE Hostel</title>

  <!-- Styles -->
  <link rel="stylesheet" href="<?= $base_url; ?>assets/css/admin-header.css" />
  <link rel="stylesheet" href="<?= $base_url; ?>assets/css/admin-slidebar.css" />
  <link rel="stylesheet" href="<?= $base_url; ?>assets/css/admin-complaints.css" /> <!-- fixed path -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
</head>

<body>
  <!-- Header & Sidebar -->
  <?php include('admin-header.php'); ?>
  <div class="dashboard-container">
    <?php include('admin-slidebar.php'); ?>

    <!-- Main Content -->
    <main class="main-content">
      <div class="table-container">
        <table>
          <thead>
            <tr>
              <th>Complaint&nbsp;No</th>
              <th>Category</th>
              <th>Description</th>
              <th>Description</th>
              <th>Room&nbsp;No</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
  <?php
    $id          = (int)$row['id'];
    $name        = htmlspecialchars($row['name']); // complaint table already has name
    $category    = htmlspecialchars($row['category']);
    $description = htmlspecialchars($row['description']);
    $room_no     = htmlspecialchars($row['room_no']);
    $statusRaw   = strtolower($row['status'] ?? 'pending');
    $statusClass = $statusRaw === 'resolved' ? 'resolved' : 'pending';
  ?>
  <tr>
    <td>#<?= $id ?></td>
    <td><?= $name ?></td> <!-- ✅ Now will not give undefined warning -->
    <td><?= $category ?></td>
    <td><?= $description ?></td>
    <td><?= $room_no ?></td>
    <td>
      <span class="status <?= $statusClass ?>">
        <?= ucfirst($statusRaw) ?>
      </span>
    </td>
    <td>
      <?php if ($statusRaw === 'resolved'): ?>
        <button class="submit-btn" disabled>Submitted</button>
      <?php else: ?>
        <button class="submit-btn"
                onclick="markResolved(this, <?= $id ?>)">
          Submit
        </button>
      <?php endif; ?>
    </td>
  </tr>
<?php endwhile; ?>

          <?php else: ?>
              <tr><td colspan="7">No complaints found.</td></tr>
          <?php endif; ?>
          </tbody>
        </table>
      </div>
    </main>
  </div>

  <!-- JS -->
  <script>
    // Mark a complaint resolved
    function markResolved(btn, id) {
      // Disable button immediately to avoid double‑clicks
      btn.disabled = true;
      fetch('update-status.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'id=' + encodeURIComponent(id)
      })
      .then(res => res.text())
      .then(txt => {
        if (txt.trim() === 'ok') {
          // Success: update UI
          btn.innerText = 'Submitted';
          const statusSpan = btn.closest('tr')
                                .querySelector('.status');
          statusSpan.className = 'status resolved';
          statusSpan.textContent = 'Resolved';
        } else {
          // Failure: re‑enable button & notify
          alert('Update failed: ' + txt);
          btn.disabled = false;
        }
      })
      .catch(err => {
        console.error(err);
        alert('Network error');
        btn.disabled = false;
      });
    }
  </script>
</body>
</html>
<?php
// Close DB connection
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
