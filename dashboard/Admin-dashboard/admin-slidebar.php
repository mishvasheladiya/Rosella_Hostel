<?php
if (!isset($base_url)) {
    $base_url = '/Hostel/';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets\css\admin-slidebar.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>
<body>
    <aside class="sidebar">
        <ul class="nav-list">
            <li>
                <a href="<?= $base_url; ?>dashboard/Admin-dashboard/admin-dashboard.php" class="<?= basename($_SERVER['PHP_SELF']) == 'admin-dashboard.php' ? 'active' : '' ?>">
                    <i class="fas fa-home"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="<?= $base_url; ?>dashboard/Admin-dashboard/admin-room.php" class="<?= basename($_SERVER['PHP_SELF']) == 'admin-room.php' ? 'active' : '' ?>">
                    <i class="fas fa-door-open"></i>
                    <span class="nav-text">Room</span>
                </a>
            </li>
            <li>
                <a href="<?= $base_url; ?>dashboard/Admin-dashboard/admin-menu.php" class="<?= basename($_SERVER['PHP_SELF']) == 'admin-menu.php' ? 'active' : '' ?>">
                    <i class="fas fa-utensils"></i>
                    <span class="nav-text">Menu</span>
                </a>
            </li>
            <li>
                <a href="<?= $base_url; ?>dashboard/Admin-dashboard/admin-student.php" class="<?= basename($_SERVER['PHP_SELF']) == 'admin-student.php' ? 'active' : '' ?>">
                    <i class="fas fa-user-graduate"></i>
                    <span class="nav-text">Student</span>
                </a>
            </li>
            <li>
                <a href="<?= $base_url; ?>dashboard/Admin-dashboard/admin-complaints.php" class="<?= basename($_SERVER['PHP_SELF']) == 'admin-complaints.php' ? 'active' : '' ?>">
                    <i class="fas fa-comments"></i>
                    <span class="nav-text">Complaints</span>
                </a>
            </li>
            <li>
                <a href="<?= $base_url; ?>dashboard/Admin-dashboard/admin-setting.php" class="<?= basename($_SERVER['PHP_SELF']) == 'admin-setting.php' ? 'active' : '' ?>">
                    <i class="fas fa-cog"></i>
                    <span class="nav-text">Settings</span>
                </a>
            </li>
        </ul>
    </aside>
</body>
</html>