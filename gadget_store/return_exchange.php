<?php
session_start();
include('db_connection.php');

if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = "You must be logged in to initiate a return or exchange request.";
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['product_id'];
    $request_type = $_POST['request_type'];
    $reason = $_POST['reason'];

    if (empty($product_id) || empty($request_type) || empty($reason)) {
        $_SESSION['error'] = "All fields are required.";
    } else {
        $stmt = $conn->prepare("INSERT INTO return_exchange_requests (user_id, product_id, request_type, reason, status) VALUES (?, ?, ?, ?, 'Pending')");
        $stmt->bind_param('iiss', $user_id, $product_id, $request_type, $reason);

        if ($stmt->execute()) {
            $user_email = $_SESSION['email'];
            $subject = "Return/Exchange Request Submitted";
            $message = "Dear Customer,\n\nYour return/exchange request has been submitted successfully. Our team will review it shortly.\n\nThank you for shopping with us!\n\n- Gadget Store";
            $headers = "From: support@gadgetstore.com";

            mail($user_email, $subject, $message, $headers);

            $_SESSION['success'] = "Your request has been submitted successfully, and a confirmation email has been sent.";
        } else {
            $_SESSION['error'] = "There was an error submitting your request. Please try again.";
        }
    }

    header('Location: return_exchange.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Return/Exchange - Gadget Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include('header.php'); ?>

<div class="container my-5">
    <h1 class="text-center mb-4">Return or Exchange Request</h1>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <form action="return_exchange.php" method="POST" class="w-50 mx-auto">
        <div class="mb-3">
            <label for="product_id" class="form-label">Select Product</label>
            <select id="product_id" name="product_id" class="form-control" required>
                <option value="">Select your product</option>
                <?php
                $user_id = $_SESSION['user_id'];
                $stmt = $conn->prepare("SELECT oi.product_id, oi.product_name FROM orders o INNER JOIN order_items oi ON o.order_id = oi.order_id WHERE o.user_id = ? AND o.status = 'Delivered'");
                $stmt->bind_param('i', $user_id);
                $stmt->execute();
                $result = $stmt->get_result();
                while ($product = $result->fetch_assoc()): ?>
                    <option value="<?php echo htmlspecialchars($product['product_id']); ?>">
                        <?php echo htmlspecialchars($product['product_name']); ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="request_type" class="form-label">Request Type</label>
            <select id="request_type" name="request_type" class="form-control" required>
                <option value="">Choose type</option>
                <option value="Return">Return</option>
                <option value="Exchange">Exchange</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="reason" class="form-label">Reason</label>
            <textarea id="reason" name="reason" class="form-control" rows="5" placeholder="Provide a detailed reason for your request" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary w-100">Submit Request</button>
    </form>

    <div class="mt-5">
        <h2 class="text-center mb-3">Return and Exchange Policies</h2>
        <p>
            At Gadget Store, we strive to ensure your satisfaction with your purchases. If you're not completely satisfied with your purchase, you may request a return or exchange within 30 days of receiving your item. Items must be returned in their original condition with all accessories and packaging. For more details, please visit our <a href="policies.pdf">Policies Page</a>.
        </p>
    </div>
</div>

<?php include('footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
