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
    <title>Roselle Hostel - Room</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/main.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/carousel-style.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/room-style.css">
    
</head>
<body>
    <?php 
    include('../../templates/Header/header.php'); 
    ?>
    
    <div class="carousel-page">
        <div class="carousel-container" >
            <div class="slide">

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
                <div class="carousel" style="background-image: url('<?php echo $base_url; ?>assets/img/carousel/building.png');">
                  <div class="content">
                    <div class="name">Building</div>
                    <div class="des">Our main hostel building with modern facilities</div>
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

    <section class="room-hero">
      <h1 style="text-align:center;">Hostel Rooms</h1>
    </section>
    
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
  <?php include('D:\Xampp\htdocs\Hostel\templates\Footer\footer.php'); ?>
    
    <!-- JavaScript (same as original) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script src="<?php echo $base_url; ?>assets/js/carousel-script.js"></script>
</body>
</html>