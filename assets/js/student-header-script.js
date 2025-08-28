// Mobile menu toggle functionality
document.getElementById('mobileMenuToggle').addEventListener('click', function () {
    document.getElementById('mobileMenuPanel').classList.add('active');
    document.getElementById('mobileMenuOverlay').classList.add('active');
});

document.getElementById('mobileMenuClose').addEventListener('click', function () {
    document.getElementById('mobileMenuPanel').classList.remove('active');
    document.getElementById('mobileMenuOverlay').classList.remove('active');
});

document.getElementById('mobileMenuOverlay').addEventListener('click', function () {
    document.getElementById('mobileMenuPanel').classList.remove('active');
    document.getElementById('mobileMenuOverlay').classList.remove('active');
});

// Search modal functionality
document.getElementById('searchToggle').addEventListener('click', function (e) {
    e.preventDefault();
    document.getElementById('searchModal').style.display = 'block';
});

document.getElementById('mobileSearchToggle').addEventListener('click', function (e) {
    e.preventDefault();
    document.getElementById('searchModal').style.display = 'block';
    document.getElementById('mobileMenuPanel').classList.remove('active');
    document.getElementById('mobileMenuOverlay').classList.remove('active');
});

document.querySelector('.close-search').addEventListener('click', function () {
    document.getElementById('searchModal').style.display = 'none';
});

// Theme toggle functionality
document.getElementById('themeToggle').addEventListener('click', function (e) {
    e.preventDefault();
    document.body.classList.toggle('dark-theme');
});

document.getElementById('mobileThemeToggle').addEventListener('click', function (e) {
    e.preventDefault();
    document.body.classList.toggle('dark-theme');
});