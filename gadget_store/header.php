<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$conn = new mysqli("localhost", "root", "", "gadget_store");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$session_id = session_id();
$cart_count = 0;

$sql = "SELECT SUM(quantity) AS total_items FROM cart WHERE session_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $session_id);
$stmt->execute();
$result = $stmt->get_result();
if ($row = $result->fetch_assoc()) {
    $cart_count = $row['total_items'] ?? 0;
}
$stmt->close();
?>

<header class="bg-dark text-white py-3">
  <div class="container">
    <div class="d-flex align-items-center justify-content-between">
      <h1 class="fs-3 fw-bold mb-0">Gadget Store</h1>

      <div class="input-group" style="width: auto !important;">
        <form action="search_results.php" method="GET" class="d-flex align-items-center">
          <input type="text" name="query" placeholder="Search for gadgets..." required 
            style="width: 600px; height: 35px; border: none; background-color: rgba(255, 255, 255, 0.1); color: white; padding-left: 10px; border-radius: 20px; outline: none;">
          <button type="submit" style="border: none; background: none; padding: 5px 10px; display: flex; align-items: center;">
            <i class="bi bi-search" style="color: white; font-size: 18px;"></i>
          </button>
        </form>
      </div>

      <div class="d-flex align-items-center gap-3">
        <a href="login.php" class="btn btn-outline-light">Login</a>
        <a href="signup.php" class="btn btn-outline-light">Register</a>
        <a href="order_history.php" class="btn btn-outline-light">Order History</a>
        <a href="cart.php" class="text-white position-relative ms-2">
    <i class="bi bi-cart3 fs-4"></i>
    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
        <?php echo $cart_count; ?>
    </span>
</a>

      </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary mt-2">
      <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav mx-auto">
            <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="store.php">Store</a></li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="categoriesDropdown" data-bs-toggle="dropdown">Categories</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="phones.php">Phones</a></li>
                <li><a class="dropdown-item" href="laptops.php">Laptops</a></li>
                <li><a class="dropdown-item" href="smartwatches.php">Smartwatches</a></li>
              </ul>
            </li>
            <li class="nav-item"><a class="nav-link" href="deals.php" style="color: rgb(24, 151, 235); font-weight: bold;">Deals & Offers</a></li>
            <li class="nav-item"><a class="nav-link" href="new-arrivals.php" style="color: rgb(24, 151, 235); font-weight: bold;">New Arrivals!!</a></li>
            <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="supportDropdown" data-bs-toggle="dropdown">Support</a>
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
  </div>
</header>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
