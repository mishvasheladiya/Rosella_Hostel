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
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/header-style.css">
</head>
<body>
    <div class="top-bar animate__animated animate__fadeIn">
        <div class="top-bar-container">
            <div class="social-links animate__animated animate__fadeInRight animate__delay-1s">
                <a href="#" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
                <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
            </div>
            <div class="auth-links">
                <button class="auth-btn animate__animated animate__fadeInRight animate__delay-1s">
                   <a href="<?php echo $base_url; ?>componments/Login/login.php"><i class="fas fa-sign-in-alt"></i> Login</a>
                </button>
                <button class="auth-btn animate__animated animate__fadeInRight">
                    <a href="<?php echo $base_url; ?>componments/Register/register.php"><i class="fas fa-user-plus"></i> Register</a>
                </button>
            </div>
        </div>
    </div>
    
    <nav class="main-nav animate__animated animate__fadeInDown">
        <div class="nav-container">
            <a href="<?php echo $base_url; ?>" class="logo">
                <img src="<?php echo $base_url; ?>assets/img/logo1.png" alt="Roselle Hostel">
            </a>
            
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="<?php echo $base_url; ?>" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo $base_url; ?>componments/Room/room.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'room.php' ? 'active' : ''; ?>">
                        <i class="fas fa-bed"></i> Room
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo $base_url; ?>componments/Menu/menu.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'menu.php' ? 'active' : ''; ?>">
                        <i class="fas fa-utensils"></i> Menu
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo $base_url; ?>componments/Information/information.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'information.php' ? 'active' : ''; ?>">
                        <i class="fas fa-info-circle"></i> Information
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo $base_url; ?>componments/About/about.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'about.php' ? 'active' : ''; ?>">
                        <i class="fas fa-question-circle"></i> About
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo $base_url; ?>componments/Contact/contact.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'active' : ''; ?>">
                        <i class="fas fa-envelope"></i> Contact
                    </a>
                </li>
            </ul>
            
            <div class="nav-actions">
                <a href="#" class="nav-icon pulse" aria-label="Notifications">
                    <i class="far fa-bell"></i>
                    <span class="notification-badge">0</span>
                </a>
                <a href="#" class="nav-icon" aria-label="Toggle Theme" id="themeToggle">
                    <i class="fas fa-moon"></i>
                </a>
                <a href="#" class="nav-icon" aria-label="Search" id="searchToggle">
                    <i class="fas fa-search"></i>
                </a>
            </div>
            
            <button class="mobile-menu-toggle" id="mobileMenuToggle">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </nav>

    <div class="mobile-menu-overlay" id="mobileMenuOverlay"></div>
    <div class="mobile-menu-panel" id="mobileMenuPanel">
        <div class="mobile-menu-header">
            <img src="<?php echo $base_url; ?>assets/img/logo1.png" alt="Roselle Hostel" height="40">
            <button class="mobile-menu-close" id="mobileMenuClose">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <ul class="mobile-menu-items">
            <li class="mobile-menu-item">
                <a href="<?php echo $base_url; ?>" class="mobile-menu-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">
                    <i class="fas fa-home"></i> Home
                </a>
            </li>
            <li class="mobile-menu-item">
                <a href="<?php echo $base_url; ?>componments/Room/room.php" class="mobile-menu-link <?php echo basename($_SERVER['PHP_SELF']) == 'room.php' ? 'active' : ''; ?>">
                    <i class="fas fa-bed"></i> Room
                </a>
            </li>
            <li class="mobile-menu-item">
                <a href="<?php echo $base_url; ?>componments/Menu/menu.php" class="mobile-menu-link <?php echo basename($_SERVER['PHP_SELF']) == 'menu.php' ? 'active' : ''; ?>">
                    <i class="fas fa-utensils"></i> Menu
                </a>
            </li>
            <li class="mobile-menu-item">
                <a href="<?php echo $base_url; ?>componments/Information/information.php" class="mobile-menu-link <?php echo basename($_SERVER['PHP_SELF']) == 'information.php' ? 'active' : ''; ?>">
                    <i class="fas fa-info-circle"></i> Information
                </a>
            </li>
            <li class="mobile-menu-item">
                <a href="<?php echo $base_url; ?>componments/About/about.php" class="mobile-menu-link <?php echo basename($_SERVER['PHP_SELF']) == 'about.php' ? 'active' : ''; ?>">
                    <i class="fas fa-question-circle"></i> About
                </a>
            </li>
            <li class="mobile-menu-item">
                <a href="<?php echo $base_url; ?>componments/Contact/contact.php" class="mobile-menu-link <?php echo basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'active' : ''; ?>">
                    <i class="fas fa-envelope"></i> Contact
                </a>
            </li>
        </ul>
        
        <div class="mobile-menu-actions">
            <div class="social-links" style="justify-content: center; margin-bottom: 20px;">
                <a href="#" aria-label="Facebook" style="color: #fff;"><i class="fab fa-facebook"></i></a>
                <a href="#" aria-label="Instagram" style="color: #fff;"><i class="fab fa-instagram"></i></a>
                <a href="#" aria-label="Twitter" style="color: #fff;"><i class="fab fa-twitter"></i></a>
                <a href="#" aria-label="YouTube" style="color: #fff;"><i class="fab fa-youtube"></i></a>
            </div>
            
            <div class="auth-links">
                <button class="auth-btn" style="width: 100%; justify-content: center; color: #fff; border-radius: 5px;  border: 1px solid #fff;">
                    <a href="<?php echo $base_url; ?>componments/Login/login.php"><i class="fas fa-sign-in-alt"></i> Login</a>
                </button>
                <button class="auth-btn" style="width: 100%; justify-content: center; color: #fff; border-radius: 5px;  border: 1px solid #fff;">
                   <a href="<?php echo $base_url; ?>componments/Register/register.php"> <i class="fas fa-user-plus"></i> Register</a>
                </button>
            </div>
            
            <div style="display: flex; justify-content: center; gap: 20px; margin-top: 10px;">
                <a href="#" class="nav-icon pulse" aria-label="Notifications">
                    <i class="far fa-bell"></i>
                    <span class="notification-badge">0</span>
                </a>
                <a href="#" class="nav-icon" aria-label="Toggle Theme" id="mobileThemeToggle">
                    <i class="fas fa-moon"></i>
                </a>
                <a href="#" class="nav-icon" aria-label="Search" id="mobileSearchToggle">
                    <i class="fas fa-search"></i>
                </a>
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

    <script src="<?php echo $base_url; ?>assets/js/header-script.js"></script>
</body>
</html>