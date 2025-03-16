<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spare Part List - Gadget Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Include Header -->
    <?php include('header.php'); ?>

    <!-- Hero Section -->
    <header class="bg-dark text-white text-center py-3">
        <h1>Spare Parts List</h1>
        <p>Affordable prices for all your gadget repair needs.</p>
    </header>

    <!-- Spare Parts Section -->
    <section class="products py-5">
        <div class="container">
            <h2 class="text-center mb-4">Spare Parts and Prices</h2>
            <div class="row g-4">
                <!-- Screen -->
                <div class="col-md-3">
                    <div class="card h-100">
                        <img src="https://sc01.alicdn.com/kf/H791eb58e441f46ed9a2f34393b11eb49o.jpg" class="card-img-top" alt="Screen">
                        <div class="card-body">
                            <h5 class="card-title">Screen</h5>
                            <p class="card-text">High-quality replacement screens for various devices.</p>
                            <p class="fw-bold">Price: RM 150</p>
                        </div>
                    </div>
                </div>
                
                <!-- Battery -->
                <div class="col-md-3">
                    <div class="card h-100">
                        <img src="https://scvglobal.com.my/cdn/shop/files/tyler-lastovich-rAtzDB6hWrU-unsplash.jpg?v=1710494223&width=1920" class="card-img-top" alt="Battery">
                        <div class="card-body">
                            <h5 class="card-title">Battery</h5>
                            <p class="card-text">Long-lasting batteries for phones and tablets.</p>
                            <p class="fw-bold">Price: RM 100</p>
                        </div>
                    </div>
                </div>
                
                <!-- Back Glass -->
                <div class="col-md-3">
                    <div class="card h-100">
                        <img src="https://www.braderparts.com//laravel/uploads/5-418.jpg" class="card-img-top" alt="Back Glass">
                        <div class="card-body">
                            <h5 class="card-title">Back Glass</h5>
                            <p class="card-text">Durable body parts to restore your gadget's appearance.</p>
                            <p class="fw-bold">Price: RM 200</p>
                        </div>
                    </div>
                </div>
                
                <!-- Back Camera -->
                <div class="col-md-3">
                    <div class="card h-100">
                        <img src="https://down-my.img.susercontent.com/file/c38f921fb413f49285f8f52c01ca3025" class="card-img-top" alt="Back Camera">
                        <div class="card-body">
                            <h5 class="card-title">Back Camera</h5>
                            <p class="card-text">High-resolution cameras for phones and tablets.</p>
                            <p class="fw-bold">Price: RM 250</p>
                        </div>
                    </div>
                </div>

                <!-- Front Camera -->
                <div class="col-md-3">
                    <div class="card h-100">
                        <img src="https://down-my.img.susercontent.com/file/36a6db22a76300855903451217138f07" class="card-img-top" alt="Front Camera">
                        <div class="card-body">
                            <h5 class="card-title">Front Camera</h5>
                            <p class="card-text">High-quality front camera for phones and similar models.</p>
                            <p class="fw-bold">Price: RM 180</p>
                        </div>
                    </div>
                </div>

                <!-- Charging Port -->
                <div class="col-md-3">
                    <div class="card h-100">
                        <img src="https://www.phonecare.com.my/images/uploads/product/150/PC_iphone-7-charging-port-and-microphone-flex-cable.jpg" class="card-img-top" alt="Charging Port">
                        <div class="card-body">
                            <h5 class="card-title">Charging Port</h5>
                            <p class="card-text">Replacement charging ports for phones and similar models.</p>
                            <p class="fw-bold">Price: RM 120</p>
                        </div>
                    </div>
                </div>
                
                <!-- Motherboard -->
                <div class="col-md-3">
                    <div class="card h-100">
                        <img src="https://www.iproampang.com.my/wp-content/uploads/2019/03/meson-cumulus-1024x683.jpg.webp" class="card-img-top" alt="Motherboard">
                        <div class="card-body">
                            <h5 class="card-title">Motherboard</h5>
                            <p class="card-text">Reliable motherboards to ensure optimal device performance.</p>
                            <p class="fw-bold">Price: RM 400</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; 2025 Gadget Store. All rights reserved.</p>
    </footer>

    <!-- Bootstrap Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
