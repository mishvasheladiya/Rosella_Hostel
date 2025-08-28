<?php
if (!isset($base_url)) {
    $base_url = '/Hostel/';
}

$conn = mysqli_connect("localhost", "root", "", "hostel");
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$email = $_SESSION['email'] ?? '';

$firstName = 'Student';

if (!empty($email)) {
    $query = "SELECT firstName FROM student WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $firstName = $row['firstName'];
    }
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
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/student-header.css">
</head>
<body>
    <div class="main-header">
        <div class="top-bar">
            <div class="top-bar-container">
                <div class="social-links animate_animated animatefadeInRight animate_delay-1s">
                    <a href="#" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
                    <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                </div>
                <div class="auth-links">
                    <button class="auth-btn animate_animated animatefadeInRight animate_delay-1s">
                       <a href="<?php echo $base_url; ?>componments/Logout/logout.php"><i class="fas fa-sign-in-alt"></i> Logout</a>
                    </button>
                </div>
            </div>
        </div>

        <nav class="main-nav">
            <div class="nav-container">
                <a href="<?php echo $base_url; ?>" class="logo">
                    <img src="<?php echo $base_url; ?>assets/img/logo1.png" alt="Roselle Hostel">
                </a>
                
                <div class="nav-actions">
                    <span class="welcome-user">Welcome, <strong><?= htmlspecialchars($firstName); ?></strong></span>
                </div>
                
                <button class="mobile-menu-toggle" id="mobileMenuToggle">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </nav>
    </div>

    <div class="mobile-menu-overlay" id="mobileMenuOverlay"></div>
    <div class="mobile-menu-panel" id="mobileMenuPanel">
        <div class="mobile-menu-header">
            <img src="<?php echo $base_url; ?>assets/img/logo1.png" alt="Roselle Hostel" height="40">
            <button class="mobile-menu-close" id="mobileMenuClose">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="mobile-menu-actions">
            <div class="welcome-user-mobile">Welcome, <strong><?= htmlspecialchars($firstName); ?></strong></div>

            <div class="social-links" style="justify-content: center; margin-bottom: 20px;">
                <a href="#" aria-label="Facebook" style="color: #fff;"><i class="fab fa-facebook"></i></a>
                <a href="#" aria-label="Instagram" style="color: #fff;"><i class="fab fa-instagram"></i></a>
                <a href="#" aria-label="Twitter" style="color: #fff;"><i class="fab fa-twitter"></i></a>
                <a href="#" aria-label="YouTube" style="color: #fff;"><i class="fab fa-youtube"></i></a>
            </div>

            <div class="auth-links">
                <button class="auth-btn" style="width: 100%; justify-content: center; color: #fff; border-radius: 5px; border: 1px solid #fff;">
                    <a href="<?php echo $base_url; ?>componments/Logout/logout.php"><i class="fas fa-sign-in-alt"></i> Logout</a>
                </button>
            </div>
        </div>
    </div>

    <div class="search-modal" id="searchModal">
        <div class="search-modal-content">
            <span class="close-search">&times;</span>
            <form class="search-form" action="<?php echo $base_url; ?>search" method="GET">
                <input type="text" placeholder="Search..." name="q">
                <button type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div>
    </div>
</body>
</html>
