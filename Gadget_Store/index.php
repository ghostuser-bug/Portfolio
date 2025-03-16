<?php
session_start();
$userName = isset($_SESSION['username']) ? $_SESSION['username'] : 'User';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gadget Store</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <style>
    /* Hero Section Enhancements */
    #hero {
      position: relative;
      height: 60vh; /* Adjust this to make the carousel smaller */
      background-image: url('images/deal.jpg');
      background-size: cover;
      background-position: center;
    }
    #hero .carousel-caption {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      color: white;
      text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.7);
    }
    #hero h2 {
      font-size: 2.5rem; /* Adjust heading size */
      font-weight: bold;
    }
    #hero p {
      font-size: 1rem; /* Adjust text size */
    }

    .carousel-inner {
      max-height: 400px; /* Adjust max-height for smaller carousel items */
    }
    .carousel-item {
      height: 400px; /* Set fixed height for carousel items */
      overflow: hidden;
    }

    .carousel-inner img {
      width: 100%;
      height: 100%;
      object-fit: cover; /* Ensures the image covers the area without distortion */
    }

    /* Category Cards */
    .card {
      border: none;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s, box-shadow 0.3s;
    }
    .card:hover {
      transform: translateY(-10px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }
    .card-img-top {
      border-radius: 10px 10px 0 0;
    }

    /* Button Style */
    .btn-primary {
      background-color: #007bff;
      border: none;
      border-radius: 50px;
      padding: 10px 30px;
      font-size: 1.1rem;
    }
    .btn-outline-primary {
      border: 2px solid #007bff;
      border-radius: 50px;
      padding: 10px 30px;
      font-size: 1.1rem;
      color: #007bff;
    }
    .btn-outline-primary:hover {
      background-color: #007bff;
      color: white;
    }

    /* Spacing & Typography */
    h2, h5 {
      font-weight: 600;
    }
    .carousel-item {
      min-height: 70vh;
    }
    .carousel-inner img {
      object-fit: cover;
    }

    /* Footer */
    footer {
      background-color: #f8f9fa;
      padding: 20px 0;
      text-align: center;
    }

    /* User Greeting */
    #userGreeting {
      font-size: 1.2rem;
      color: #007bff;
      font-weight: bold;
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <?php include 'header.php'; ?>

  <!-- User Greeting -->
  <div id="userGreeting" class="text-center">
    <p>Hello, <?php echo $userName; ?>! Welcome back to our Gadget Store!</p>
  </div>

  <!-- Hero Section -->
  <section id="hero" class="text-center bg-dark py-5">
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="https://static.vecteezy.com/system/resources/previews/002/478/302/non_2x/sale-electronics-banner-background-free-vector.jpg" class="d-block w-100" alt="Deal">
          <div class="carousel-caption">
            <h2>Biggest Deals of the Year!</h2>
            <p>Shop now and save up to 50% on select gadgets.</p>
            <a href="deals.php" class="btn btn-primary">Shop Now</a>
          </div>
        </div>
        <div class="carousel-item">
          <img src="https://m.media-amazon.com/images/G/39/electronic/kamja/Stores/app_0gv_en._SX621_QL85_.jpg" class="d-block w-100" alt="New Arrivals">
          <div class="carousel-caption">
            <h2>Check Out Our New Arrivals!</h2>
            <p>Latest gadgets for tech enthusiasts.</p>
            <a href="new-arrivals.php" class="btn btn-primary">Explore</a>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
      </button>
    </div>
  </section>

  <!-- Categories -->
  <section id="categories" class="py-5 bg-light">
    <div class="container text-center">
      <h2 class="mb-4">Shop by Category</h2>
      <div class="row g-4">
        <div class="col-md-3">
          <div class="card">
            <img src="16.jpg" class="card-img-top" alt="Phones">
            <div class="card-body">
              <h5 class="card-title">Phones</h5>
              <a href="phones.php" class="btn btn-outline-primary">Explore</a>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card">
            <img src="victus.jpg" class="card-img-top" alt="Laptops">
            <div class="card-body">
              <h5 class="card-title">Laptops</h5>
              <a href="laptops.php" class="btn btn-outline-primary">Explore</a>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card">
            <img src="gts.jpg" class="card-img-top" alt="Smartwatches">
            <div class="card-body">
              <h5 class="card-title">Smartwatches</h5>
              <a href="smartwatches.php" class="btn btn-outline-primary">Explore</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php include 'footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="script.js"></script>
</body>
</html>
