<?php
session_start();
include('../db_connection.php');

if (!isset($_SESSION['admin_id'])) {
    header('Location: admin-login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'], $_POST['order_id'])) {
    $order_id = intval($_POST['order_id']);
    $action = $_POST['action'];

    $stmt = $conn->prepare("SELECT status FROM orders WHERE order_id = ?");
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $stmt->bind_result($current_status);
    $stmt->fetch();
    $stmt->close();

    $current_status = trim($current_status);
    $status_updated = false;
    $message = '';

    switch (strtolower($action)) {
        case 'ship':
            if (strcasecmp($current_status, 'Ordered') == 0) {
                $new_status = 'Shipped';
                $status_updated = true;
                $message = "Order #$order_id status updated to Shipped!";
            } else {
                $message = "Cannot ship an order with '$current_status' status.";
            }
            break;

        case 'out_for_delivery':
            if (strcasecmp($current_status, 'Shipped') == 0) {
                $new_status = 'Out for Delivery';
                $status_updated = true;
                $message = "Order #$order_id status updated to Out for Delivery!";
            } else {
                $message = "Cannot mark as Out for Delivery from '$current_status' status.";
            }
            break;

        case 'deliver':
            if (strcasecmp($current_status, 'Out for Delivery') == 0) {
                $new_status = 'Delivered';
                $status_updated = true;
                $message = "Order #$order_id status updated to Delivered!";
            } else {
                $message = "Cannot deliver an order with '$current_status' status.";
            }
            break;

        case 'cancel':
            if (strcasecmp($current_status, 'Ordered') == 0) {
                $new_status = 'Cancelled';
                $status_updated = true;
                $message = "Order #$order_id status updated to Cancelled!";
            } else {
                $message = "Cannot cancel an order with '$current_status' status.";
            }
            break;

        default:
            $message = "Invalid action.";
            break;
    }

    if ($status_updated) {
        $stmt = $conn->prepare("UPDATE orders SET status = ? WHERE order_id = ?");
        $stmt->bind_param("si", $new_status, $order_id);
        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>$message</div>";
        } else {
            echo "<div class='alert alert-danger'>Error updating status: {$conn->error}</div>";
        }
        $stmt->close();
    } else {
        echo "<div class='alert alert-warning'>$message</div>";
    }
}

$orders = $conn->query("SELECT * FROM orders ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Process Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include('admin-navbar.php'); ?>

    <div class="container mt-4">
        <h1>Process Orders</h1>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Order ID</th>
                    <th>Session ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($order = $orders->fetch_assoc()): ?>
                    <tr>
                        <td><?= $order['order_id'] ?></td>
                        <td><?= htmlspecialchars($order['session_id']) ?></td>
                        <td><?= htmlspecialchars($order['name']) ?></td>
                        <td><?= htmlspecialchars($order['address']) ?></td>
                        <td>$<?= number_format($order['total_price'], 2) ?></td>
                        <td><?= htmlspecialchars($order['status']) ?></td>
                        <td><?= $order['created_at'] ?></td>
                        <td>
                            <?php if (strcasecmp($order['status'], 'Ordered') == 0): ?>
                                <form method="POST" class="d-inline">
                                    <input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">
                                    <button type="submit" name="action" value="ship" class="btn btn-success btn-sm">Ship</button>
                                </form>
                                <form method="POST" class="d-inline">
                                    <input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">
                                    <button type="submit" name="action" value="cancel" class="btn btn-danger btn-sm">Cancel</button>
                                </form>
                            <?php elseif (strcasecmp($order['status'], 'Shipped') == 0): ?>
                                <form method="POST" class="d-inline">
                                    <input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">
                                    <button type="submit" name="action" value="out_for_delivery" class="btn btn-warning btn-sm">Out for Delivery</button>
                                </form>
                            <?php elseif (strcasecmp($order['status'], 'Out for Delivery') == 0): ?>
                                <form method="POST" class="d-inline">
                                    <input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">
                                    <button type="submit" name="action" value="deliver" class="btn btn-primary btn-sm">Deliver</button>
                                </form>
                            <?php else: ?>
                                <span class="text-muted">No further action</span>
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
