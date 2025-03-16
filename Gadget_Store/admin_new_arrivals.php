<?php
session_start();
include('db_connection.php');

// Ensure admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header('Location: admin-login.php');
    exit;
}

// Handle marking product as new arrival
if (isset($_POST['mark_new_arrival'])) {
    $product_id = intval($_POST['product_id']);
    $stmt = $conn->prepare("UPDATE products SET is_new_arrival = 1 WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
}

// Handle unmarking product as new arrival
if (isset($_POST['unmark_new_arrival'])) {
    $product_id = intval($_POST['product_id']);
    $stmt = $conn->prepare("UPDATE products SET is_new_arrival = 0 WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
}

// Handle adding a new product
if (isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $original_price = $_POST['original_price'];
    $discounted_price = $_POST['discounted_price'];
    $image_url = $_POST['image_url'];
    $stmt = $conn->prepare("INSERT INTO products (name, original_price, discounted_price, image_url, is_new_arrival) VALUES (?, ?, ?, ?, 1)");
    $stmt->bind_param("sdds", $name, $original_price, $discounted_price, $image_url);
    $stmt->execute();
}

// Fetch all products
$result = $conn->query("SELECT * FROM products ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage New Arrivals</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include('admin-navbar.php'); ?>

<div class="container mt-4">
    <h1>Manage New Arrivals</h1>

    <!-- Add New Product -->
    <h2>Add New Product</h2>
    <form method="POST" action="admin_new_arrivals.php" class="mb-4">
        <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="original_price" class="form-label">Original Price</label>
            <input type="number" step="0.01" name="original_price" id="original_price" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="discounted_price" class="form-label">Discounted Price</label>
            <input type="number" step="0.01" name="discounted_price" id="discounted_price" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="image_url" class="form-label">Image URL</label>
            <input type="text" name="image_url" id="image_url" class="form-control" required>
        </div>
        <button type="submit" name="add_product" class="btn btn-primary">Add Product</button>
    </form>

    <!-- Product List -->
    <h2>Product List</h2>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Product ID</th>
                <th>Name</th>
                <th>Original Price</th>
                <th>Discounted Price</th>
                <th>Is New Arrival</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td>$<?php echo htmlspecialchars($row['original_price']); ?></td>
                    <td>$<?php echo htmlspecialchars($row['discounted_price']); ?></td>
                    <td><?php echo $row['is_new_arrival'] ? 'Yes' : 'No'; ?></td>
                    <td>
                        <?php if (!$row['is_new_arrival']): ?>
                            <form method="POST" action="admin_new_arrivals.php" class="d-inline">
                                <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" name="mark_new_arrival" class="btn btn-success btn-sm">Mark as New Arrival</button>
                            </form>
                        <?php else: ?>
                            <form method="POST" action="admin_new_arrivals.php" class="d-inline">
                                <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" name="unmark_new_arrival" class="btn btn-warning btn-sm">Unmark New Arrival</button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
