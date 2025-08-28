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
  <title>Roselle Hostel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

  <!-- CSS Files -->
  <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/main.css">
  <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/carousel-style.css">
  <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/room-style.css">
  <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/about-style.css">
    <style>
    body {
      font-family: 'Poppins', sans-serif;
      color: whitesmoke;
      line-height: 1.6;
    }
    
    /* Contact CTA Section */
    .contact-cta {
      background-color: #90ACE8;
      padding: 40px 0;
      text-align: center;
      margin-top:-80px;
      padding-bottom: 20px;
    }
    
    .contact-cta h3 {
      margin-bottom: 15px;
      color: whitesmoke;
    }
    
    .contact-cta p {
      max-width: 600px;
      margin: 0 auto 20px;
      color: whitesmoke;
    }
    
    .contact-btn {
      display: inline-block;
      background: #1A2C52;
      color: white;
      padding: 10px 25px;
      border-radius: 5px;
      text-decoration: none;
      transition: all 0.3s ease;
    }
    
    .contact-btn:hover {
      background:#1A2C52;
      transform: translateY(-3px);
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    /* Responsive Adjustments */
    @media (max-width: 768px) {
      .contact-cta {
        padding: 30px 15px;
      }
    }
  </style>
</head>

<body>
  <?php include('templates/Header/header.php'); ?>
  
  <div class="carousel-page">
    <div class="carousel-container">
            <div class="slide">
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
            </div>

      <div class="carousel-buttons">
        <button class="prev"><i class="fa-solid fa-arrow-left"></i></button>
        <button class="next"><i class="fa-solid fa-arrow-right"></i></button>
      </div>
    </div>
  </div>

  <main class="main-content">
<section class="room-hero">
  <h1 style="text-align: center;">Hostel Rooms</h1>
</section>

<!-- Room Cards -->
<section class="room-grid" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">
  
  <!-- 4 Bed AC -->
  <div class="room-card">
    <img src="<?php echo $base_url; ?>assets/img/room/4_bed-AC.png" alt="2 Bed AC Room">
    <h3>4 Bed AC Room</h3>
    <p class="price">&#8377;95,000 per semester</p>
    <div class="features">
      <i class="fas fa-wifi" title="WiFi"></i>
      <i class="fas fa-bolt" title="Power Backup"></i>
      <i class="fas fa-toilet" title="Attached Washroom"></i>
      <i class="fas fa-chair" title="Study Table"></i>
      <i class="fas fa-archive" title="Cupboard"></i>
    </div>
  </div>

  <!-- 6 Bed AC -->
  <div class="room-card">
    <img src="<?php echo $base_url; ?>assets/img/room/6_bed-AC.png" alt="4 Bed AC Room">
    <h3>6 Bed AC Room</h3>
    <p class="price">&#8377;90,000 per semester</p>
    <div class="features">
      <i class="fas fa-wifi" title="WiFi"></i>
      <i class="fas fa-bolt" title="Power Backup"></i>
      <i class="fas fa-toilet" title="Common Washroom"></i>
      <i class="fas fa-chair" title="Study Table"></i>
      <i class="fas fa-archive" title="Cupboard"></i>
    </div>
  </div>

  <!-- 8 Bed AC -->
  <div class="room-card">
    <img src="<?php echo $base_url; ?>assets/img/room/8_bed-AC.png" alt="4 Bed Non-AC Room">
    <h3>8 Bed AC Room</h3>
    <p class="price">&#8377;80,000 per semester</p>
    <div class="features">
      <i class="fas fa-wifi" title="WiFi"></i>
      <i class="fas fa-toilet" title="Common Washroom"></i>
      <i class="fas fa-chair" title="Study Table"></i>
      <i class="fas fa-archive" title="Cupboard"></i>
    </div>
  </div>

  <!-- 4 Bed Non-AC -->
  <div class="room-card">
    <img src="<?php echo $base_url; ?>assets/img/room/4_bed-Non_AC.png" alt="6 Bed AC Room">
    <h3>4 Bed Non-AC Room</h3>
    <p class="price">&#8377;75,500 per semester</p>
    <div class="features">
      <i class="fas fa-wifi" title="WiFi"></i>
      <i class="fas fa-bolt" title="Power Backup"></i>
      <i class="fas fa-toilet" title="Common Washroom"></i>
      <i class="fas fa-chair" title="Study Table"></i>
      <i class="fas fa-archive" title="Cupboard"></i>
    </div>
  </div>

  <!-- 6 Bed Non-AC -->
  <div class="room-card">
    <img src="<?php echo $base_url; ?>assets/img/room/6_bed-Non_AC.png" alt="6 Bed Non-AC Room">
    <h3>6 Bed Non-AC Room</h3>
    <p class="price">&#8377;70,000 per semester</p>
    <div class="features">
      <i class="fas fa-wifi" title="WiFi"></i>
      <i class="fas fa-toilet" title="Common Washroom"></i>
      <i class="fas fa-chair" title="Study Table"></i>
      <i class="fas fa-archive" title="Cupboard"></i>
    </div>
  </div>

  <!-- 8 Bed Non-AC -->
  <div class="room-card">
    <img src="<?php echo $base_url; ?>assets/img/room/8_bed-Non_AC.png" alt="8 Bed AC Room">
    <h3>8 Bed Non-AC Room</h3>
    <p class="price">&#8377;65,500 per semester</p>
    <div class="features">
      <i class="fas fa-wifi" title="WiFi"></i>
      <i class="fas fa-bolt" title="Power Backup"></i>
      <i class="fas fa-toilet" title="Common Washroom"></i>
      <i class="fas fa-chair" title="Study Table"></i>
      <i class="fas fa-archive" title="Cupboard"></i>
    </div>
  </div>

</section>



    <!-- Gallery Section -->
    <section class="common-areas">
      <h2>Other Hostel Areas</h2>
      <div class="gallery">
        <img src="<?php echo $base_url; ?>assets/img/room/lobby.png" alt="Lobby">
        <img src="<?php echo $base_url; ?>assets/img/room/lift.png" alt="Lift">
        <img src="<?php echo $base_url; ?>assets/img/room/staircase.png" alt="Staircase">
        <img src="<?php echo $base_url; ?>assets/img/room/common-washroom.png" alt="Common Area">
        <img src="<?php echo $base_url; ?>assets/img/room/visitor-lounge.png" alt="Visitor Lounge">
        <img src="<?php echo $base_url; ?>assets/img/room/watercooler.png" alt="Water Cooler Area">
      </div>
    </section>

    <section class="about-hero">
      <h1>About Our Hostel</h1>
    </section>
    <!-- About -->
    <section class="about-container">
      <article class="about-row reverse" data-aos="flip-right" data-aos-delay="150">
        <div class="about-text">
          <h2>Community & Culture</h2>
          <p>We celebrate inclusivity and diversity through events and shared experiences. ROSELLE is more than a
            place—it's a feeling of belonging.</p>
        </div>
        <div class="about-img">
          <img src="<?php echo $base_url; ?>assets/img/about/community.png" alt="Community Events at Roselle"
            loading="lazy" />
        </div>
      </article>

      <article class="about-row" data-aos="flip-left" data-aos-delay="200">
        <div class="about-text">
          <h2>Sustainability</h2>
          <p>From recycling to smart lighting, ROSELLE is proud to support green living. We educate and inspire our
            residents to make eco-conscious choices daily.</p>
        </div>
        <div class="about-img">
          <img src="<?php echo $base_url; ?>assets/img/about/sustainability.png" alt="Green Initiatives at Roselle"
            loading="lazy" />
        </div>
      </article>

      <article class="about-row reverse" data-aos="flip-right" data-aos-delay="250">
        <div class="about-text">
          <h2>Safety & Security</h2>
          <p>Secure access, CCTV surveillance, and trained staff make ROSELLE a safe haven for all residents. Your peace
            of mind matters to us.</p>
        </div>
        <div class="about-img">
          <img src="<?php echo $base_url; ?>assets/img/about/security.webp" alt="Safety and Security at Roselle"
            loading="lazy" />
        </div>
      </article>

      <article class="about-row" data-aos="flip-left" data-aos-delay="300">
        <div class="about-text">
          <h2>Health & Wellness</h2>
          <p>ROSELLE promotes well-being through nutritious meals, fitness zones, and peaceful meditation areas. Your
            health is our priority.</p>
        </div>
        <div class="about-img">
          <img src="<?php echo $base_url; ?>assets/img/about/wellness.png" alt="Health and Wellness at Roselle"
            loading="lazy" />
        </div>
      </article>

      <article class="about-row reverse" data-aos="flip-right" data-aos-delay="350">
        <div class="about-text">
          <h2>Technology & Connectivity</h2>
          <p>Smart rooms, high-speed Wi-Fi, and digital platforms keep you connected, informed, and empowered with a few
            taps.</p>
        </div>
        <div class="about-img">
          <img src="<?php echo $base_url; ?>assets/img/about/technology.png" alt="Technology at Roselle"
            loading="lazy" />
        </div>
      </article>

      <article class="about-row full-width" data-aos="fade-left" data-aos-delay="400">
        <div class="about-text">
          <h2>Testimonials</h2>
          <p><strong>"Living at ROSELLE has been a life-changing experience."</strong> – Anika Sharma</p>
          <p><strong>"Supportive staff and great facilities!"</strong> – Rahul Patel</p>
        </div>
      </article>

      <article class="about-row full-width" data-aos="fade-up" data-aos-delay="450">
        <div class="about-text">
          <h2>Awards & Recognition</h2>
          <p>Ranked among the best student hostels for innovation, care, and sustainable living. We aim to exceed
            expectations every day.</p>
        </div>
      </article>

      <article class="about-row full-width" data-aos="fade-right" data-aos-delay="500">
        <div class="about-text">
          <h2>Contact & Visit Us</h2>
          <p>Want to be a part of ROSELLE? <a href="#" style="color: #4a6cf7; text-decoration: underline;">Get in
              touch</a> or visit us to see the warmth and vibrancy in person.</p>
        </div>
      </article>
    </section>
    <section class="contact-cta full-width" data-aos="fade-up" data-aos-delay="450">
      <div class="container">
        <h3>Have Questions?</h3>
        <p>Get in touch with our team for more information about our hostel facilities and services.</p>
        <a href="<?php echo $base_url; ?>componments/Contact/contact.php" class="contact-btn">Contact Us</a>
      </div>
    </section>
  </main>

  <!-- JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
  <script src="<?php echo $base_url; ?>assets/js/carousel-script.js"></script>
  <script>
    // Initialize AOS
    AOS.init({
      duration: 1000,
      easing: 'ease-in-out',
      once: true,
      mirror: false
    });
  </script>

  <?php include('templates/Footer/footer.php'); ?>
</body>

</html>