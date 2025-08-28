<?php
if (!isset($base_url)) {
    $base_url = '/Hostel/';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/carousel-style.css">
</head>
<body>
        <div class="carousel-page">
        <div class="carousel-container">
            <div class="slide">
                <div class="carousel" style="background-image: url(https://i.ibb.co/qCkd9jS/img1.jpg);">
                    <div class="content">
                        <div class="name">Switzerland</div>
                        <div class="des">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ab, eum!</div>
                        <button>See More</button>
                    </div>
                </div>
                <div class="carousel" style="background-image: url(https://i.ibb.co/jrRb11q/img2.jpg);"></div>
                <div class="carousel" style="background-image: url(https://i.ibb.co/NSwVv8D/img3.jpg);"></div>
                <div class="carousel" style="background-image: url(https://i.ibb.co/Bq4Q0M8/img4.jpg);"></div>
                <div class="carousel" style="background-image: url(https://i.ibb.co/jTQfmTq/img5.jpg);"></div>
                <div class="carousel" style="background-image: url(https://i.ibb.co/RNkk6L0/img6.jpg);"></div>
            </div>

            <div class="carousel-buttons">
                <button class="prev"><i class="fa-solid fa-arrow-left"></i></button>
                <button class="next"><i class="fa-solid fa-arrow-right"></i></button>
            </div>
        </div>
    </div>

    <script src="<?php echo $base_url; ?>assets/js/carousel-script.js"></script>
</body>
</html>