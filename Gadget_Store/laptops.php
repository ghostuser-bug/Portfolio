<?php
include('db_connection.php');

try {
    // Fetch laptops from the database
    $query = "SELECT * FROM products WHERE category_id = (SELECT id FROM categories WHERE name = 'Laptops')";
    $result = $conn->query($query);

    // Check if the query was successful
    if (!$result) {
        throw new Exception("Error executing query: " . $conn->error);
    }

    // Fetch all laptops as an associative array
    $laptops = $result->fetch_all(MYSQLI_ASSOC);
} catch (Exception $e) {
    die("Error fetching laptops: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laptops - Gadget Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include('header.php'); ?>

<section class="container my-5">
    <h1 class="text-center mb-4">Laptops</h1>
    <div class="row g-4">
        <?php foreach ($laptops as $laptop): ?>
            <div class="col-md-4">
                <div class="card shadow">
                    <img src="<?= htmlspecialchars($laptop['image_url']) ?>" class="card-img-top" alt="<?= htmlspecialchars($laptop['name']) ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($laptop['name']) ?></h5>
                        <p class="text-danger fw-bold">$<?= htmlspecialchars($laptop['discounted_price']) ?> 
                            <del class="text-muted">$<?= htmlspecialchars($laptop['original_price']) ?></del>
                        </p>
                        <p><?= htmlspecialchars($laptop['description']) ?></p>
                        <a href="product.php?id=<?= $laptop['id'] ?>" class="btn btn-primary w-100">Shop Now</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php include('footer.php'); ?>
</body>
</html>
