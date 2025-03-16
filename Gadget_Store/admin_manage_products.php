<?php
session_start();
include('db_connection.php');

// Ensure admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header('Location: admin-login.php');
    exit;
}

// Add Product
if (isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $category_id = $_POST['category_id'];
    $image_url = $_POST['image_url'];
    $original_price = $_POST['original_price'];
    $discounted_price = $_POST['discounted_price'];

    $stmt = $conn->prepare("INSERT INTO products (name, description, category_id, image_url, original_price, discounted_price) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssissd", $name, $description, $category_id, $image_url, $original_price, $discounted_price);

    if ($stmt->execute()) {
        echo "Product added successfully!";
    } else {
        echo "Error adding product: " . $conn->error;
    }
}

// Edit Product
if (isset($_POST['edit_product'])) {
    $id = $_POST['product_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $category_id = $_POST['category_id'];
    $image_url = $_POST['image_url'];
    $original_price = $_POST['original_price'];
    $discounted_price = $_POST['discounted_price'];

    $stmt = $conn->prepare("UPDATE products SET name = ?, description = ?, category_id = ?, image_url = ?, original_price = ?, discounted_price = ? WHERE id = ?");
    $stmt->bind_param("ssissdi", $name, $description, $category_id, $image_url, $original_price, $discounted_price, $id);

    if ($stmt->execute()) {
        echo "Product updated successfully!";
    } else {
        echo "Error updating product: " . $conn->error;
    }
}

// Delete Product
if (isset($_POST['delete_product'])) {
    $id = $_POST['product_id'];

    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Product deleted successfully!";
    } else {
        echo "Error deleting product: " . $conn->error;
    }
}

// Fetch Products and Categories
$products = $conn->query("SELECT p.*, c.name AS category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id ORDER BY p.id DESC");
$categories = $conn->query("SELECT * FROM categories ORDER BY id ASC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Manage Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include('admin-navbar.php'); ?>
    <div class="container mt-4">
        <h1>Manage Products</h1>

        <!-- Add Product Form -->
        <h2>Add Product</h2>
        <form method="POST" action="admin_manage_products.php" class="mb-4">
            <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" class="form-select" required>
                    <?php while ($category = $categories->fetch_assoc()): ?>
                        <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="image_url" class="form-label">Image URL</label>
                <input type="url" name="image_url" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="original_price" class="form-label">Original Price</label>
                <input type="number" name="original_price" class="form-control" step="0.01" required>
            </div>
            <div class="mb-3">
                <label for="discounted_price" class="form-label">Discounted Price</label>
                <input type="number" name="discounted_price" class="form-control" step="0.01" required>
            </div>
            <button type="submit" name="add_product" class="btn btn-primary">Add Product</button>
        </form>

        <!-- Edit Product Form (when editing) -->
        <?php if (isset($_GET['edit'])): ?>
            <?php
                $product_id = $_GET['edit'];
                $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
                $stmt->bind_param("i", $product_id);
                $stmt->execute();
                $product_result = $stmt->get_result();
                $product = $product_result->fetch_assoc();
            ?>
            <h2>Edit Product</h2>
            <form method="POST" action="admin_manage_products.php" class="mb-4">
                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                <div class="mb-3">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" name="name" class="form-control" value="<?php echo $product['name']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3" required><?php echo $product['description']; ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select name="category_id" class="form-select" required>
                        <?php while ($category = $categories->fetch_assoc()): ?>
                            <option value="<?php echo $category['id']; ?>" <?php if ($category['id'] == $product['category_id']) echo 'selected'; ?>>
                                <?php echo $category['name']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="image_url" class="form-label">Image URL</label>
                    <input type="url" name="image_url" class="form-control" value="<?php echo $product['image_url']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="original_price" class="form-label">Original Price</label>
                    <input type="number" name="original_price" class="form-control" step="0.01" value="<?php echo $product['original_price']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="discounted_price" class="form-label">Discounted Price</label>
                    <input type="number" name="discounted_price" class="form-control" step="0.01" value="<?php echo $product['discounted_price']; ?>" required>
                </div>
                <button type="submit" name="edit_product" class="btn btn-warning">Update Product</button>
            </form>
        <?php endif; ?>

        <!-- Products Table -->
        <h2>Products</h2>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Original Price</th>
                    <th>Discounted Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($product = $products->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $product['id']; ?></td>
                        <td><?php echo $product['name']; ?></td>
                        <td><?php echo $product['description']; ?></td>
                        <td><?php echo $product['category_name']; ?></td>
                        <td><img src="<?php echo $product['image_url']; ?>" alt="Product Image" width="50"></td>
                        <td><?php echo '$' . number_format($product['original_price'], 2); ?></td>
                        <td><?php echo '$' . number_format($product['discounted_price'], 2); ?></td>
                        <td>
                            <a href="admin_manage_products.php?edit=<?php echo $product['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <form method="POST" action="admin_manage_products.php" class="d-inline">
                                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                <button type="submit" name="delete_product" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
