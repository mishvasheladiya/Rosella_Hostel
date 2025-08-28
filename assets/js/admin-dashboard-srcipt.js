document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu functionality
    const mobileMenuToggle = document.getElementById('mobileMenuToggle');
    const mobileMenuPanel = document.getElementById('mobileMenuPanel');
    const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
    const mobileMenuClose = document.getElementById('mobileMenuClose');

    function toggleMobileMenu() {
        mobileMenuPanel.classList.toggle('active');
        mobileMenuOverlay.classList.toggle('active');
        document.body.style.overflow = mobileMenuPanel.classList.contains('active') ? 'hidden' : '';
    }

    if (mobileMenuToggle) {
        mobileMenuToggle.addEventListener('click', toggleMobileMenu);
    }
    if (mobileMenuClose) {
        mobileMenuClose.addEventListener('click', toggleMobileMenu);
    }
    if (mobileMenuOverlay) {
        mobileMenuOverlay.addEventListener('click', toggleMobileMenu);
    }

    // Theme toggle functionality
    const themeToggle = document.getElementById('themeToggle');
    const mobileThemeToggle = document.getElementById('mobileThemeToggle');
    const body = document.body;

    function toggleTheme() {
        body.classList.toggle('dark-theme');
        const isDarkMode = body.classList.contains('dark-theme');

        if (themeToggle) {
            themeToggle.innerHTML = isDarkMode ? '<i class="fas fa-sun"></i>' : '<i class="fas fa-moon"></i>';
            themeToggle.setAttribute('aria-label', isDarkMode ? 'Switch to Light Mode' : 'Switch to Dark Mode');
        }
        if (mobileThemeToggle) {
            mobileThemeToggle.innerHTML = isDarkMode ? '<i class="fas fa-sun"></i>' : '<i class="fas fa-moon"></i>';
            mobileThemeToggle.setAttribute('aria-label', isDarkMode ? 'Switch to Light Mode' : 'Switch to Dark Mode');
        }

        localStorage.setItem('theme', isDarkMode ? 'dark' : 'light');
    }

    // Apply saved theme
    if (localStorage.getItem('theme') === 'dark') {
        body.classList.add('dark-theme');
        if (themeToggle) {
            themeToggle.innerHTML = '<i class="fas fa-sun"></i>';
        }
        if (mobileThemeToggle) {
            mobileThemeToggle.innerHTML = '<i class="fas fa-sun"></i>';
        }
    }

    // Add event listeners for theme toggles
    if (themeToggle) {
        themeToggle.addEventListener('click', function(e) {
            e.preventDefault();
            toggleTheme();
        });
    }
    if (mobileThemeToggle) {
        mobileThemeToggle.addEventListener('click', function(e) {
            e.preventDefault();
            toggleTheme();
        });
    }

    // Search functionality
    const searchToggle = document.getElementById('searchToggle');
    const mobileSearchToggle = document.getElementById('mobileSearchToggle');
    const searchModal = document.getElementById('searchModal');
    const closeSearch = document.querySelector('.close-search');

    function toggleSearch() {
        if (searchModal) {
            searchModal.style.display = 'block';
        }
    }

    if (searchToggle) {
        searchToggle.addEventListener('click', function(e) {
            e.preventDefault();
            toggleSearch();
        });
    }

    if (mobileSearchToggle) {
        mobileSearchToggle.addEventListener('click', function(e) {
            e.preventDefault();
            toggleSearch();
            toggleMobileMenu();
        });
    }

    if (closeSearch) {
        closeSearch.addEventListener('click', function() {
            if (searchModal) {
                searchModal.style.display = 'none';
            }
        });
    }

    window.addEventListener('click', function(event) {
        if (event.target === searchModal) {
            searchModal.style.display = 'none';
        }
    });

    // Active link highlighting
    function setActiveLink(link) {
        document.querySelectorAll('.nav-link, .mobile-menu-link').forEach(item => {
            item.classList.remove('active');
        });
        link.classList.add('active');
    }

    document.querySelectorAll('.nav-link, .mobile-menu-link').forEach(link => {
        link.addEventListener('click', function() {
            setActiveLink(this);
        });
    });
});