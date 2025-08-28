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
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/student-sidebar-style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>
<body>
    <aside class="sidebar">
        <ul class="nav-list">
            <li>
                <a href="<?= $base_url; ?>dashboard\Student-dashboard\student-dashboard.php" class="<?= basename($_SERVER['PHP_SELF']) == 'student-dashboard.php' ? 'active' : '' ?>">
                    <i class="fas fa-home"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="<?= $base_url; ?>dashboard\Student-dashboard\my-profile.php" class="<?= basename($_SERVER['PHP_SELF']) == 'my-profile.php' ? 'active' : '' ?>">
                    <i class="fas fa-user-circle"></i>
                    <span class="nav-text">Profile</span>
                </a>
            </li>
            <li>
                <a href="<?= $base_url; ?>dashboard\Student-dashboard\student-room.php" class="<?= basename($_SERVER['PHP_SELF']) == 'student-room.php' ? 'active' : '' ?>">
                    <i class="fas fa-door-open"></i>
                    <span class="nav-text">Room</span>
                </a>
            </li>
            <li>
                <a href="<?= $base_url; ?>dashboard\Student-dashboard\student-menu.php" class="<?= basename($_SERVER['PHP_SELF']) == 'student-menu.php' ? 'active' : '' ?>">
                    <i class="fas fa-utensils"></i>
                    <span class="nav-text">Menu</span>
                </a>
            </li>
            <li>
                <a href="<?= $base_url; ?>dashboard\Student-dashboard\fees-payment.php" class="<?= basename($_SERVER['PHP_SELF']) == 'fees-payment.php' ? 'active' : '' ?>">
                    <i class="fas fa-money-check-alt"></i>
                    <span class="nav-text">Payments</span>
                </a>
            </li>
            <li>
                <a href="<?= $base_url; ?>dashboard\Student-dashboard\complaint.php" class="<?= basename($_SERVER['PHP_SELF']) == 'complaint.php' ? 'active' : '' ?>">
                    <i class="fas fa-comments"></i>
                    <span class="nav-text">Complaints</span>
                </a>
            </li>
            <li>
                <a href="<?= $base_url; ?>dashboard\Student-dashboard\student-setting.php" class="<?= basename($_SERVER['PHP_SELF']) == 'settings.php' ? 'active' : '' ?>">
                    <i class="fas fa-cog"></i>
                    <span class="nav-text">Settings</span>
                </a>
            </li>
        </ul>
    </aside>
</body>
</html>