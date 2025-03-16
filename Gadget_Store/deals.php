<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deals & Offers - Gadget Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include('header.php'); ?>

<!-- Hero Section -->
<section class="deals-hero bg-dark text-white text-center py-5">
    <div class="container">
        <h1 class="display-4 fw-bold">Exclusive Deals & Offers</h1>
        <p class="lead">Don't miss out on our latest discounts and promotions!</p>
    </div>
</section>

<!-- Featured Deals Section -->
<section class="featured-deals py-5">
    <div class="container">
        <h2 class="text-center mb-5 fw-bold">Featured Deals</h2>
        <div class="row g-4">
            <!-- Card 1 -->
            <div class="col-md-4">
                <div class="card h-100 shadow">
                    <img src="16.jpg" class="card-img-top" alt="Deal 1">
                    <div class="card-body">
                        <h5 class="card-title">iPHONE 16</h5>
                        <p class="text-danger fw-bold">$599 <del class="text-muted">$799</del></p>
                        <p class="text-muted">Save $200 on the latest smartphone. Offer ends soon!</p>
                        <a href="product.php?id=1" class="btn btn-primary w-100">Shop Now</a>
                    </div>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="col-md-4">
                <div class="card h-100 shadow">
                    <img src="victus.jpg" class="card-img-top" alt="Deal 2">
                    <div class="card-body">
                        <h5 class="card-title">HP Victus 15.6 inch Gaming Laptop</h5>
                        <p class="text-danger fw-bold">$1,199 <del class="text-muted">$1,499</del></p>
                        <p class="text-muted">Get a high-performance gaming laptop at a discount!</p>
                        <a href="product.php?id=2" class="btn btn-primary w-100">Shop Now</a>
                    </div>
                </div>
            </div>
         <!-- Card 3 -->
         <div class="col-md-4">
                <div class="card h-100 shadow deal-card">
                    <img src="https://www.valdus.com/wp-content/uploads/2023/05/2023052407360759d3a5430a1d9cc8.jpg" class="card-img-top" alt="Deal 3">
                    <div class="card-body text-center">
                        <h5 class="card-title">Smartwatch Pro</h5>
                        <p class="text-danger fw-bold">$199 <del class="text-muted">$299</del></p>
                        <p class="text-muted">Smartwatch offer !!!</p>
                        <a href="product.php?id=3" class="btn btn-primary w-100">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Countdown Deals Section -->
<section class="countdown-deals bg-light py-5">
    <div class="container text-center">
        <h2 class="fw-bold">Limited-Time Offers</h2>
        <p class="text-muted">Hurry, these deals won’t last long!</p>
        <div class="row g-4 mt-4" id="countdown-deals-container">
            <!-- Countdown items will be added dynamically -->
        </div>
    </div>
</section>

<!-- Popular Categories Section -->
<section class="popular-categories py-5">
    <div class="container">
        <h2 class="text-center fw-bold mb-4">Popular Categories</h2>
        <div class="row g-5 justify-content-center">
            <!-- Phones Category -->
            <div class="col-md-2">
                <div class="card shadow text-center">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRFpBBcIrE38H-onCbI_BNKTvr2AobWGTFmUA&s" class="card-img-top img-fluid" alt="Phones">
                    <div class="card-body">
                        <h5 class="card-title">Phones</h5>
                        <a href="category.php?cat=phones" class="btn btn-outline-primary">Explore</a>
                    </div>
                </div>
            </div>
            <!-- Laptops Category -->
            <div class="col-md-3">
                <div class="card shadow text-center">
                    <img src="https://assets.dryicons.com/uploads/icon/svg/5098/0bf401dc-c8bf-4505-afab-08b0a2685829.svg" class="card-img-top img-fluid" alt="Laptops">
                    <div class="card-body">
                        <h5 class="card-title">Laptops</h5>
                        <a href="category.php?cat=laptops" class="btn btn-outline-primary">Explore</a>
                    </div>
                </div>
            </div>
            <!-- Smartwatches Category -->
            <div class="col-md-2">
                <div class="card shadow text-center">
                    <img src="https://assets.dryicons.com/uploads/icon/svg/5133/7612facf-d461-4ed1-beee-02e33d59ebc5.svg" class="card-img-top img-fluid" alt="Smartwatches">
                    <div class="card-body">
                        <h5 class="card-title">Smartwatches</h5>
                        <a href="category.php?cat=smartwatches" class="btn btn-outline-primary">Explore</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php include('footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Countdown data (add your image URLs and product details here)
    const countdownItems = [
        {
            title: "iPHONE 15 Pro",
            price: "$499",
            oldPrice: "$699",
            imageUrl: "https://hips.hearstapps.com/hmg-prod/images/index2-660d8cf65cd7f.jpg?crop=0.5xw:1xh;center,top&resize=640:*",
            productLink: "product.php?id=8",
            deadline: new Date().getTime() + 86400000 // 24 hours from now
        },
        {
            title: "Smartwatch Pro",
            price: "$199",
            oldPrice: "$299",
            imageUrl: "https://www.valdus.com/wp-content/uploads/2023/05/2023052407360759d3a5430a1d9cc8.jpg",
            productLink: "product.php?id=9",
            deadline: new Date().getTime() + 172800000 // 48 hours from now
        }
    ];

    // Function to create countdown items dynamically
    function renderCountdownItems(items) {
        const container = document.getElementById('countdown-deals-container');
        container.innerHTML = ''; // Clear existing items

        items.forEach((item, index) => {
            const card = document.createElement('div');
            card.className = 'col-md-6';
            card.innerHTML = `
                <div class="card h-100 shadow-sm">
                    <img src="${item.imageUrl}" class="card-img-top" alt="${item.title}">
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold">${item.title}</h5>
                        <p class="text-danger fw-bold">${item.price} <del class="text-muted">${item.oldPrice}</del></p>
                        <div id="countdown${index}" class="text-primary fw-bold fs-4"></div>
                        <a href="${item.productLink}" class="btn btn-success w-100 mt-3">Shop Now</a>
                    </div>
                </div>
            `;
            container.appendChild(card);

            // Start countdown for each item
            startCountdown(`countdown${index}`, item.deadline);
        });
    }

    // Function to start countdown
    function startCountdown(elementId, deadline) {
        const countdownElement = document.getElementById(elementId);
        function updateCountdown() {
            const now = new Date().getTime();
            const timeLeft = deadline - now;

            if (timeLeft <= 0) {
                countdownElement.innerHTML = "Deal Ended!";
                return;
            }

            const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
            const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

            countdownElement.innerHTML = `${days}d ${hours}h ${minutes}m ${seconds}s`;
        }
        updateCountdown();
        setInterval(updateCountdown, 1000);
    }

    // Render countdown items on page load
    renderCountdownItems(countdownItems);
</script>
</body>
</html>
