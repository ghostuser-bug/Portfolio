<?php
session_start();
include('db_connection.php');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = "You must be logged in to submit a request.";
    header('Location: signup_login.php');
    exit;
}

// Validate input
if (!isset($_GET['product_id'], $_GET['order_id'])) {
    $_SESSION['error'] = "Invalid request.";
    header('Location: return_exchange.php');
    exit;
}

$product_id = $_GET['product_id'];
$order_id = $_GET['order_id'];

// Check if the product belongs to a completed order for the current user
$stmt = $conn->prepare("
    SELECT o.order_id 
    FROM orders o
    INNER JOIN order_items oi ON o.order_id = oi.order_id
    WHERE oi.product_id = ? AND o.order_id = ? AND o.user_id = ? AND o.status = 'Delivered'
");
$stmt->bind_param('iii', $product_id, $order_id, $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $_SESSION['error'] = "Invalid product or order.";
    header('Location: return_exchange.php');
    exit;
}

// Display the return/exchange form
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Return/Exchange Request</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h1 class="text-center mb-4">Return or Exchange Request</h1>
    <form action="submit_request.php" method="POST">
        <input type="hidden" name="product_id" value="<?= htmlspecialchars($product_id) ?>">
        <div class="mb-3">
            <label for="request_type" class="form-label">Request Type</label>
            <select id="request_type" name="request_type" class="form-control" required>
                <option value="Return">Return</option>
                <option value="Exchange">Exchange</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="reason" class="form-label">Reason</label>
            <textarea id="reason" name="reason" class="form-control" rows="5" placeholder="Provide a reason for your request" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary w-100">Submit Request</button>
    </form>
</div>
</body>
</html>
