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
    <meta name="description" content="Contact ROSELLE Hostel - a vibrant and modern student home with heritage, community, and sustainability.">
    <title>Roselle Hostel - Information</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/main.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/carousel-style.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/informtion-style.css">

</head>

<body>
    <?php
    include('../../templates/Header/header.php');
    ?>

    <div class="carousel-page">
        <div class="carousel-container" >
            <div class="slide">

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
                <div class="carousel" style="background-image: url('<?php echo $base_url; ?>assets/img/carousel/study.jpg');">
                  <div class="content">
                    <div class="name">Study</div>
                    <div class="des">Quiet study areas for students</div>
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


    <section class="menu-header">
        <h1>Facilities & Rules</h1>
    </section>

    <div class="tabs-container">
        <ul class="tab-buttons">
            <?php
            $tabs = ["Facilities", "Rules"];
            foreach ($tabs as $index => $tab) {
                $active = $index === 0 ? "active" : "";
                echo "<li class='tab-btn $active' onclick='showTab($index)'>$tab</li>";
            }
            ?>
        </ul>

        <div class="tab-content">
            <!-- Facilities Panel -->
            <div class="tab-panel show">
                <div class="grid-container">
                    <?php
                    $facilities = [
                        ["image" => "wifi.png", "text" => "High-Speed Wi-Fi", "desc" => "Unlimited access in all rooms and common areas."],
                        ["image" => "laundry.png", "text" => "Laundry Services", "desc" => "Weekly laundry pickup and delivery."],
                        ["image" => "mess.png", "text" => "Nutritious Meals", "desc" => "4 times daily freshly cooked vegetarian meals."],
                        ["image" => "study.png", "text" => "Study Hall", "desc" => "Quiet area with comfortable seating & lighting."],
                        ["image" => "room.png", "text" => "Spacious Rooms", "desc" => "Fully furnished rooms with attached bathrooms."],
                        ["image" => "cleaning.png", "text" => "Housekeeping", "desc" => "Rooms cleaned twice a week, dusting and mopping included."],
                    ];

                    foreach ($facilities as $item) {
                        echo "
  <div class='facility-box'>
    <img src='{$base_url}assets/img/infomation/{$item['image']}' alt='{$item['text']}' />
    <h3>{$item['text']}</h3>
    <p class='desc'>{$item['desc']}</p>
  </div>
";
                    }
                    ?>
                </div>
            </div>

            <!-- Rules Panel -->
            <div class="tab-panel">
                <div class="rules-grid">
                    <?php
                    $rules = [
                        ["icon" => "fa-hand-sparkles", "title" => "Keep Clean", "desc" => "Maintain hygiene in your room and common areas.", "type" => "do"],
                        ["icon" => "fa-clock", "title" => "Be Punctual", "desc" => "Adhere to curfew and meal timings.", "type" => "do"],
                        ["icon" => "fa-user-friends", "title" => "Respect Others", "desc" => "Behave respectfully with staff and peers.", "type" => "do"],
                        ["icon" => "fa-user-shield", "title" => "No Ragging", "desc" => "Ragging is strictly prohibited and punishable.", "type" => "dont"],
                        ["icon" => "fa-volume-mute", "title" => "Avoid Noise", "desc" => "Silence must be maintained during study hours.", "type" => "dont"],
                        ["icon" => "fa-door-closed", "title" => "No Late Entry", "desc" => "Entry not allowed after 10:30 PM without permission.", "type" => "dont"],
                    ];

                    foreach ($rules as $rule) {
                        $colorClass = $rule["type"] === "do" ? "rule-card do" : "rule-card dont";
                        echo "
              <div class='$colorClass'>
                <div class='icon'><i class='fas {$rule['icon']}'></i></div>
                <h3>{$rule['title']}</h3>
                <p>{$rule['desc']}</p>
              </div>
            ";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript (same as original) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script src="<?php echo $base_url; ?>assets/js/carousel-script.js"></script>
    <script src="<?php echo $base_url; ?>assets/js/information-script.js"></script>

  <?php include('D:\Xampp\htdocs\Hostel\templates\Footer\footer.php'); ?>
</body>

</html>