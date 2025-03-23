<?php
$conn = new mysqli("localhost", "root", "", "gadget_store");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$search = '';
$sort_by = '';
$category_filter = '';

if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = $_GET['search'];
}

if (isset($_GET['category']) && !empty($_GET['category'])) {
    $category_filter = $_GET['category'];
}

if (isset($_GET['sort']) && !empty($_GET['sort'])) {
    $sort_by = $_GET['sort'];
}

$sql = "SELECT p.id, p.name, p.description, p.price, p.image_url, p.discounted_price, c.name AS category 
        FROM products p 
        JOIN categories c ON p.category_id = c.id 
        WHERE 1=1";

if ($search) {
    $sql .= " AND (p.name LIKE '%$search%' OR p.description LIKE '%$search%')";
}

if ($category_filter) {
    $sql .= " AND c.name = '$category_filter'";
}

if ($sort_by) {
    switch ($sort_by) {
        case 'price-low':
            $sql .= " ORDER BY p.discounted_price ASC";
            break;
        case 'price-high':
            $sql .= " ORDER BY p.discounted_price DESC";
            break;
        case 'rating':
            $sql .= " ORDER BY p.rating DESC";  // Assuming there is a rating field in the product table
            break;
        case 'latest':
            $sql .= " ORDER BY p.created_at DESC";  // Assuming there is a created_at field in the product table
            break;
        default:
            $sql .= " ORDER BY p.name"; // Default sorting by name
    }
} else {
    $sql .= " ORDER BY p.name";  // Default sorting by name
}

$result = $conn->query($sql);

$products = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store - Gadget Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include('header.php'); ?>

<section class="store-hero bg-dark text-white text-center py-5">
    <div class="container">
        <h1 class="display-4 fw-bold">Welcome to Our Store</h1>
        <p class="lead">Explore our wide range of gadgets and find your perfect match.</p>
    </div>
</section>

<section class="filters bg-light py-4">
    <div class="container">
        <form class="row gy-2 align-items-center" method="GET">
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search for products..." value="<?php echo htmlspecialchars($search); ?>">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </div>
            
            <div class="col-md-3">
                <select name="sort" class="form-select" onchange="this.form.submit()">
                    <option value="">Sort by</option>
                    <option value="price-low" <?php echo ($sort_by == 'price-low') ? 'selected' : ''; ?>>Price: Low to High</option>
                    <option value="price-high" <?php echo ($sort_by == 'price-high') ? 'selected' : ''; ?>>Price: High to Low</option>
                    <option value="rating" <?php echo ($sort_by == 'rating') ? 'selected' : ''; ?>>Highest Rating</option>
                    <option value="latest" <?php echo ($sort_by == 'latest') ? 'selected' : ''; ?>>Latest Arrivals</option>
                </select>
            </div>

            <div class="col-md-3">
                <select name="category" class="form-select" onchange="this.form.submit()">
                    <option value="">Categories</option>
                    <option value="Phones" <?php echo ($category_filter == 'Phones') ? 'selected' : ''; ?>>Phones</option>
                    <option value="Laptops" <?php echo ($category_filter == 'Laptops') ? 'selected' : ''; ?>>Laptops</option>
                    <option value="Smartwatches" <?php echo ($category_filter == 'Smartwatches') ? 'selected' : ''; ?>>Smartwatches</option>
                </select>
            </div>
        </form>
    </div>
</section>

<section class="products py-5">
    <div class="container">
        <h2 class="text-center mb-4">Our Products</h2>
        <div class="row g-4">
            <?php foreach ($products as $product): ?>
                <div class='col-md-3'>
                    <div class='card h-100'>
                        <img src='<?php echo $product['image_url']; ?>' class='card-img-top' alt='<?php echo $product['name']; ?>'>
                        <div class='card-body'>
                            <h5 class='card-title'><?php echo $product['name']; ?></h5>
                            <p class='text-muted'><?php echo $product['category']; ?></p>
                            <p class='fw-bold text-primary'>$<?php echo number_format($product['discounted_price'], 2); ?></p>
                            <div class='d-flex gap-2'>
                                <a href='product.php?id=<?php echo $product['id']; ?>' class='btn btn-outline-success'>View Details</a>
                                <a href='product.php?id=<?php echo $product['id']; ?>' class='btn btn-outline-primary'>Add to Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<?php include('footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
