<?php
session_start();
include('../db_connection.php');

if (!isset($_SESSION['admin_id'])) {
    header('Location: admin-login.php');
    exit;
}

if (isset($_POST['add_deal'])) {
    $title = $_POST['title'];
    $price = $_POST['price'];
    $old_price = $_POST['old_price'];
    $image_url = $_POST['image_url'];
    $product_link = $_POST['product_link'];
    $deadline = $_POST['deadline'];

    $stmt = $conn->prepare("INSERT INTO deals (title, price, old_price, image_url, product_link, deadline) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $title, $price, $old_price, $image_url, $product_link, $deadline);
    
    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Deal added successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error adding deal: " . $conn->error . "</div>";
    }
}

if (isset($_POST['edit_deal'])) {
    $deal_id = $_POST['deal_id'];
    $title = $_POST['title'];
    $price = $_POST['price'];
    $old_price = $_POST['old_price'];
    $image_url = $_POST['image_url'];
    $product_link = $_POST['product_link'];
    $deadline = $_POST['deadline'];

    $stmt = $conn->prepare("UPDATE deals SET title = ?, price = ?, old_price = ?, image_url = ?, product_link = ?, deadline = ? WHERE id = ?");
    $stmt->bind_param("ssssssi", $title, $price, $old_price, $image_url, $product_link, $deadline, $deal_id);
    
    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Deal updated successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error updating deal: " . $conn->error . "</div>";
    }
}

if (isset($_POST['delete_deal_id'])) {
    $deal_id = $_POST['delete_deal_id'];

    $stmt = $conn->prepare("DELETE FROM deals WHERE id = ?");
    $stmt->bind_param("i", $deal_id);
    
    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Deal deleted successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error deleting deal: " . $conn->error . "</div>";
    }
}

$result = $conn->query("SELECT * FROM deals ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Manage Deals</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include('admin-navbar.php'); ?>

    <div class="container mt-4">
        <h1>Manage Deals</h1>

        <form method="POST" action="admin_add_deals.php" class="mb-4">
            <h3>Add New Deal</h3>
            <div class="mb-3">
                <label for="title" class="form-label">Deal Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="text" class="form-control" id="price" name="price" required>
            </div>
            <div class="mb-3">
                <label for="old_price" class="form-label">Old Price</label>
                <input type="text" class="form-control" id="old_price" name="old_price" required>
            </div>
            <div class="mb-3">
                <label for="image_url" class="form-label">Image URL</label>
                <input type="text" class="form-control" id="image_url" name="image_url" required>
            </div>
            <div class="mb-3">
                <label for="product_link" class="form-label">Product Link</label>
                <input type="text" class="form-control" id="product_link" name="product_link" required>
            </div>
            <div class="mb-3">
                <label for="deadline" class="form-label">Deadline</label>
                <input type="datetime-local" class="form-control" id="deadline" name="deadline" required>
            </div>
            <button type="submit" name="add_deal" class="btn btn-primary">Add Deal</button>
        </form>

        <h2>Existing Deals</h2>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Deal ID</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Old Price</th>
                    <th>Image</th>
                    <th>Product Link</th>
                    <th>Deadline</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                        <td><?php echo $row['old_price']; ?></td>
                        <td><img src="<?php echo $row['image_url']; ?>" alt="Deal Image" width="80"></td>
                        <td><a href="<?php echo $row['product_link']; ?>" target="_blank">View Product</a></td>
                        <td><?php echo $row['deadline']; ?></td>
                        <td>
                            <form method="POST" action="admin_add_deals.php" class="d-inline">
                                <input type="hidden" name="deal_id" value="<?php echo $row['id']; ?>">
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $row['id']; ?>">Edit</button>
                            </form>

                            <form method="POST" action="admin_add_deals.php" class="d-inline">
                                <input type="hidden" name="delete_deal_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this deal?');" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>

                    <div class="modal fade" id="editModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Edit Deal</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="admin_add_deals.php">
                                    <div class="modal-body">
                                        <input type="hidden" name="deal_id" value="<?php echo $row['id']; ?>">
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Deal Title</label>
                                            <input type="text" class="form-control" name="title" value="<?php echo $row['title']; ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="price" class="form-label">Price</label>
                                            <input type="text" class="form-control" name="price" value="<?php echo $row['price']; ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="old_price" class="form-label">Old Price</label>
                                            <input type="text" class="form-control" name="old_price" value="<?php echo $row['old_price']; ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="image_url" class="form-label">Image URL</label>
                                            <input type="text" class="form-control" name="image_url" value="<?php echo $row['image_url']; ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="product_link" class="form-label">Product Link</label>
                                            <input type="text" class="form-control" name="product_link" value="<?php echo $row['product_link']; ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="deadline" class="form-label">Deadline</label>
                                            <input type="datetime-local" class="form-control" name="deadline" value="<?php echo date('Y-m-d\TH:i', strtotime($row['deadline'])); ?>" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" name="edit_deal" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
