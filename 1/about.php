<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Gadget Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        /* Custom Styles */
        .about-hero {
            background: linear-gradient(135deg, rgba(0,0,0,0.7), rgba(0,0,0,0.5)), url(https://media.nedigital.sg/fairprice/images/d73e902e-c047-4bf2-84cc-c21da7d21326/MP-GadgetsLand-LandingBanner-Feb2021.jpg?q=70) no-repeat center center;
            background-size: cover;
            padding: 60px 0;
        }

        .about-hero h1 {
            font-size: 3.5rem;
            font-weight: 700;
        }

        .about-hero p {
            font-size: 1.2rem;
            font-weight: 300;
            max-width: 800px;
            margin: 0 auto;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 40px;
            position: relative;
        }

        .section-title::after {
            content: '';
            width: 60px;
            height: 3px;
            background-color: #00b894;
            position: absolute;
            bottom: -10px;
            left: 0;
        }

        .feature-card {
            transition: transform 0.3s ease;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .feature-card:hover {
            transform: translateY(-10px);
        }

        .feature-card .card-body {
            text-align: center;
            padding: 30px;
        }

        .feature-card h3 {
            font-size: 1.8rem;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .feature-card p {
            font-size: 1rem;
            color: #555;
        }

        .team-section {
            background-color: #f8f9fa;
            padding: 60px 0;
        }

        .team-member {
            transition: transform 0.3s ease;
        }

        .team-member:hover {
            transform: translateY(-10px);
        }

        .team-member img {
            border-radius: 50%;
            width: 150px;
            height: 150px;
            object-fit: cover;
        }

        .team-member h4 {
            font-size: 1.3rem;
            font-weight: 700;
            margin-top: 20px;
        }

        .team-member p {
            font-size: 1rem;
            color: #777;
        }
    </style>
</head>
<body>

<?php include('header.php'); ?>

<section class="about-hero text-white text-center">
    <div class="container">
        <h1 class="display-4">About Us</h1>
        <p class="lead">We are Gadget Store – Bringing you the latest in technology with quality, affordability, and style.</p>
    </div>
</section>

<section class="who-we-are py-5">
    <div class="container">
        <h2 class="section-title text-center">Who We Are</h2>
        <div class="row align-items-center">
            <div class="col-md-6">
                <p class="lead">At Gadget Store, we believe technology should be accessible to everyone. We are dedicated to curating the best gadgets at the most affordable prices, ensuring that innovation and quality are within your reach. Whether you're shopping for the latest smartphone, laptop, or accessories, we have something for every tech lover.</p>
            </div>
            <div class="col-md-6">
                <img src="https://www.suteramall.com/data/merc/masthead/1645502458_272125344_142327954912473_4121783020854725902_n.jpg" class="img-fluid rounded" alt="About Us Image">
            </div>
        </div>
    </div>
</section>

<section class="our-values py-5">
    <div class="container text-center">
        <h2 class="section-title">Our Core Values</h2>
        <div class="row mt-4">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card feature-card">
                    <div class="card-body">
                        <h3 class="fw-bold text-success">Innovation</h3>
                        <p>We bring the latest technology to your fingertips, ensuring you’re always ahead of the curve.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card feature-card">
                    <div class="card-body">
                        <h3 class="fw-bold text-primary">Customer Focus</h3>
                        <p>We put our customers first by delivering personalized experiences and exceptional service.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card feature-card">
                    <div class="card-body">
                        <h3 class="fw-bold text-danger">Quality</h3>
                        <p>Only the best for our customers. We offer top-notch products that combine durability with performance.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="team-section py-5">
    <div class="container text-center">
        <h2 class="section-title">Meet Our Team</h2>
        <div class="row">
            <div class="col-lg-3 col-md-4 col-6 mb-4 team-member">
                <img src="gambar adam.jpeg" alt="NURUL YASMIN" class="img-fluid rounded-circle">
                <h4 class="mt-3">NUR ADAM</h4>
                <p>CEO & Founder</p>
            </div>
            <div class="col-lg-3 col-md-4 col-6 mb-4 team-member">
                <img src="gambar yasmin.jpeg" alt="NUR ADAM" class="img-fluid rounded-circle">
                <h4 class="mt-3">NURUL YASMIN</h4>
                <p>Head of Marketing</p>
            </div>
            <div class="col-lg-3 col-md-4 col-6 mb-4 team-member">
                <img src="gambar el.jpeg" alt="MAISARAH ELISA" class="img-fluid rounded-circle">
                <h4 class="mt-3">MAISARAH ELISA</h4>
                <p>Product Manager</p>
            </div>
            <div class="col-lg-3 col-md-4 col-6 mb-4 team-member">
                <img src="gambar aiman.jpeg" alt="NYR AIMAN" class="img-fluid rounded-circle">
                <h4 class="mt-3">NUR AIMAN</h4>
                <p>Lead Developer</p>
            </div>
        </div>
    </div>
</section>

<?php include('footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
