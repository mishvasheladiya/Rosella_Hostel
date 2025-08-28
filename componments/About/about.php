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
    <meta name="description" content="Discover ROSELLE Hostel - a vibrant and modern student home with heritage, community, and sustainability." />
    <title>Roselle Hostel - About</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <!-- Google Fonts + AOS -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet" />
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />
    
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/carousel-style.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/about-style.css">
</head>
<body>
    <?php 
    $base_url = '/Hostel/';
    include('../../templates/Header/header.php'); 
    ?>
    <div class="carousel-page">
        <div class="carousel-container" >
            <div class="slide">
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
                <div class="carousel" style="background-image: url('<?php echo $base_url; ?>assets/img/carousel/garden.png');">
                  <div class="content">
                    <div class="name">Garden</div>
                    <div class="des">Beautiful green spaces for relaxation</div>
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

    <section class="about-hero">
      <h1>About Our Hostel</h1>
    </section>

    <section class="about-container">   

      <article class="about-row reverse" data-aos="flip-right" data-aos-delay="150">
        <div class="about-text">
          <h2>Community & Culture</h2>
          <p>We celebrate inclusivity and diversity through events and shared experiences. ROSELLE is more than a
            place—it's a feeling of belonging.</p>
        </div>
        <div class="about-img">
          <img src="../../assets/img/about/community.png" alt="Community Events at Roselle" loading="lazy" />
        </div>
      </article>

      <article class="about-row" data-aos="flip-left" data-aos-delay="200">
        <div class="about-text">
          <h2>Sustainability</h2>
          <p>From recycling to smart lighting, ROSELLE is proud to support green living. We educate and inspire our
            residents to make eco-conscious choices daily.</p>
        </div>
        <div class="about-img">
          <img src="../../assets/img/about/sustainability.png" alt="Green Initiatives at Roselle" loading="lazy" />
        </div>
      </article>

      <article class="about-row reverse" data-aos="flip-right" data-aos-delay="250">
        <div class="about-text">
          <h2>Safety & Security</h2>
          <p>Secure access, CCTV surveillance, and trained staff make ROSELLE a safe haven for all residents. Your peace
            of mind matters to us.</p>
        </div>
        <div class="about-img">
          <img src="../../assets/img/about/security.webp" alt="Safety and Security at Roselle" loading="lazy" />
        </div>
      </article>

      <article class="about-row" data-aos="flip-left" data-aos-delay="300">
        <div class="about-text">
          <h2>Health & Wellness</h2>
          <p>ROSELLE promotes well-being through nutritious meals, fitness zones, and peaceful meditation areas. Your
            health is our priority.</p>
        </div>
        <div class="about-img">
          <img src="../../assets/img/about/wellness.png" alt="Health and Wellness at Roselle" loading="lazy" />
        </div>
      </article>

      <article class="about-row reverse" data-aos="flip-right" data-aos-delay="350">
        <div class="about-text">
          <h2>Technology & Connectivity</h2>
          <p>Smart rooms, high-speed Wi-Fi, and digital platforms keep you connected, informed, and empowered with a few
            taps.</p>
        </div>
        <div class="about-img">
          <img src="../../assets/img/about/technology.png" alt="Technology at Roselle" loading="lazy" />
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
          <p>Want to be a part of ROSELLE? <a href="#" style="color: #4a6cf7; text-decoration: underline;">Get in touch</a> or visit us to see the warmth and vibrancy in person.</p>
        </div>
      </article>

    </section>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script src="<?php echo $base_url; ?>assets/js/carousel-script.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            easing: 'ease-in-out',
            once: true,
            mirror: false
        });
    </script>
        <?php include('D:\Xampp\htdocs\Hostel\templates\Footer\footer.php'); ?>

</body>
</html>