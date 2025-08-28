document.addEventListener('DOMContentLoaded', function() {
    // Theme toggle functionality
    const themeToggle = document.getElementById('theme-toggle');
    const icon = themeToggle.querySelector('i');
    
    const savedTheme = localStorage.getItem('theme') || 
                      (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
    document.documentElement.setAttribute('data-theme', savedTheme);
    updateThemeIcon(savedTheme);
    
    themeToggle.addEventListener('click', function() {
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
    document.getElementById('close-btn').addEventListener('click', function() {
        window.history.back();
    });
    
    // Password toggle functionality
    document.querySelectorAll('.toggle-password, .toggle-confirm-password').forEach(toggle => {
        toggle.addEventListener('click', function() {
            const input = this.closest('.input-wrapper').querySelector('input');
            const isPassword = input.type === 'password';
            input.type = isPassword ? 'text' : 'password';
            this.classList.toggle('fa-eye-slash', isPassword);
            this.classList.toggle('fa-eye', !isPassword);
        });
    });

    // Room options functionality - improved version
    function updateRoomOptions() {
        const roomType = document.getElementById('roomType').value;
        const roomOption = document.getElementById('roomOption');
        const roomOptionError = document.getElementById('roomOption-error');
        
        // Clear previous options and error
        roomOption.innerHTML = '<option value="">Select Option</option>';
        roomOptionError.textContent = '';
        roomOptionError.classList.remove('active');
        
        if (!roomType) {
            roomOption.disabled = true;
            return;
        }
        
        roomOption.disabled = false;
        
        const options = {
            'AC': ['4-Bed AC', '6-Bed AC', '8-Bed AC'],
            'NON-AC': ['4-Bed Non-AC', '6-Bed Non-AC', '8-Bed Non-AC']
        };
        
        if (options[roomType]) {
            options[roomType].forEach(option => {
                const opt = document.createElement('option');
                opt.value = option;
                opt.textContent = option;
                roomOption.appendChild(opt);
            });
        }
    }
    
    // Initialize room options after DOM is fully loaded
    document.getElementById('roomType').addEventListener('change', updateRoomOptions);
    
    // Set initial state
    updateRoomOptions();
    
    // Validate date of birth
    function validateDate() {
    const dobInput = document.getElementById('dob');
    const dobError = document.getElementById('dob-error');
    const dobValue = dobInput.value;
    
    // Get current date (today)
    const today = new Date();
    today.setHours(0, 0, 0, 0); 
    
    const minDate = new Date('1900-01-01');
    const selectedDate = new Date(dobValue);
    selectedDate.setHours(0, 0, 0, 0); // Normalize to midnight
    
    dobError.classList.remove('active');
    dobError.textContent = '';
    
    if (!dobValue) {
        dobError.textContent = 'Date of birth is required.';
        dobError.classList.add('active');
        return false;
    }
    
    if (isNaN(selectedDate.getTime())) {
        dobError.textContent = 'Invalid date format.';
        dobError.classList.add('active');
        return false;
    }
    
    if (selectedDate > today) {
        dobError.textContent = 'Date of birth cannot be in the future.';
        dobError.classList.add('active');
        return false;
    }
    
    if (selectedDate < minDate) {
        dobError.textContent = 'Date of birth is too far in the past.';
        dobError.classList.add('active');
        return false;
    }
    
    // Calculate minimum age date (18 years ago from today)
    const minAgeDate = new Date(today);
    minAgeDate.setFullYear(today.getFullYear() - 18);
    
    if (selectedDate > minAgeDate) {
        dobError.textContent = 'You must be at least 18 years old.';
        dobError.classList.add('active');
        return false;
    }
    
    return true;
}
    
    // Form validation
    document.getElementById('registerForm').addEventListener('submit', function (e) {
        e.preventDefault();
        let isValid = true;

        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const phonePattern = /^[0-9]{10}$/;
        const zipPattern = /^[0-9]{5,6}$/;
        const namePattern = /^[A-Za-z ]+$/;

        const requiredFields = [
            'firstName', 'lastName', 'email', 'password',
            'confirmPassword', 'phone', 'dob', 'roomType',
            'roomOption', 'streetAddress', 'zipCode', 'city',
            'state', 'university', 'course', 'userType'
        ];

        // Clear previous errors
        document.querySelectorAll('.error-message').forEach(el => {
            el.textContent = '';
            el.classList.remove('active');
        });

        // Name Validation
        ['firstName', 'lastName'].forEach(field => {
            const el = document.getElementById(field);
            const err = document.getElementById(`$field-error`);
            if (!namePattern.test(el.value.trim())) {
                err.textContent = "Only alphabets allowed.";
                err.classList.add("active");
                isValid = false;
            }
        });

        // Email
        const email = document.getElementById('email').value.trim();
        const emailErr = document.getElementById('email-error');
        if (!emailPattern.test(email)) {
            emailErr.textContent = "Enter a valid email address.";
            emailErr.classList.add("active");
            isValid = false;
        }

        // Password
        const password = document.getElementById('password').value;
        const passwordErr = document.getElementById('password-error');
        const passwordErrors = [];
        if (password.length < 8) passwordErrors.push("At least 8 characters");
        if (!/[A-Z]/.test(password)) passwordErrors.push("One uppercase letter");
        if (!/[0-9]/.test(password)) passwordErrors.push("One number");
        if (!/[!@#$%^&*(),.?":{}|<>]/.test(password)) passwordErrors.push("One special character");

        if (passwordErrors.length > 0) {
            passwordErr.textContent = "Password must have: " + passwordErrors.join(", ");
            passwordErr.classList.add("active");
            isValid = false;
        }

        // Confirm Password
        const confirmPassword = document.getElementById('confirmPassword').value;
        const confirmPasswordErr = document.getElementById('confirmPassword-error');
        if (password !== confirmPassword) {
            confirmPasswordErr.textContent = "Passwords do not match.";
            confirmPasswordErr.classList.add("active");
            isValid = false;
        }

        // Phone
        const phone = document.getElementById('phone');
        const phoneErr = document.getElementById('phone-error');
        if (!phonePattern.test(phone.value)) {
            phoneErr.textContent = 'Phone number must be 10 digits.';
            phoneErr.classList.add('active');
            isValid = false;
        }

        // DOB - must be 18+
        const dob = document.getElementById('dob').value;
        const dobErr = document.getElementById('dob-error');
        if (dob) {
            const dobDate = new Date(dob);
            const today = new Date();
            const age = today.getFullYear() - dobDate.getFullYear();
            if (age < 18 || (age === 18 && today < new Date(dobDate.setFullYear(dobDate.getFullYear() + 18)))) {
                dobErr.textContent = "You must be 18 or older.";
                dobErr.classList.add("active");
                isValid = false;
            }
        }

        // Room Option only if Room Type is selected
        const roomType = document.getElementById('roomType').value;
        const roomOption = document.getElementById('roomOption').value;
        const roomOptionErr = document.getElementById('roomOption-error');
        if (!roomType) {
            roomOptionErr.textContent = "Select room type first.";
            roomOptionErr.classList.add("active");
            isValid = false;
        } else if (!roomOption) {
            roomOptionErr.textContent = "Select a room option.";
            roomOptionErr.classList.add("active");
            isValid = false;
        }

        // ZIP code
        const zip = document.getElementById('zipCode');
        const zipErr = document.getElementById('zipCode-error');
        if (!zipPattern.test(zip.value)) {
            zipErr.textContent = 'ZIP code must be 5 or 6 digits.';
            zipErr.classList.add('active');
            isValid = false;
        }

        // Gender
        const genderRadios = document.querySelectorAll('input[name="gender"]');
        const genderErr = document.getElementById('gender-error');
        if (![...genderRadios].some(r => r.checked)) {
            genderErr.textContent = 'Please select your gender.';
            genderErr.classList.add('active');
            isValid = false;
        }

        // Terms checkbox
        const terms = document.querySelector('input[name="terms"]');
        const termsErr = document.getElementById('terms-error');
        if (!terms.checked) {
            termsErr.textContent = 'You must agree to the terms.';
            termsErr.classList.add('active');
            isValid = false;
        }

        if (isValid) {
            this.removeEventListener('submit', arguments.callee);
            this.submit();
        }
    });

    // Clear form button
    function clearForm() {
        document.getElementById('registerForm').reset();
        updateRoomOptions();
        document.querySelectorAll('.error-message').forEach(el => {
            el.textContent = '';
            el.classList.remove('active');
        });
    }
    
    // Clear button functionality
    document.querySelector('.clear').addEventListener('click', clearForm);
});