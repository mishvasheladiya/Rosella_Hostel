document.addEventListener('DOMContentLoaded', function () {
    // Theme toggle functionality
    const themeToggle = document.getElementById('theme-toggle');
    const icon = themeToggle.querySelector('i');

    const savedTheme = localStorage.getItem('theme') ||
        (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
    document.documentElement.setAttribute('data-theme', savedTheme);
    updateThemeIcon(savedTheme);

    themeToggle.addEventListener('click', function () {
        const currentTheme = document.documentElement.getAttribute('data-theme');
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        document.documentElement.setAttribute('data-theme', newTheme);
        localStorage.setItem('theme', newTheme);
        updateThemeIcon(newTheme);
    });

    function updateThemeIcon(theme) {
        if (theme === 'dark') {
            icon.classList.remove('fa-moon');
            icon.classList.add('fa-sun');
        } else {
            icon.classList.remove('fa-sun');
            icon.classList.add('fa-moon');
        }
    }

    // Close button functionality
    document.getElementById('close-btn').addEventListener('click', function () {
        window.history.back();
    });

    // Password toggle visibility
    const togglePassword = document.querySelector('.toggle-password');
    togglePassword.addEventListener('click', function () {
        const passwordInput = document.getElementById('password');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            this.classList.remove('fa-eye');
            this.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            this.classList.remove('fa-eye-slash');
            this.classList.add('fa-eye');
        }
    });

    // Submit validation
    document.getElementById('loginForm').addEventListener('submit', function (e) {
        e.preventDefault();

        // Clear error messages
        document.querySelectorAll('.error-message').forEach(error => {
            error.textContent = '';
            error.classList.remove('active');
        });

        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value;
        let isValid = true;

        if (!email) {
            showError('email-error', 'Email is required');
            isValid = false;
        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            showError('email-error', 'Please enter a valid email');
            isValid = false;
        }

        if (!password) {
            showError('password-error', 'Password is required');
            isValid = false;
        } else if (password.length < 4) {
            showError('password-error', 'Password must be at least 4 characters');
            isValid = false;
        }

        if (isValid) this.submit();
    });

    function showError(id, message) {
        const errorElement = document.getElementById(id);
        errorElement.textContent = message;
        errorElement.classList.add('active');
        const wrapper = errorElement.closest('.input-wrapper');
        if (wrapper) {
            wrapper.classList.add('shake');
            setTimeout(() => wrapper.classList.remove('shake'), 500);
        }
    }
});