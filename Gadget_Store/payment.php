<?php
session_start();
include('db_connection.php');

// Get the order ID from the URL
$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;

if ($order_id == 0) {
    echo "Invalid order ID.";
    exit();
}

// Fetch order details
$sql = "SELECT * FROM orders WHERE order_id = $order_id AND session_id = '" . session_id() . "'";
$result = $conn->query($sql);

// Check if the query was successful and if any order was found
if ($result->num_rows == 0) {
    echo "Order not found.";
    exit();
}

$order = $result->fetch_assoc();

// Handle the POST request (payment processing)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get payment method from POST data
    $payment_method = $_POST['payment_method'];

    // Simulate payment success (for the sake of the example)
    $payment_success = true;  // You can implement more sophisticated payment handling

    if ($payment_success) {
        // If payment is successful, update the order status
        $sql_update = "UPDATE orders SET payment_method = '$payment_method', status = 'completed' WHERE order_id = $order_id";

        if ($conn->query($sql_update) === TRUE) {
            echo "<script>
                    alert('Payment successfully processed! Your order is confirmed.');
                    window.location.href = 'order_history.php';
                  </script>";
        } else {
            echo "Error updating order status: " . $conn->error;
        }
    } else {
        // Simulate failure
        echo "<script>
                alert('Payment failed. Please try again.');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - Gadget Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }

        .payment-container {
            background: #ffffff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
            margin-top: 50px;
        }

        .payment-header {
            margin-bottom: 30px;
        }

        .payment-header h2 {
            font-size: 24px;
            color: #007bff;
        }

        .payment-summary p {
            font-size: 18px;
            color: #555;
        }

        .btn-confirm {
            background-color: #007bff;
            color: #fff;
            width: 100%;
            padding: 12px;
            font-size: 18px;
            font-weight: bold;
            border-radius: 8px;
            border: none;
        }

        .btn-confirm:hover {
            background-color: #0056b3;
        }

        .modal-content {
            border-radius: 12px;
        }

        .payment-method-card {
            cursor: pointer;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin: 10px 0;
            text-align: center;
            transition: 0.3s ease;
        }

        .payment-method-card:hover {
            border-color: #007bff;
            box-shadow: 0px 0px 15px rgba(0, 123, 255, 0.1);
        }

        .payment-method-card i {
            font-size: 40px;
            color: #007bff;
        }

        .payment-method-card p {
            margin-top: 10px;
            font-size: 18px;
        }

    </style>
</head>
<body>

<?php include('header.php'); ?>

<section class="payment">
    <div class="payment-container">
        <div class="payment-header">
            <h2>Payment for Order #<?php echo $order['order_id']; ?></h2>
            <div class="payment-summary">
                <p><strong>Name:</strong> <?php echo htmlspecialchars($order['name']); ?></p>
                <p><strong>Address:</strong> <?php echo htmlspecialchars($order['address']); ?></p>
                <p><strong>Total Price:</strong> $<?php echo number_format($order['total_price'], 2); ?></p>
            </div>
        </div>

        <!-- Payment Form -->
        <form method="POST" action="">
            <!-- Confirm Payment Button -->
            <button type="button" class="btn-confirm" data-bs-toggle="modal" data-bs-target="#paymentModal">Confirm Payment</button>

            <!-- Payment Modal -->
            <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="paymentModalLabel">Select Payment Method</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Payment Methods -->
                            <div class="payment-method-card" onclick="selectPaymentMethod('credit_card')">
                                <i class="fas fa-credit-card"></i>
                                <p>Credit Card</p>
                            </div>
                            <div class="payment-method-card" onclick="selectPaymentMethod('fpx')">
                                <i class="fas fa-university"></i>
                                <p>FPX Banking</p>
                            </div>

                            <!-- Credit Card Details (Hidden initially) -->
                            <div id="creditCardDetails" style="display: none;">
                                <div class="mb-3">
                                    <label for="card_number" class="form-label">Card Number</label>
                                    <input type="text" class="form-control" id="card_number" name="card_number" placeholder="Enter card number" required>
                                </div>
                                <div class="mb-3">
                                    <label for="expiry_date" class="form-label">Expiry Date</label>
                                    <input type="text" class="form-control" id="expiry_date" name="expiry_date" placeholder="MM/YY" required>
                                </div>
                                <div class="mb-3">
                                    <label for="cvv" class="form-label">CVV</label>
                                    <input type="text" class="form-control" id="cvv" name="cvv" placeholder="Enter CVV" required>
                                </div>
                            </div>

                            <!-- FPX Details (Hidden initially) -->
                            <div id="fpxDetails" style="display: none;">
                                <p>Please select your bank to proceed with FPX payment.</p>
                                <select class="form-control" id="fpx_bank" name="fpx_bank">
                                    <option value="">Select Bank</option>
                                    <option value="fpx_cimbclicks">CIMB Clicks</option>
                                    <option value="fpx_maybank2u">Maybank2u</option>
                                </select>
                            </div>

                            <!-- Hidden Input for Payment Method -->
                            <input type="hidden" id="payment_method" name="payment_method">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Proceed to Payment</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<?php include('footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function selectPaymentMethod(method) {
        const creditCardDetails = document.getElementById('creditCardDetails');
        const fpxDetails = document.getElementById('fpxDetails');
        const paymentMethodInput = document.getElementById('payment_method');

        if (method === 'credit_card') {
            creditCardDetails.style.display = 'block';
            fpxDetails.style.display = 'none';
            paymentMethodInput.value = 'credit_card';  // Set the payment method to credit_card
        } else if (method === 'fpx') {
            fpxDetails.style.display = 'block';
            creditCardDetails.style.display = 'none';
            paymentMethodInput.value = 'fpx';  // Set the payment method to fpx
        }
    }
</script>

</body>
</html>
