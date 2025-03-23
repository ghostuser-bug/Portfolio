<?php
$conn = new mysqli("localhost", "root", "", "gadget_store");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$category = isset($_GET['cat']) ? $conn->real_escape_string($_GET['cat']) : '';

$sql = "SELECT * FROM products WHERE category_id = '$category'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ucfirst($category); ?> - Gadget Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include('header.php'); ?>

<section class="category-products py-5">
    <div class="container">
        <h1 class="fw-bold text-center mb-4"><?php echo ucfirst($category); ?> Products</h1>
        <div class="row g-4">
            <?php if ($result->num_rows > 0) { 
                while ($product = $result->fetch_assoc()) { ?>
                    <div class="col-md-4">
                        <div class="card h-100 shadow">
                            <img src="<?php echo $product['image_url']; ?>" class="card-img-top" alt="<?php echo $product['name']; ?>">
                            <div class="card-body text-center">
                                <h5 class="card-title"><?php echo $product['name']; ?></h5>
                                <p class="text-danger fw-bold">$<?php echo $product['discounted_price']; ?> 
                                    <del class="text-muted">$<?php echo $product['original_price']; ?></del>
                                </p>
                                <a href="product.php?id=<?php echo $product['id']; ?>" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>
            <?php } 
            } else { ?>
                <p class="text-center">No products found in this category.</p>
            <?php } ?>
        </div>
    </div>
</section>

<?php include('footer.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
