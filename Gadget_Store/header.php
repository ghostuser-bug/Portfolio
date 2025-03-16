<header class="bg-dark text-white py-3">
  <div class="container d-flex align-items-center justify-content-between">
    <!-- Logo -->
    <h1 class="fs-3 fw-bold mb-0">Gadget Store</h1>

    <!-- Search Bar -->
    <div class="input-group w-50 d-none d-md-flex">
      <form action="search_results.php" method="GET" class="d-flex w-100">
        <input type="text" name="query" class="form-control" placeholder="Search for gadgets..." required>
        <button type="submit" class="btn btn-success">Search</button>
      </form>
    </div>

    <!-- User Actions -->
    <div class="d-flex align-items-center gap-3">
      <a href="signup_login.php" class="btn btn-outline-light">Login</a>
      <a href="cart.php" class="btn btn-outline-light">Cart</a>
      <a href="order_history.php" class="btn btn-outline-light">Order History</a>
    </div>
  </div>

  <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-secondary mt-2">
    <div class="container">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="store.php">Store</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="categoriesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Categories</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="phones.php">Phones</a></li>
              <li><a class="dropdown-item" href="laptops.php">Laptops</a></li>
              <li><a class="dropdown-item" href="smartwatches.php">Smartwatches</a></li>
            </ul>
          </li>
          <li class="nav-item"><a class="nav-link highlight-text" href="deals.php">Deals & Offers</a></li>
          <li class="nav-item"><a class="nav-link highlight-text" href="new-arrivals.php">New Arrivals!!</a></li>
          <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="supportDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Support</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="about.php">About Us</a></li>
              <li><a class="dropdown-item" href="return_exchange.php">Return and Exchange</a></li>
              <li><a class="dropdown-item" href="warranty_information.php">Warranty Information</a></li>
              <li><a class="dropdown-item" href="spare_part.php">Spare Part Price</a></li>
              <li><a class="dropdown-item" href="locate_us.php">Locate Us</a></li>
              <li><a class="dropdown-item" href="order_tracking.php">Order Tracking</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>

<!-- Highlight Styles -->
<style>
  .navbar .nav-link {
    transition: color 0.3s ease;
  }

  .navbar .nav-link.highlight-text {
    color: rgb(24, 151, 235); /* Blue color */
    font-weight: bold;
  }

  .navbar .nav-link.highlight-text:hover {
    color: rgb(21, 68, 223); /* Darker blue on hover */
  }
</style>
