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
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/admin-header.css">
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
                    <span class="welcome-user">Welcome, <strong>Admin</strong></span>
                    <div class="nav-icons">
                        <a href="#" class="nav-icon" id="searchToggle"><i class="fas fa-search"></i></a>
                    </div>
                </div>
                
                <button class="mobile-menu-toggle" id="mobileMenuToggle"><i class="fas fa-bars"></i></button>
            </div>
        </nav>
    </div>

    <!-- Mobile menu -->
    <div class="mobile-menu-overlay" id="mobileMenuOverlay"></div>
    <div class="mobile-menu-panel" id="mobileMenuPanel">
        <div class="mobile-menu-header">
            <img src="<?php echo $base_url; ?>assets/img/logo1.png" alt="Roselle Hostel" height="40">
            <button class="mobile-menu-close" id="mobileMenuClose"><i class="fas fa-times"></i></button>
        </div>
        
        <div class="mobile-menu-actions">
            <div class="welcome-user-mobile">Welcome, <strong><?= htmlspecialchars($firstName); ?></strong></div>
            <div class="social-links" style="justify-content: center; margin-bottom: 20px;">
                <a href="#" style="color: #fff;"><i class="fab fa-facebook"></i></a>
                <a href="#" style="color: #fff;"><i class="fab fa-instagram"></i></a>
                <a href="#" style="color: #fff;"><i class="fab fa-twitter"></i></a>
                <a href="#" style="color: #fff;"><i class="fab fa-youtube"></i></a>
            </div>
            <div class="mobile-nav-icons">
                <a href="#" class="nav-icon pulse"><i class="far fa-bell"></i><span class="notification-badge">0</span></a>
                <a href="#" class="nav-icon" id="mobileThemeToggle"><i class="fas fa-moon"></i></a>
                <a href="#" class="nav-icon" id="mobileSearchToggle"><i class="fas fa-search"></i></a>
            </div>
            <div class="auth-links">
                <button class="auth-btn" style="width: 100%; justify-content: center; color: #fff; border-radius: 5px; border: 1px solid #fff;">
                    <a href="<?php echo $base_url; ?>componments/Logout/logout.php"><i class="fas fa-sign-in-alt"></i> Logout</a>
                </button>
            </div>
        </div>
    </div>

    <!-- Search Modal -->
    <div class="search-modal" id="searchModal">
        <div class="search-modal-content">
            <span class="close-search">&times;</span>
            <form class="search-form" onsubmit="return false;">
                <input type="text" placeholder="Search..." name="q" id="searchInput">
                <button type="button"><i class="fas fa-search"></i></button>
            </form>
            <!-- 🔹 Results go here -->
            <div id="searchResults" class="list-group mt-2"></div>
        </div>
    </div>

    <script>
      const BASE_URL = "<?php echo $base_url; ?>";

      // Open search modal
      document.getElementById('searchToggle').addEventListener('click', function() {
        document.getElementById('searchModal').style.display = 'block';
        document.getElementById('searchInput').focus();
      });

      // Close search modal
      document.querySelector('.close-search').addEventListener('click', function() {
        document.getElementById('searchModal').style.display = 'none';
      });

      // Live search
      document.getElementById('searchInput').addEventListener('keyup', function() {
        let query = this.value.trim();
        if (query.length < 2) {
          document.getElementById('searchResults').innerHTML = '';
          return;
        }
        fetch(BASE_URL + "search.php?q=" + encodeURIComponent(query))
          .then(res => res.text())
          .then(data => {
            document.getElementById('searchResults').innerHTML = data;
          })
          .catch(err => console.error("Search error:", err));
      });
    </script>
<script src="D:\Xampp\htdocs\Hostel\assets\js\header-script.js"></script>
</body>
</html>