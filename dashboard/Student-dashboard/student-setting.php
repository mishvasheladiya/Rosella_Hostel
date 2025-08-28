<?php
session_start();
if (!isset($base_url)) {
    $base_url = '/Hostel/';
}

$conn = mysqli_connect("localhost", "root", "", "hostel");
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $current_password = mysqli_real_escape_string($conn, $_POST['current_password']);
    $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    if ($new_password !== $confirm_password) {
        $error_message = 'New passwords do not match.';
        $error_field = 'confirm_password';
    } else {
        $query = "SELECT * FROM student WHERE email = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);

            // Verify current password (in real app, use password_verify() for hashed passwords)
            if ($row['password'] === $current_password) {
                // Update new password using prepared statement
                $update = "UPDATE student SET password = ? WHERE email = ?";
                $stmt = mysqli_prepare($conn, $update);
                mysqli_stmt_bind_param($stmt, "ss", $new_password, $email);
                
                if (mysqli_stmt_execute($stmt)) {
                    $success_message = 'Password updated successfully.';
                } else {
                    $error_message = 'Failed to update password.';
                }
            } else {
                $error_message = 'Current password is incorrect.';
                $error_field = 'current_password';
            }
        } else {
            $error_message = 'Email not found.';
            $error_field = 'email';
        }
    }
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password - ROSELLE Hostel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="<?= $base_url; ?>assets/css/student-setting.css" />
</head>
<body>
    <!-- Header and Sidebar -->
    <?php include('student-header.php'); ?>
    <?php include('student-sidebar.php'); ?>

    <!-- Main Content -->
    <div class="dashboard-container">
        <main class="main-content">
            <div class="setting-form-wrapper">
                <form class="setting-form" method="post">
                    <div class="form-header">
                        <h2>Change Password</h2>
                        <p>Update your account password</p>
                    </div>

                    <?php if (isset($error_message)): ?>
                        <div class="status-message error"><?php echo $error_message; ?></div>
                    <?php endif; ?>
                    
                    <?php if (isset($success_message)): ?>
                        <div class="status-message success"><?php echo $success_message; ?></div>
                    <?php endif; ?>

                    <div class="form-group full">
                        <label for="email">Registered Email</label>
                        <input type="email" id="email" name="email" 
                               value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"
                               class="<?php echo (isset($error_field) && $error_field == 'email') ? 'error' : ''; ?>"
                               placeholder="Enter your registered email" required>
                    </div>

                    <div class="form-group full password-toggle">
                        <label for="current_password">Current Password</label>
                        <input type="password" id="current_password" name="current_password" 
                               class="<?php echo (isset($error_field) && $error_field == 'current_password') ? 'error' : ''; ?>"
                               placeholder="Enter current password" required>
                        <i class="fas fa-eye" id="toggleCurrentPassword"></i>
                    </div>

                    <div class="form-row">
                        <div class="form-group password-toggle">
                            <label for="new_password">New Password</label>
                            <input type="password" id="new_password" name="new_password" 
                                   placeholder="Enter new password" required>
                            <i class="fas fa-eye" id="toggleNewPassword"></i>
                        </div>

                        <div class="form-group password-toggle">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" id="confirm_password" name="confirm_password" 
                                   class="<?php echo (isset($error_field) && $error_field == 'confirm_password') ? 'error' : ''; ?>"
                                   placeholder="Re-enter new password" required>
                            <i class="fas fa-eye" id="toggleConfirmPassword"></i>
                        </div>
                    </div>

                    <div class="form-row center">
                        <button type="submit">Update Password</button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script>
        // Password toggle functionality
        function setupPasswordToggle(inputId, iconId) {
            const icon = document.getElementById(iconId);
            icon.addEventListener('click', function() {
                const input = document.getElementById(inputId);
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.replace('fa-eye', 'fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.replace('fa-eye-slash', 'fa-eye');
                }
            });
        }

        // Initialize all password toggles
        setupPasswordToggle('current_password', 'toggleCurrentPassword');
        setupPasswordToggle('new_password', 'toggleNewPassword');
        setupPasswordToggle('confirm_password', 'toggleConfirmPassword');

        // Form validation
        document.querySelector('.setting-form').addEventListener('submit', function(e) {
            const newPassword = document.getElementById('new_password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            
            if (newPassword !== confirmPassword) {
                e.preventDefault();
                alert('New passwords do not match. Please check and try again.');
                document.getElementById('confirm_password').classList.add('error');
            }
        });
    </script>

          <!-- Chatbot (relative path instead of hardcoded) -->
  <?php include($_SERVER['DOCUMENT_ROOT'].'/Hostel/student_chatbot/chat.html'); ?>


</body>
</html>