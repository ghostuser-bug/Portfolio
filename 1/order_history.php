<?php
session_start();
include('db_connection.php');

$sql = "SELECT * FROM orders WHERE session_id = '" . session_id() . "' ORDER BY order_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History - Gadget Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f4;
            font-family: 'Roboto', sans-serif;
        }

        .container {
            margin-top: 50px;
        }

        .order-table {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .order-table thead {
            background-color: #007bff;
            color: white;
        }

        .order-table th, .order-table td {
            vertical-align: middle;
        }

        .order-status {
            font-weight: bold;
        }

        .order-status.pending {
            color: orange;
        }

        .order-status.completed {
            color: green;
        }

        .order-status.shipped {
            color: blue;
        }

        .order-image img {
            max-width: 50px;
            border-radius: 8px;
        }

        .order-actions a {
            margin-right: 10px;
            text-decoration: none;
            color: #007bff;
        }

        .order-actions a:hover {
            text-decoration: underline;
        }

        .order-total {
            font-size: 1.25rem;
            font-weight: bold;
        }
    </style>
</head>
<body>

<?php include('header.php'); ?>

<div class="container">
    <h2 class="text-center mb-4">Order History</h2>

    <?php if ($result->num_rows > 0): ?>
        <?php while($order = $result->fetch_assoc()): ?>
            <div class="order-table mb-4">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Status</th>
                            <th>Payment Method</th>
                            <th>Total Price</th>
                            <th>Order Date</th>
                            <th>Items</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#<?php echo $order['order_id']; ?></td>
                            <td class="order-status <?php echo strtolower($order['status']); ?>"><?php echo ucfirst($order['status']); ?></td>
                            <td><?php echo !empty($order['payment_method']) ? htmlspecialchars($order['payment_method']) : 'Payment method not available'; ?></td>
                            <td class="order-total">$<?php echo number_format($order['total_price'], 2); ?></td>
                            <td><?php echo date("F j, Y, g:i a", strtotime($order['order_date'])); ?></td>
                            <td class="order-items">
                                <?php
                                $order_id = $order['order_id'];
                                $sql_items = "
                                SELECT oi.*, p.image
                                FROM order_items oi
                                INNER JOIN products p ON oi.product_id = p.id
                                WHERE oi.order_id = $order_id
                                ";

                                $result_items = $conn->query($sql_items);

                                if ($result_items->num_rows > 0) {
                                    while ($item = $result_items->fetch_assoc()) {
                                        echo '<div class="d-flex align-items-center mb-2">';
                                        echo '<div class="order-image mr-2">';
                                        if (!empty($item['image'])) {
                                            echo '<img src="images/' . htmlspecialchars($item['image']) . '" alt="' . htmlspecialchars($item['product_name']) . '">';
                                        } else {
                                            echo '<img src="images/default.jpg" alt="">';
                                        }
                                        echo '</div>';
                                        echo '<div>' . htmlspecialchars($item['product_name']) . ' x ' . $item['quantity'] . '</div>';
                                        echo '</div>';
                                    }
                                } else {
                                    echo '<div>No items found for this order.</div>';
                                }
                                ?>
                            </td>
                            <td class="order-actions">
                                <a href="order_details.php?order_id=<?php echo $order['order_id']; ?>">View Details</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <div class="alert alert-info text-center">No orders found.</div>
    <?php endif; ?>
</div>

<?php include('footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
