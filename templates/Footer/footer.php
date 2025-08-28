<?php
if (!isset($base_url)) {
    $base_url = '/Hostel/'; // Base URL for project
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hostel Website Footer</title>

  <!-- FontAwesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
    }

    /* ================= FOOTER ================= */
    .footer {
      background: #0b1d51;
      color: #fff;
      padding: 50px 20px 20px;
    }

    .footer-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 30px;
      max-width: 1200px;
      margin: auto;
    }

    .footer-section h2,
    .footer-section h3 {
      color: #f6f9ff;
      margin-bottom: 15px;
    }

    .footer-section p {
      font-size: 14px;
      line-height: 1.6;
      color: #ddd;
    }

    .footer-section ul {
      list-style: none;
      padding: 0;
    }

    .footer-section ul li {
      margin: 8px 0;
    }

    .footer-section ul li a {
      color: #ddd;
      text-decoration: none;
      transition: 0.3s;
    }

    .footer-section ul li a:hover {
      color: #ffb703;
    }

    .footer-section.contact p i {
      margin-right: 10px;
      color: #ffb703;
    }

    .footer-section.social a {
      display: inline-block;
      margin: 0 10px 0 0;
      font-size: 18px;
      color: #ddd;
      transition: 0.3s;
    }

    .footer-section.social a:hover {
      color: #ffb703;
    }

    /* Subscribe Section */
    .footer-section.subscribe p {
      font-size: 14px;
      margin-bottom: 10px;
      color: #ddd;
    }

    .subscribe-box {
      display: flex;
      gap: 10px;
    }

    .subscribe-box input {
      flex: 1;
      padding: 10px;
      border: none;
      border-radius: 4px;
      outline: none;
      font-size: 14px;
    }

    .subscribe-box button {
      background: #ffb703;
      border: none;
      padding: 10px 18px;
      border-radius: 4px;
      font-weight: 600;
      cursor: pointer;
      transition: 0.3s;
    }

    .subscribe-box button:hover {
      background: #ffa600;
    }

    .footer-bottom {
      text-align: center;
      margin-top: 20px;
      padding-top: 15px;
      border-top: 1px solid rgba(255,255,255,0.2);
      font-size: 14px;
      color: #aaa;
    }
  </style>
</head>
<body>

  <!-- ================= Footer Start ================= -->
  <footer class="footer">
    <div class="footer-container">
      <!-- Hostel Info -->
      <div class="footer-section about">
        <h2>ROSELLE Hostel</h2>
        <p>
          A comfortable and safe place for students. We provide modern facilities,
          affordable rooms, and a friendly environment to make you feel at home.
        </p>
      </div>

      <!-- Quick Links -->
      <div class="footer-section links">
        <h3>Quick Links</h3>
        <ul>
          <li><a href="<?php echo $base_url; ?>index.php">Home</a></li>
          <li><a href="<?php echo $base_url; ?>componments/Room/room.php">Rooms</a></li>
          <li><a href="<?php echo $base_url; ?>componments/About/about.php">About</a></li>
          <li><a href="<?php echo $base_url; ?>componments/Contact/contact.php">Contact</a></li>
        </ul>
      </div>

      <!-- Contact -->
      <div class="footer-section contact">
        <h3>Contact Us</h3>
        <p><i class="fas fa-map-marker-alt"></i> Rajkot, Gujarat</p>
        <p><i class="fas fa-phone-alt"></i> +91 98765 43210</p>
        <p><i class="fas fa-envelope"></i> info@rosellehostel.com</p>
      </div>

      <!-- Social Media + Subscribe -->
      <div class="footer-section social">
        <h3>Follow Us</h3>
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>

        <!-- Subscribe -->
        <div class="footer-section subscribe" style="margin-top:20px;">
          <h3>Subscribe</h3>
          <p>Get the latest updates and offers directly in your inbox.</p>
          <form class="subscribe-box" action="#" method="post">
            <input type="email" name="email" placeholder="Enter your email" required>
            <button type="submit">Subscribe</button>
          </form>
        </div>
      </div>
    </div>

    <div class="footer-bottom">
      <p>&copy; 2025 ROSELLE Hostel | All Rights Reserved.</p>
    </div>
  </footer>
  <!-- ================= Footer End ================= -->

</body>
</html>
