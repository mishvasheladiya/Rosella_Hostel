<?php
if (!isset($base_url)) {
  $base_url = '/Hostel/';
}

$conn = mysqli_connect("localhost", "root", "", "hostel");
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$menu = [];
$result = mysqli_query($conn, "SELECT * FROM food_menu ORDER BY id ASC");
while ($row = mysqli_fetch_assoc($result)) {
  $menu[] = [$row['breakfast'], $row['lunch'], $row['snacks'], $row['dinner']];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Food Menu - Roselle Hostel</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  
  <link rel="stylesheet" href="<?= $base_url; ?>assets/css/student-header.css" />
  <link rel="stylesheet" href="<?= $base_url; ?>assets/css/sidebar.css" />
  <link rel="stylesheet" href="<?= $base_url; ?>assets/css/student-menu.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
</head>

<body>

  <!-- Top Bar + Navbar -->
  <?php include('student-header.php'); ?>

  <!-- Sidebar + Content Container -->
  <div class="dashboard-container">
    <?php include('student-sidebar.php'); ?>

    <main class="main-content">
      <div class="tabs-container">
        <ul class="tab-buttons">
          <?php
          $days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
          foreach ($days as $index => $day) {
            $active = $index === 0 ? "active" : "";
            echo "<li class='tab-btn $active' onclick='showTab($index)'>$day</li>";
          }
          ?>
        </ul>

        <div class="tab-content">
          <?php
          foreach ($menu as $i => $meals) {
            $show = $i === 0 ? "show" : "";
            echo "<div class='tab-panel $show'>
                    <ul>
                      <li><strong>Breakfast:</strong> {$meals[0]}</li>
                      <li><strong>Lunch:</strong> {$meals[1]}</li>
                      <li><strong>Snacks:</strong> {$meals[2]}</li>
                      <li><strong>Dinner:</strong> {$meals[3]}</li>
                    </ul>
                  </div>";
          }
          ?>
        </div>
      </div>
    </main>
  </div>

  <!-- JS for tab switching -->
  <script>
    function showTab(index) {
      const tabs = document.querySelectorAll('.tab-btn');
      const panels = document.querySelectorAll('.tab-panel');

      tabs.forEach((tab, i) => {
        tab.classList.toggle('active', i === index);
        panels[i].classList.toggle('show', i === index);
      });
    }
  </script>
<?php include('D:/Xampp/htdocs/Hostel/student_chatbot/chat.html'); ?>

</body>
</html>
