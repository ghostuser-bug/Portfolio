<?php
$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Failed - Gadget Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include('header.php'); ?>

<section class="payment-failure py-5">
    <div class="container text-center">
        <div class="alert alert-danger">
            <h2>Payment Failed</h2>
            <p>Unfortunately, your payment could not be processed. Please try again later or contact support if the problem persists.</p>
            <a href="payment.php?order_id=<?php echo htmlspecialchars($order_id); ?>" class="btn btn-primary">Try Again</a>
            <a href="contact.php" class="btn btn-secondary">Contact Support</a>
        </div>
    </div>
</section>

<?php include('footer.php'); ?>

</body>
</html>

