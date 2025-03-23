<?php
session_start();
include('db_connection.php');

if (!isset($_GET['order_id'])) {
    echo "Invalid order ID.";
    exit;
}

$order_id = intval($_GET['order_id']);
$session_id = session_id(); 

$sql_order = "SELECT * FROM orders WHERE order_id = ? AND session_id = ?";
$stmt_order = $conn->prepare($sql_order);
$stmt_order->bind_param("is", $order_id, $session_id); 
$stmt_order->execute();
$result_order = $stmt_order->get_result();
$order = $result_order->fetch_assoc();

if (!$order) {
    echo "Order not found.";
    exit;
}

$sql_items = "
    SELECT oi.*, p.name AS product_name, p.image 
    FROM order_items oi
    INNER JOIN products p ON oi.product_id = p.id
    WHERE oi.order_id = ?
";
$stmt_items = $conn->prepare($sql_items);
$stmt_items->bind_param("i", $order_id);
$stmt_items->execute();
$result_items = $stmt_items->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details - Gadget Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f4;
            font-family: 'Roboto', sans-serif;
        }

        .container {
            margin-top: 50px;
        }

        .order-details {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .progress-bar {
            height: 30px;
            font-size: 0.9rem;
            font-weight: bold;
        }

        .order-items img {
            max-width: 50px;
            border-radius: 8px;
        }

        .order-status {
            text-transform: capitalize;
            font-weight: bold;
        }

        .status-pending { color: orange; }
        .status-shipped { color: blue; }
        .status-completed { color: green; }
        .status-cancelled { color: red; }
    </style>
</head>
<body>

<?php include('header.php'); ?>

<div class="container">
    <h2 class="text-center mb-4">Order Details</h2>

    <div class="order-details">
        <h4>Order #<?php echo $order['order_id']; ?></h4>
        <p><strong>Status:</strong> <span class="order-status status-<?php echo strtolower($order['status']); ?>">
            <?php echo ucfirst($order['status']); ?>
        </span></p>
        <p><strong>Order Date:</strong> <?php echo date("F j, Y, g:i a", strtotime($order['order_date'])); ?></p>
        <p><strong>Total Price:</strong> $<?php echo number_format($order['total_price'], 2); ?></p>
        

        <!-- Order Items -->
        <h5>Order Items</h5>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($item = $result_items->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td>$<?php echo number_format($item['price'], 2); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include('footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
