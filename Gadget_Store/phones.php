<?php
include('db_connection.php');

try {
    // Fetch phones from the database
    $stmt = $conn->prepare("SELECT * FROM products WHERE category_id = (SELECT id FROM categories WHERE name = 'Phones')");
    $stmt->execute();
    $result = $stmt->get_result();
    $phones = $result->fetch_all(MYSQLI_ASSOC);
} catch (Exception $e) {
    die("Error fetching phones: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phones - Gadget Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include('header.php'); ?>

<section class="container my-5">
    <h1 class="text-center mb-4">Phones</h1>
    <div class="row g-4">
        <?php foreach ($phones as $phone): ?>
            <div class="col-md-4">
                <div class="card shadow">
                    <img src="<?= htmlspecialchars($phone['image_url']) ?>" class="card-img-top" alt="<?= htmlspecialchars($phone['name']) ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($phone['name']) ?></h5>
                        <p class="text-danger fw-bold">$<?= htmlspecialchars($phone['discounted_price']) ?> 
                            <del class="text-muted">$<?= htmlspecialchars($phone['original_price']) ?></del>
                        </p>
                        <p><?= htmlspecialchars($phone['description']) ?></p>
                        <a href="product.php?id=<?= $phone['id'] ?>" class="btn btn-primary w-100">Shop Now</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php include('footer.php'); ?>
</body>
</html>
