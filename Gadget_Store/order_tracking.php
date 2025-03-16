<?php
session_start();
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = htmlspecialchars(trim($_POST['order_id']));

    $query = "SELECT * FROM orders WHERE order_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $order_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $order = $result->fetch_assoc();
        
        // Fetch order items
        $item_query = "SELECT product_name, quantity, price FROM order_items WHERE order_id = ?";
        $item_stmt = $conn->prepare($item_query);
        $item_stmt->bind_param("s", $order_id);
        $item_stmt->execute();
        $items_result = $item_stmt->get_result();
        $items = $items_result->fetch_all(MYSQLI_ASSOC);
        
        // Calculate estimated delivery date (assuming 5 days shipping time)
        $order_date = new DateTime($order['order_date']);
        $estimated_delivery = $order_date->modify('+5 days')->format('Y-m-d');

        // Define order status stages
        $status_stages = ['Pending', 'Shipped', 'Out for Delivery', 'Delivered'];
        $current_status_index = array_search($order['status'], $status_stages);
    } else {
        $error = "No order found with this ID.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Order - Gadget Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .status-stage {
            display: inline-block;
            width: 24%;
            text-align: center;
            position: relative;
            font-size: 1.25rem;
            font-weight: bold;
        }
        .status-stage::before {
            content: '';
            height: 6px;
            width: 100%;
            background-color: #ddd;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translateX(-50%);
            z-index: -1;
        }
        .status-stage.active {
            color: #0d6efd;
        }
        .status-stage.active::before {
            background-color: #0d6efd;
        }
    </style>
</head>
<body>
<?php include('header.php'); ?>

<div class="container my-5">
    <h1 class="text-center mb-4">Track Your Order</h1>

    <form action="order_tracking.php" method="POST" class="w-50 mx-auto">
        <div class="mb-3">
            <label for="order_id" class="form-label">Enter Order ID</label>
            <input type="text" id="order_id" name="order_id" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Track Order</button>
    </form>

    <?php if (isset($order)): ?>
        <h2 class="mt-5">Order Details</h2>
        <div class="list-group">
            <p class="list-group-item"><strong>Order ID:</strong> <?php echo $order['order_id']; ?></p>
            <p class="list-group-item"><strong>Name:</strong> <?php echo htmlspecialchars($order['name']); ?></p>
            <p class="list-group-item"><strong>Email:</strong> <?php echo htmlspecialchars($order['email']); ?></p>
            <p class="list-group-item"><strong>Phone:</strong> <?php echo htmlspecialchars($order['phone']); ?></p>
            <p class="list-group-item"><strong>Address:</strong> <?php echo htmlspecialchars($order['address']); ?></p>
            <p class="list-group-item"><strong>Total Price:</strong> $<?php echo number_format($order['total_price'], 2); ?></p>
            <p class="list-group-item"><strong>Status:</strong> <?php echo htmlspecialchars($order['status']); ?></p>
            <p class="list-group-item"><strong>Estimated Delivery:</strong> <?php echo $estimated_delivery; ?></p>
        </div>

        <h2 class="mt-5">Order Status</h2>
        <div class="d-flex justify-content-between mt-3">
            <?php foreach ($status_stages as $index => $stage): ?>
                <div class="status-stage <?php echo ($index <= $current_status_index) ? 'active' : ''; ?>">
                    <?php echo $stage; ?>
                </div>
            <?php endforeach; ?>
        </div>

        <h2 class="mt-5">Items in Your Order</h2>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                        <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                        <td>$<?php echo number_format($item['price'], 2); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php elseif (isset($error)): ?>
        <div class="alert alert-danger mt-3"><?php echo $error; ?></div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
