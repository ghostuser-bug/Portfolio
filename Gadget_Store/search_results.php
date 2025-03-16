<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "gadget_store");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the search query from the form
$search_query = isset($_GET['query']) ? $conn->real_escape_string($_GET['query']) : '';

// Fetch products that match the search query
$sql = "SELECT * FROM products WHERE name LIKE '%$search_query%' OR description LIKE '%$search_query%' ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results - Gadget Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include('header.php'); ?>

<div class="container my-4">
    <h1 class="mb-4">Search Results for "<?php echo htmlspecialchars($search_query); ?>"</h1>

    <div class="row g-4">
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($product = $result->fetch_assoc()): ?>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <img src="<?php echo $product['image_url']; ?>" class="card-img-top" alt="<?php echo $product['name']; ?>">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?php echo $product['name']; ?></h5>
                            <p class="text-danger fw-bold">$<?php echo $product['discounted_price']; ?> <del class="text-muted">$<?php echo $product['original_price']; ?></del></p>
                            <a href="product.php?id=<?php echo $product['id']; ?>" class="btn btn-primary w-100">View Details</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No products found matching your search query.</p>
        <?php endif; ?>
    </div>
</div>

<?php include('footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
