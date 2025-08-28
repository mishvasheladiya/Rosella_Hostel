<?php
// Database connection and form handling at the TOP of the file
$conn = new mysqli("localhost", "root", "", "hostel");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $message = $conn->real_escape_string($_POST['message']);

    // Insert into database
    $sql = "INSERT INTO contact_messages (name, email, message) VALUES ('$name', '$email', '$message')";

    if ($conn->query($sql)) {
        echo "<script>
              alert('Message sent successfully!'); 
              window.location.href='contact.php';
              </script>";
    } else {
        echo "<script>
              alert('Error sending message: " . addslashes($conn->error) . "'); 
              window.location.href='contact.php';
              </script>";
    }

    $conn->close();
    exit(); // Important to prevent further HTML rendering
}

if (!isset($base_url)) {
    $base_url = '/Hostel/';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Contact ROSELLE Hostel - a vibrant and modern student home with heritage, community, and sustainability.">
    <title>Roselle Hostel - Contact</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/main.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/carousel-style.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/contact-style.css">
</head>
<body>
    <?php 
    include('../../templates/Header/header.php'); 
    ?>
    
    <div class="carousel-page">
        <div class="carousel-container">
            <div class="slide">
                <div class="carousel" style="background-image: url('<?php echo $base_url; ?>assets/img/carousel/room1.png');">
                  <div class="content">
                    <div class="name">Room</div>
                    <div class="des">Comfortable and clean student rooms</div>
                    <button>See More</button>
                  </div>
                </div>
                <div class="carousel" style="background-image: url('<?php echo $base_url; ?>assets/img/carousel/study.jpg');">
                  <div class="content">
                    <div class="name">Study</div>
                    <div class="des">Quiet study areas for students</div>
                    <button>See More</button>
                  </div>
                </div>
                <div class="carousel" style="background-image: url('<?php echo $base_url; ?>assets/img/carousel/mess.jpg');">
                  <div class="content">
                    <div class="name">Mess</div>
                    <div class="des">Healthy and hygienic dining facility</div>
                    <button>See More</button>
                  </div>
                </div>
                <div class="carousel" style="background-image: url('<?php echo $base_url; ?>assets/img/carousel/garden.png');">
                  <div class="content">
                    <div class="name">Garden</div>
                    <div class="des">Beautiful green spaces for relaxation</div>
                    <button>See More</button>
                  </div>
                </div>
                <div class="carousel" style="background-image: url('<?php echo $base_url; ?>assets/img/carousel/building.png');">
                  <div class="content">
                    <div class="name">Building</div>
                    <div class="des">Our main hostel building with modern facilities</div>
                    <button>See More</button>
                  </div>
                </div>
                <div class="carousel" style="background-image: url('<?php echo $base_url; ?>assets/img/carousel/floor.png');">
                  <div class="content">
                    <div class="name">Floor</div>
                    <div class="des">Spacious and well-maintained hostel floors</div>
                    <button>See More</button>
                  </div>
                </div>
            </div>

            <div class="carousel-buttons">
                <button class="prev"><i class="fa-solid fa-arrow-left"></i></button>
                <button class="next"><i class="fa-solid fa-arrow-right"></i></button>
            </div>
        </div>
    </div>

    <section class="contact-hero">
      <h1>Contact Us</h1>
    </section>
    
    <div class="contact-page-container">
        <!-- Flip Card -->
        <div class="contact-flip-card" id="flipCard">
          <div class="contact-flip-card-inner">
            <div class="contact-flip-card-front">
              <div class="contact-page-icon">
                <i class="fas fa-envelope"></i>
              </div>
              <h2 class="contact-page-title">Contact Info</h2>
              
              <div class="contact-page-info">
                <div class="contact-page-info-item">
                  <i class="fas fa-phone-alt"></i>
                  <span>+123-456-7890</span>
                </div>
                <div class="contact-page-info-item">
                  <i class="fas fa-envelope"></i>
                  <span>rosellehostel@gmail.com</span>
                </div>
                <div class="contact-page-info-item">
                  <i class="fas fa-map-marker-alt"></i>
                  <span>123 Roselle Street, City, Country</span>
                </div>
              </div>
              
              <div class="contact-social-links">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
              </div>
              
              <!-- Flip Icon Button -->
              <div class="flip-icon-btn">
                <i class="fas fa-sync-alt"></i>
              </div>
            </div>
            
            <div class="contact-flip-card-back">
              <h2 class="contact-page-titles" style="color: #16213E;">Send a Message</h2>
              
              <form class="contact-page-form" method="POST">
                <div class="contact-form-group">
                  <label for="name">Your Name</label>
                  <input type="text" id="name" name="name" class="contact-form-control" placeholder="Enter your name" required>
                </div>
                
                <div class="contact-form-group">
                  <label for="email">Email Address</label>
                  <input type="email" id="email" name="email" class="contact-form-control" placeholder="Enter your email" required>
                </div>
                
                <div class="contact-form-group">
                  <label for="message">Your Message</label>
                  <textarea id="message" name="message" class="contact-form-control" placeholder="Enter your message" required></textarea>
                </div>
                
                <button type="submit" class="contact-submit-btn">
                  Send Message <i class="fas fa-paper-plane"></i>
                </button>
              </form>
              
              <!-- Flip Icon Button -->
              <div class="flip-icon-btn">
                <i class="fas fa-sync-alt"></i>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Contact Details -->
        <div class="contact-page-details">
            <h2>Visit Us</h2>
            <p>Roselle Hostel is conveniently located in the heart of the city, easily accessible by public transportation. Our friendly staff is available 24/7 to assist you with any questions or requests.</p>
            
            <h3 class="mt-4">Office Hours</h3>
            <p>Monday - Friday: 9:00 AM - 6:00 PM<br>
            Saturday: 10:00 AM - 4:00 PM<br>
            Sunday: Closed</p>
            
            <h3 class="mt-4">Emergency Contact</h3>
            <p>For after-hours emergencies, please call: <strong>+123-456-7890</strong></p>
        </div>
    </div>
    
    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script src="<?php echo $base_url; ?>assets/js/carousel-script.js"></script>
    <script>
      AOS.init({
          duration: 1000,
          easing: 'ease-in-out',
          once: true
      });

      // Flip card functionality
      const flipCard = document.getElementById('flipCard');
      const flipButtons = document.querySelectorAll('.flip-icon-btn');

      // Add click event to flip buttons
      flipButtons.forEach(button => {
          button.addEventListener('click', function (e) {
              e.stopPropagation(); // Prevent triggering the card click event
              flipCard.classList.toggle('active');
          });
      });

      // Optional: Keep this if you want the whole card to be clickable
      flipCard.addEventListener('click', function () {
          this.classList.toggle('active');
      });

      document.getElementById('flipCard').addEventListener('click', function () {
          this.classList.toggle('active');
      });
    </script>
  <?php include('D:\Xampp\htdocs\Hostel\templates\Footer\footer.php'); ?>
</body>
</html>