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
    <meta name="description"
        content="Contact ROSELLE Hostel - a vibrant and modern student home with heritage, community, and sustainability.">
    <title>Roselle Hostel - Menu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/main.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/carousel-style.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/menu-style.css">

</head>

<body>
    <?php 
    include('../../templates/Header/header.php'); 
    ?>
    <div class="carousel-page">
        <div class="carousel-container" >
            <div class="slide">
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
                <div class="carousel" style="background-image: url('<?php echo $base_url; ?>assets/img/carousel/room1.png');">
                  <div class="content">
                    <div class="name">Room</div>
                    <div class="des">Comfortable and clean student rooms</div>
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

    <section class="hero">
        <h1>Hostel Mess</h1>
    </section>

    <section class="mess-highlights">
        <div class="highlight-card">
        <img src="<?php echo $base_url; ?>assets/img/menu/mess_thali.png" alt="Mess Thali">
        <h3>Nutritious Meals</h3>
        <p>Balanced diet with healthy and hygienic food options every day.</p>
        </div>
        <div class="highlight-card">
        <img src="<?php echo $base_url; ?>assets/img/menu/clean_kitchen.png" alt="Clean Kitchen">
        <h3>Hygienic Kitchen</h3>
        <p>Strict cleanliness and safety standards in food preparation.</p>
        </div>
        <div class="highlight-card">
        <img src="<?php echo $base_url; ?>assets/img/menu/dining_area.png" alt="Dining Area">
        <h3>Spacious Dining Area</h3>
        <p>Comfortable space with proper seating and ventilation.</p>
        </div>
    </section>

    <section class="mess-timings">
        <h2>Mess Timings</h2>
        <ul>
        <li>🍽 Breakfast: 7:30 AM – 9:00 AM</li>
        <li>🍽 Lunch: 12:30 PM – 2:00 PM</li>
        <li>🍽 Dinner: 7:30 PM – 9:00 PM</li>
        </ul>
    </section>

    <section class="contact-prompt">
        <p>Have questions about our food service? We’re here to help!</p>
        <a href="<?php echo $base_url; ?>componments/Contact/contact.php" class="contact-btn">Contact Us</a>
    </section>


    <!-- JavaScript (same as original) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script src="<?php echo $base_url; ?>assets/js/carousel-script.js"></script>

  <?php include('D:\Xampp\htdocs\Hostel\templates\Footer\footer.php'); ?>
</body>

</html>