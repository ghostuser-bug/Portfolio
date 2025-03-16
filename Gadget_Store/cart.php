<?php
session_start(); // Start session to manage user-specific cart

// Connect to the database
$conn = new mysqli("localhost", "root", "", "gadget_store");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch cart items for the current session
$session_id = session_id();
$sql = "SELECT c.*, p.name, p.image_url, p.discounted_price, cl.name AS color_name 
        FROM cart c 
        JOIN products p ON c.product_id = p.id 
        JOIN colors cl ON c.color_id = cl.id 
        WHERE c.session_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $session_id);
$stmt->execute();
$result = $stmt->get_result();

$cart_items = [];
$total_price = 0;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cart_items[] = $row;
        $total_price += $row['discounted_price'] * $row['quantity'];
    }
}
$stmt->close();

// Handle quantity update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_cart'])) {
    $cart_id = intval($_POST['cart_id']);
    $new_quantity = intval($_POST['quantity']);
    
    if ($new_quantity > 0) {
        $update_sql = "UPDATE cart SET quantity = ? WHERE cart_id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ii", $new_quantity, $cart_id);
        $update_stmt->execute();
        $update_stmt->close();
        header("Location: cart.php"); // Refresh the page
        exit();
    }
}

// Handle item removal
if (isset($_GET['remove_item'])) {
    $cart_id = intval($_GET['remove_item']);
    $remove_sql = "DELETE FROM cart WHERE cart_id = ?";
    $remove_stmt = $conn->prepare($remove_sql);
    $remove_stmt->bind_param("i", $cart_id);
    $remove_stmt->execute();
    $remove_stmt->close();
    header("Location: cart.php"); // Refresh the page
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - Gadget Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .cart-summary {
            background: #28a745; /* Green color matching the search button */
            color: #000;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        .cart-item-card {
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            border: none;
            border-radius: 10px;
        }
        .cart-item-card img {
            height: 180px;
            object-fit: cover;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .cart-empty img {
            max-width: 250px;
            margin-bottom: 20px;
        }
        .btn-update {
            background:rgb(15, 66, 233);
            color: #fff;
        }
        .btn-update:hover {
            background: #f76c6c;
        }
        .color-badge {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            margin-right: 8px;
            border: 2px solid #ddd;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            vertical-align: middle;
        }
    </style>
</head>
<body>
<?php include('header.php'); ?>

<section class="cart py-5">
    <div class="container">
        <h1 class="fw-bold mb-4">Your Cart</h1>

        <?php if (!empty($cart_items)): ?>
            <div class="row">
                <!-- Cart Items -->
                <div class="col-md-8">
                    <div class="row">
                        <?php foreach ($cart_items as $item): ?>
                            <div class="col-md-6 mb-4">
                                <div class="card cart-item-card">
                                    <img src="<?php echo $item['image_url']; ?>" class="card-img-top" alt="<?php echo $item['name']; ?>">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $item['name']; ?></h5>
                                        <p class="text-danger fw-bold">$<?php echo $item['discounted_price']; ?></p>
                                        <p>Quantity: 
                                            <form action="cart.php" method="POST" class="d-inline">
                                                <input type="hidden" name="cart_id" value="<?php echo $item['cart_id']; ?>">
                                                <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1" class="form-control d-inline w-50">
                                                <button type="submit" name="update_cart" class="btn btn-update btn-sm mt-2">Update</button>
                                            </form>
                                        </p>
                                        <p>Selected Color: 
                                            <span class="d-inline-block color-badge" style="background: <?php echo strtolower($item['color_name']); ?>;"></span> 
                                            <strong><?php echo $item['color_name']; ?></strong>
                                        </p>
                                        <a href="cart.php?remove_item=<?php echo $item['cart_id']; ?>" class="btn btn-outline-danger w-100">Remove</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Cart Summary -->
                <div class="col-md-4">
                    <div class="cart-summary">
                        <h4 class="fw-bold mb-3">Cart Summary</h4>
                        <p class="mb-2">Total Items: <strong><?php echo count($cart_items); ?></strong></p>
                        <p class="mb-4">Total Price: <strong>$<?php echo number_format($total_price, 2); ?></strong></p>
                        <a href="checkout.php" class="btn btn-light w-100">Proceed to Checkout</a>
                        <a href="store.php" class="btn btn-outline-light w-100 mt-3">Continue Shopping</a>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <!-- Empty Cart Message -->
            <div class="cart-empty text-center">
                <img src="https://previews.123rf.com/images/pshonka/pshonka1802/pshonka180200291/95077629-shopping-cart-with-cross-sign-cancel-or-delete-purchase-simple-icon-e-commerce-graph-symbol-for.jpg" alt="Empty Cart" class="img-fluid">
                <h4 class="fw-bold">Your cart is empty!</h4>
                <p class="text-muted">Browse our store to add items to your cart.</p>
                <a href="store.php" class="btn btn-primary mt-3">Start Shopping</a>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php include('footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
