<?php
session_start();
include('../db_connection.php');

if (!isset($_SESSION['admin_id'])) {
    header('Location: admin-login.php');
    exit;
}

$result_users = $conn->query("SELECT COUNT(*) AS total_users FROM users");
$total_users = $result_users->fetch_assoc()['total_users'];

$result_orders = $conn->query("SELECT COUNT(*) AS total_orders FROM orders");
$total_orders = $result_orders->fetch_assoc()['total_orders'];

$result_revenue = $conn->query("SELECT SUM(total_price) AS total_revenue FROM orders");
$total_revenue = $result_revenue->fetch_assoc()['total_revenue'];

$result_returns = $conn->query("SELECT COUNT(*) AS total_returns FROM return_exchange_requests WHERE request_type = 'Return'");
$total_returns = $result_returns->fetch_assoc()['total_returns'];

$result_exchanges = $conn->query("SELECT COUNT(*) AS total_exchanges FROM return_exchange_requests WHERE request_type = 'Exchange'");
$total_exchanges = $result_exchanges->fetch_assoc()['total_exchanges'];

$result_recent_orders = $conn->query("SELECT * FROM orders ORDER BY created_at DESC LIMIT 10");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Reports</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include('admin-navbar.php'); ?>
    <div class="container mt-4">
        <h1>Admin Reports</h1>

        <h2>Summary</h2>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Total Users</th>
                    <th>Total Orders</th>
                    <th>Total Revenue</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $total_users; ?></td>
                    <td><?php echo $total_orders; ?></td>
                    <td><?php echo $total_revenue ? '$' . number_format($total_revenue, 2) : '$0.00'; ?></td>
                </tr>
            </tbody>
        </table>

        <h2>Return and Exchange Trend</h2>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Total Returns</th>
                    <th>Total Exchanges</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $total_returns; ?></td>
                    <td><?php echo $total_exchanges; ?></td>
                </tr>
            </tbody>
        </table>

        <h2>Recent Orders</h2>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Order ID</th>
                    <th>Session ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result_recent_orders->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['order_id']; ?></td>
                        <td><?php echo $row['session_id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['address']; ?></td>
                        <td><?php echo '$' . number_format($row['total_price'], 2); ?></td>
                        <td><?php echo $row['status']; ?></td>
                        <td><?php echo $row['created_at']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
