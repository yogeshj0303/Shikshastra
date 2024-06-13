<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Shikshastra | Gallery</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="keywords" content="Free HTML Templates" />
  <meta name="description" content="Free HTML Templates" />

  <!-- Favicon -->
  <link href="img/favicon.ico" rel="icon" />

  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link href="https://fonts.googleapis.com/css2?family=Handlee&family=Nunito&display=swap" rel="stylesheet" />

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet" />

  <!-- Flaticon Font -->
  <link href="lib/flaticon/font/flaticon.css" rel="stylesheet" />

  <!-- Libraries Stylesheet -->
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" />
  <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet" />

  <!-- Customized Bootstrap Stylesheet -->
  <link href="css/style.css" rel="stylesheet" />

  <!-- Custom CSS -->
  <style>
    .portfolio-item img {
      width: 100%;
      height: 250px; /* Set a fixed height */
      object-fit: cover; /* Ensure the aspect ratio is maintained */
    }
  </style>
</head>

<body>
  <!-- Navbar Start -->
  <x-header />
  <!-- Navbar End -->

  <!-- Header Start -->
  <div class="container-fluid mb-5" style="background-image: url('frontend/contact-us.jpg'); background-size: cover; background-position: center;">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px;">
      <h3 class="display-3 font-weight-bold text-white">Gallery</h3>
      <div class="d-inline-flex text-white">
        <p class="m-0"><a class="text-white" href="/">Home</a></p>
        <p class="m-0 px-2">/</p>
        <p class="m-0">Gallery</p>
      </div>
    </div>
  </div>
  <!-- Header End -->

  <!-- Gallery Start -->
  <div class="container-fluid pt-5 pb-3">
    <div class="container">
      <div class="text-center pb-2">
        <p class="section-title px-5">
          <span class="px-2">Our Gallery</span>
        </p>
        <h1 class="mb-4">Shikshastra Education Gallery</h1>
      </div>
     
      <div class="row portfolio-container">
        <?php
          $galleries = DB::table("galleries")->orderBy("id", "desc")->get();
        ?>
        @foreach ($galleries as $gallery)
        <div class="col-lg-4 col-md-6 mb-4 portfolio-item">
          <div class="position-relative overflow-hidden mb-2">
            <img class="img-fluid" src="{{ asset($gallery->image) }}" alt="Gallery Image" />
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
  <!-- Gallery End -->

  <x-footer />
</body>
</html>
