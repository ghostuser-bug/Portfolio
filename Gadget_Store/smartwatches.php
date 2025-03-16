<?php
include('db_connection.php'); // Ensure this file initializes a mysqli connection

try {
    // Fetch smartwatches from the database
    $query = "SELECT * FROM products WHERE category_id = (SELECT id FROM categories WHERE name = 'Smartwatches')";
    $result = $conn->query($query);

    if (!$result) {
        throw new Exception("Database Query Failed: " . $conn->error);
    }

    $smartwatches = [];
    while ($row = $result->fetch_assoc()) {
        $smartwatches[] = $row;
    }
} catch (Exception $e) {
    die("Error fetching smartwatches: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smartwatches - Gadget Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include('header.php'); ?>

<section class="container my-5">
    <h1 class="text-center mb-4">Smartwatches</h1>
    <div class="row g-4">
        <?php foreach ($smartwatches as $watch): ?>
            <div class="col-md-4">
                <div class="card shadow">
                    <img src="<?= htmlspecialchars($watch['image_url']) ?>" class="card-img-top" alt="<?= htmlspecialchars($watch['name']) ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($watch['name']) ?></h5>
                        <p class="text-danger fw-bold">$<?= htmlspecialchars($watch['discounted_price']) ?> 
                            <del class="text-muted">$<?= htmlspecialchars($watch['original_price']) ?></del>
                        </p>
                        <p><?= htmlspecialchars($watch['description']) ?></p>
                        <a href="product.php?id=<?= $watch['id'] ?>" class="btn btn-primary w-100">Shop Now</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php include('footer.php'); ?>
</body>
</html>
