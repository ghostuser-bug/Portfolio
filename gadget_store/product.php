<?php
session_start(); 

$conn = new mysqli("localhost", "root", "", "gadget_store");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = "SELECT * FROM products WHERE id = $product_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
} else {
    echo "Product not found!";
    exit;
}

$colors = [
    ['id' => 1, 'name' => 'Red'],
    ['id' => 2, 'name' => 'Blue'],
    ['id' => 3, 'name' => 'Green'],
    ['id' => 4, 'name' => 'Black'],
    ['id' => 5, 'name' => 'White']
];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $color_id = intval($_POST['color_id']);
    $quantity = intval($_POST['quantity']);
    $product_id = intval($_POST['product_id']);
    $session_id = session_id(); 

    $stmt = $conn->prepare("INSERT INTO cart (session_id, product_id, quantity, color_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siii", $session_id, $product_id, $quantity, $color_id);

    if ($stmt->execute()) {
        header("Location: cart.php?success=1");
        exit;
    } else {
        echo "<script>alert('Failed to add product to cart. Please try again.');</script>";
    }

    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product['name']; ?> - Gadget Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include('header.php'); ?>

<section class="product-detail py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="<?php echo $product['image_url']; ?>" class="img-fluid" alt="<?php echo $product['name']; ?>">
            </div>
            <div class="col-md-6">
                <h1 class="fw-bold"><?php echo $product['name']; ?></h1>
                <p class="text-danger fw-bold">$<?php echo $product['discounted_price']; ?> 
                    <del class="text-muted">$<?php echo $product['original_price']; ?></del>
                </p>
                <p class="text-muted"><?php echo $product['description']; ?></p>

                <form action="product.php?id=<?php echo $product_id; ?>" method="post">
                    <div class="mb-3">
                        <label for="color" class="form-label">Select Color</label>
                        <select class="form-select" id="color" name="color_id" required>
                            <option value="">Choose a color</option>
                            <?php foreach ($colors as $color): ?>
                                <option value="<?php echo $color['id']; ?>"><?php echo $color['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" value="1" min="1" required>
                    </div>
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                    <button type="submit" name="add_to_cart" class="btn btn-primary">Add to Cart</button>
                </form>

            </div>
        </div>
    </div>
</section>

<?php include('footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
