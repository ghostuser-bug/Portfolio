<?php
session_start();
include('db_connection.php');

$session_id = session_id();

$sql = "SELECT c.cart_id, c.product_id, p.name, p.image_url, p.discounted_price, c.quantity 
        FROM cart c 
        JOIN products p ON c.product_id = p.id 
        WHERE c.session_id = '$session_id'";
$result = $conn->query($sql);

$total_price = 0;
$cart_items = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cart_items[] = $row;
        $total_price += $row['discounted_price'] * $row['quantity'];
    }
} else {
    echo "Your cart is empty!";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $address = $conn->real_escape_string($_POST['address']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $payment_method = $conn->real_escape_string($_POST['payment_method']); // Get payment method from form

    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    } else {
        die("User not logged in. Please log in to place an order.");
    }

    $created_at = date('Y-m-d H:i:s');
    $order_date = date('Y-m-d H:i:s');

    $sql_order = "INSERT INTO orders (session_id, name, address, total_price, payment_method, status, created_at, email, phone, user_id, order_date)
                  VALUES ('$session_id', '$name', '$address', '$total_price', '$payment_method', 'Ordered', '$created_at', '$email', '$phone', '$user_id', '$order_date')";

    if ($conn->query($sql_order) === TRUE) {
        $order_id = $conn->insert_id;

        foreach ($cart_items as $item) {
            $product_id = $item['product_id'];
            $product_name = $conn->real_escape_string($item['name']);
            $quantity = $item['quantity'];
            $price = $item['discounted_price'];
            $total_item_price = $price * $quantity;

            $sql_order_item = "INSERT INTO order_items (order_id, product_id, product_name, quantity, price, total_price)
                               VALUES ('$order_id', '$product_id', '$product_name', '$quantity', '$price', '$total_item_price')";

            if (!$conn->query($sql_order_item)) {
                echo "Error inserting order item: " . $conn->error;
                exit();
            }
        }

        $conn->query("DELETE FROM cart WHERE session_id = '$session_id'");

        header("Location: payment.php?order_id=$order_id");
        exit();
    } else {
        echo "Error inserting order: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Gadget Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include('header.php'); ?>

<section class="checkout py-5">
    <div class="container">
        <h2>Checkout</h2>
        <form method="POST" action="checkout.php">
            <div class="row">
                <div class="col-md-6">
                    <h4>Your Cart</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cart_items as $item): ?>
                                <tr>
                                    <td>
                                        <img src="<?php echo htmlspecialchars($item['image_url']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" width="50">
                                        <?php echo htmlspecialchars($item['name']); ?>
                                    </td>
                                    <td>$<?php echo number_format($item['discounted_price'], 2); ?></td>
                                    <td><?php echo $item['quantity']; ?></td>
                                    <td>$<?php echo number_format($item['discounted_price'] * $item['quantity'], 2); ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="3" class="text-right"><strong>Total:</strong></td>
                                <td><strong>$<?php echo number_format($total_price, 2); ?></strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-md-6">
                    <h4>Shipping Information</h4>
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Shipping Address</label>
                        <textarea name="address" id="address" class="form-control" rows="4" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" name="phone" id="phone" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="payment_method">Payment Method</label>
                        <select name="payment_method" id="payment_method" class="form-control" required>
                            <option value="credit card">Credit Card</option>
                            <option value="fpx">FPX</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Place Order</button>
                </div>
            </div>
        </form>
    </div>
</section>

<?php include('footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
