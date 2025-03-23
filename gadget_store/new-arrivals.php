<?php
$conn = new mysqli("localhost", "root", "", "gadget_store");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$products_per_page = 12;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $products_per_page;

$sql = "SELECT * FROM products WHERE is_new_arrival = 1 ORDER BY id DESC LIMIT $offset, $products_per_page";
$result = $conn->query($sql); 

if (!$result) {
    die("Error in SQL query: " . $conn->error);
}

$total_sql = "SELECT COUNT(*) as total FROM products WHERE is_new_arrival = 1";
$total_result = $conn->query($total_sql);
$total_row = $total_result->fetch_assoc();
$total_products = $total_row['total'];
$total_pages = ceil($total_products / $products_per_page);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Arrivals - Gadget Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include('header.php'); ?>

<section class="hero-section bg-dark text-white text-center py-5">
    <div class="container">
        <h1 class="display-4 fw-bold">New Arrivals</h1>
        <p class="lead">Explore our latest gadgets and devices!</p>
    </div>
</section>

<section class="new-arrivals py-5">
    <div class="container">
        <div class="row g-4">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($product = $result->fetch_assoc()): ?>
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm">
                            <img src="<?php echo htmlspecialchars($product['image_url']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['name']); ?>">
                            <div class="card-body text-center">
                                <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                                <p class="text-danger fw-bold">$<?php echo htmlspecialchars($product['discounted_price']); ?> <del class="text-muted">$<?php echo htmlspecialchars($product['original_price']); ?></del></p>
                                <a href="product.php?id=<?php echo $product['id']; ?>" class="btn btn-primary w-100">View Details</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="text-center">No new arrivals found.</p>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <nav aria-label="Page navigation" class="mt-4">
            <ul class="pagination justify-content-center">
                <?php if ($page > 1): ?>
                    <li class="page-item"><a class="page-link" href="new-arrivals.php?page=<?php echo $page - 1; ?>">Previous</a></li>
                <?php endif; ?>
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                        <a class="page-link" href="new-arrivals.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
                <?php if ($page < $total_pages): ?>
                    <li class="page-item"><a class="page-link" href="new-arrivals.php?page=<?php echo $page + 1; ?>">Next</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</section>

<section class="popular-categories py-5">
    <div class="container">
        <h2 class="text-center fw-bold mb-4">Popular Categories</h2>
        <div class="row g-5 justify-content-center">
            <div class="col-md-2">
                <div class="card shadow text-center">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRFpBBcIrE38H-onCbI_BNKTvr2AobWGTFmUA&s" class="card-img-top img-fluid" alt="Phones">
                    <div class="card-body">
                        <h5 class="card-title">Phones</h5>
                        <a href="category.php?cat=phones" class="btn btn-outline-primary">Explore</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow text-center">
                    <img src="https://assets.dryicons.com/uploads/icon/svg/5098/0bf401dc-c8bf-4505-afab-08b0a2685829.svg" class="card-img-top img-fluid" alt="Laptops">
                    <div class="card-body">
                        <h5 class="card-title">Laptops</h5>
                        <a href="category.php?cat=laptops" class="btn btn-outline-primary">Explore</a>
                    </div>
                </div>
            </div>
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
</body>
</html>

