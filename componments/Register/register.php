<?php
if (!isset($base_url)) {
    $base_url = '/Hostel/';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/register-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <button id="theme-toggle" class="theme-toggle">
        <i class="fas fa-moon"></i>
    </button>
    <button id="close-btn" class="close-btn">
        <i class="fas fa-times"></i>
    </button>
    
    <section class="register-container">
        <div class="register">
            <h1><b>Create New Account</b></h1>
            <div class="register-part">
                <form action="" method="POST" id="registerForm" novalidate>
                    <div class="form-container">
                        <div class="input-row">
                            <div class="input-group">
                                <label for="firstName">First Name:</label>
                                <div class="input-wrapper">
                                    <i class="fas fa-user"></i>
                                    <input type="text" id="firstName" name="firstName" placeholder="Enter your first name" required aria-describedby="firstName-error">
                                    <span id="firstName-error" class="error-message"></span>
                                </div>
                            </div>
                            <div class="input-group">
                                <label for="lastName">Last Name:</label>
                                <div class="input-wrapper">
                                    <i class="fas fa-user"></i>
                                    <input type="text" id="lastName" name="lastName" placeholder="Enter your last name" required aria-describedby="lastName-error">
                                    <span id="lastName-error" class="error-message"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group">
                            <label for="email">Email:</label>
                            <div class="input-wrapper">
                                <i class="fas fa-envelope"></i>
                                <input type="email" id="email" name="email" placeholder="Enter your email" required aria-describedby="email-error">
                                <span id="email-error" class="error-message"></span>
                            </div>
                        </div>
                        <div class="input-group">
                            <label for="password">Password:</label>
                            <div class="input-wrapper">
                                <i class="fas fa-lock"></i>
                                <i class="fas fa-eye toggle-password"></i>
                                <input type="password" id="password" name="password" placeholder="Enter your password" required aria-describedby="password-error">
                                <span id="password-error" class="error-message"></span>
                            </div>
                        </div>
                        <div class="input-group">
                            <label for="confirmPassword">Confirm Password:</label>
                            <div class="input-wrapper">
                                <i class="fas fa-lock"></i>
                                <i class="fas fa-eye toggle-confirm-password"></i>
                                <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm your password" required aria-describedby="confirmPassword-error">
                                <span id="confirmPassword-error" class="error-message"></span>
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-group">
                                <label for="phone">Phone Number:</label>
                                <div class="input-wrapper">
                                    <i class="fas fa-phone"></i>
                                    <input type="tel" id="phone" name="phone" placeholder="Enter phone number" required pattern="[0-9]{10}" aria-describedby="phone-error">
                                    <span id="phone-error" class="error-message"></span>
                                </div>
                            </div>
                            <div class="input-group" style="">
                                <label for="dob">Date of Birth:</label>
                                <div class="input-wrapper">
                                    <i class="fas fa-calendar"></i>
                                    <input type="date" id="dob" name="dob" required aria-describedby="dob-error">
                                    <span id="dob-error" class="error-message"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group">
                            <label>Gender:</label>
                            <div class="radio-group" id="gender" aria-describedby="gender-error">
                                <label><input type="radio" name="gender" value="male" required> Male</label>
                                <label><input type="radio" name="gender" value="female"> Female</label>
                                <label><input type="radio" name="gender" value="other"> Other</label>
                            </div>
                            <span id="gender-error" class="error-message"></span>
                        </div>
                        <div class="input-row">
                            <div class="input-group">
                                <label for="roomType">Room Type:</label>
                                <div class="input-wrapper">
                                    <i class="fas fa-bed"></i>
                                    <select id="roomType" name="roomType" required aria-describedby="roomType-error">
                                        <option value="">Select Type</option>
                                        <option value="AC">AC</option>
                                        <option value="NON-AC">NON-AC</option>
                                    </select>
                                    <span id="roomType-error" class="error-message"></span>
                                </div>
                            </div>
                            <div class="input-group">
                                <label for="roomOption">Room Option:</label>
                                <div class="input-wrapper">
                                    <i class="fas fa-bed"></i>
                                    <select id="roomOption" name="roomOption" required aria-describedby="roomOption-error">
                                        <option value="">Select Option</option>
                                    </select>
                                    <span id="roomOption-error" class="error-message"></span>
                                </div>
                            </div>
                        </div>
                        <h2 class="section-title">Address Information</h2>
                        <div class="input-row">
                            <div class="input-group">
                                <label for="streetAddress">Street Address:</label>
                                <div class="input-wrapper">
                                    <i class="fas fa-home"></i>
                                    <input type="text" id="streetAddress" name="streetAddress" placeholder="Enter street address" required aria-describedby="streetAddress-error">
                                    <span id="streetAddress-error" class="error-message"></span>
                                </div>
                            </div>
                            <div class="input-group">
                                <label for="zipCode">ZIP Code:</label>
                                <div class="input-wrapper">
                                    <i class="fas fa-map-pin"></i>
                                    <input type="text" id="zipCode" name="zipCode" placeholder="Enter ZIP code" required pattern="[0-9]{5,6}" aria-describedby="zipCode-error">
                                    <span id="zipCode-error" class="error-message"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-group">
                                <label for="city">City:</label>
                                <div class="input-wrapper">
                                    <i class="fas fa-city"></i>
                                    <input type="text" id="city" name="city" placeholder="Enter city" required aria-describedby="city-error">
                                    <span id="city-error" class="error-message"></span>
                                </div>
                            </div>
                            <div class="input-group">
                                <label for="state">State:</label>
                                <div class="input-wrapper">
                                    <i class="fas fa-map"></i>
                                    <input type="text" id="state" name="state" placeholder="Enter state" required aria-describedby="state-error">
                                    <span id="state-error" class="error-message"></span>
                                </div>
                            </div>
                        </div>
                        <h2 class="section-title">Education Information</h2>
                        <div class="input-row">
                            <div class="input-group">
                                <label for="university">University:</label>
                                <div class="input-wrapper">
                                    <i class="fas fa-university"></i>
                                    <input type="text" id="university" name="university" placeholder="Enter university" required aria-describedby="university-error">
                                    <span id="university-error" class="error-message"></span>
                                </div>
                            </div>
                            <div class="input-group">
                                <label for="course">Course:</label>
                                <div class="input-wrapper">
                                    <i class="fas fa-book"></i>
                                    <input type="text" id="course" name="course" placeholder="Enter course" required aria-describedby="course-error">
                                    <span id="course-error" class="error-message"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group">
                            <label for="userType">User Type:</label>
                            <div class="input-wrapper">
                                <i class="fas fa-user-graduate"></i>
                                <select id="userType" name="userType" required aria-describedby="userType-error">
                                    <option value="">Select User Type</option>
                                    <option value="student">Student</option>
                                    <option value="faculty">Faculty</option>
                                    <option value="staff">Staff</option>
                                    <option value="guest">Guest</option>
                                </select>
                                <span id="userType-error" class="error-message"></span>
                            </div>
                        </div>
                        <div class="input-group">
                            <label class="terms-label">
                                <input type="checkbox" name="terms" required aria-describedby="terms-error"> I agree to Terms & Conditions & Privacy Policy
                            </label>
                            <span id="terms-error" class="error-message"></span>
                        </div>
                        <div class="form-buttons">
                            <button type="submit" name="submit" class="button">Create Account</button>
                            <button type="button" class="button clear" onclick="clearForm()">Reset</button>
                        </div>
                        <div>
                            <p class="login">Already have an account? <a href="../Login/login.php">Sign In</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script src="<?php echo $base_url; ?>assets/js/register-script.js"></script>
</body>
</html><br>

<?php
$conn = mysqli_connect("localhost", "root", "", "hostel");
$connectionMsg = $conn ? "Database Connected" : "Not Connected";

if (isset($_POST['submit'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $roomType = $_POST['roomType'];
    $roomOption = $_POST['roomOption'];
    $streetAddress = $_POST['streetAddress'];
    $zipCode = $_POST['zipCode'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $university = $_POST['university'];
    $course = $_POST['course'];
    $userType = $_POST['userType'];
    $agreedToTerms = isset($_POST['terms']) ? 1 : 0; // checkbox check

    // Check if email exists
    $result = mysqli_query($conn, "SELECT * FROM student WHERE email='$email'");
    if (mysqli_num_rows($result)) {
        echo "
            <script>
                alert('Email is already in use!');
            </script>
        ";
    } else {
        $sql = "INSERT INTO student 
    (firstName, lastName, email, password, phone, dob, gender, roomType, roomOption, streetAddress, zipCode, city, state, university, course, userType, agreedToTerms) 
    VALUES 
    ('$firstName', '$lastName', '$email', '$password', '$phone', '$dob', '$gender', '$roomType', '$roomOption', '$streetAddress', '$zipCode', '$city', '$state', '$university', '$course', '$userType', '$agreedToTerms')";

$result=mysqli_query($conn,$sql);

        if ($result) 
        {
            echo "
                <script>
                    alert('Your Account Created');
                    window.location.href='../Login/login.php';
                </script>
            ";
        } 
        else {
            echo "Data not Inserted";
        }
    }
}
?>

<div style="text-align: center; color: white; position: absolute; bottom: 10px; width: 100%;">
    <?php echo $connectionMsg; ?>
</div>