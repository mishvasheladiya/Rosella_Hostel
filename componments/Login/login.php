


<?php if (!isset($base_url)) {
    $base_url = '/Hostel/';
}?>
<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "hostel");

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check for student
    $studentQuery = "SELECT * FROM student WHERE email='$email' AND password='$password'";
    $studentResult = mysqli_query($conn, $studentQuery);

    if (mysqli_num_rows($studentResult) === 1) {
        $_SESSION['email'] = $email;
        echo "<script>alert('Welcome Student!'); window.location.href='../../dashboard/Student-dashboard/student-dashboard.php';</script>";
        exit;
    }

    // Check for admin
    $adminQuery = "SELECT * FROM admin WHERE email='$email' AND password='$password'";
    $adminResult = mysqli_query($conn, $adminQuery);

    if (mysqli_num_rows($adminResult) === 1) {
        $_SESSION['email'] = $email;
        echo "<script>alert('Welcome Admin!'); window.location.href='../../dashboard/Admin-dashboard/admin-dashboard.php';</script>";
        exit;
    }

    // Invalid login
    echo "<script>alert('Invalid email or password'); window.location.href='login.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="<?= $base_url; ?>assets/css/login-style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="top-right-icons">
        <button id="theme-toggle" class="theme-toggle" aria-label="Toggle dark mode">
            <i class="fas fa-moon"></i>
        </button>
        <button id="close-btn" class="close-btn" aria-label="Close page">
            <i class="fas fa-times"></i>
        </button>
    </div>
    
    <section class="login-container">
        <div class="login">
            <h1><b>Sign In</b></h1>
            <div class="login-part">
                <form action="" method="POST" id="loginForm" novalidate>
                    <div class="form-container">
                        <div class="input-group">
                            <label for="email">Email:</label>
                            <div class="input-wrapper">
                                <i class="fas fa-envelope"></i>
                                <input type="email" id="email" name="email" placeholder="Enter your email" required aria-describedby="email-error">
                                <span id="email-error" class="error-message">
                                    <?php if (!empty($error)) echo $error; ?>
                                </span>
                            </div>
                        </div>
                        <div class="input-group">
                            <label for="password">Password:</label>
                            <div class="input-wrapper">
                                <i class="fas fa-lock"></i>
                                <i class="fas fa-eye toggle-password" tabindex="0" role="button" aria-label="Toggle password visibility" style=" margin-right: 10px;"></i>
                                <input type="password" id="password" name="password" placeholder="Enter your password" required aria-describedby="password-error">
                                <span id="password-error" class="error-message" aria-live="polite"></span>
                            </div>
                        </div>
                        <div class="options">
                            <label><input type="checkbox" name="remember"> Remember me</label>
                            <a href="forget.php">Forgot password?</a>
                        </div>
                        <div class="login-btn">
                            <button type="submit" class="button">Sign In</button>
                        </div>
                        <div class="divider">
                            <hr><span>OR continue with</span><hr>
                        </div>

                        <div class="social-login">
                            <a href="<?= $url ?>" class="social-btn google">
                                <i class="fab fa-google"></i> Continue with Google
                            </a>
                        </div>

                        <div>
                            <p class="register">Don't have an account? <a href="../Register/register.php">Sign Up</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <div style="text-align: center; color: white; position: absolute; bottom: 10px; width: 100%;">
    </div>
    <script src="<?php echo $base_url; ?>assets/js/login-script.js"></script>

</body>
</html>