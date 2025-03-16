<?php
session_start();
include('db_connection.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in.']);
    exit();
}

$user_id = $_SESSION['user_id'];
$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;

// Ensure the order ID is valid
if ($order_id <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid order ID.']);
    exit();
}

// Capture payment details from POST
$payment_method = $_POST['payment_method'] ?? '';
$card_number = $_POST['card_number'] ?? '';
$expiry_date = $_POST['expiry_date'] ?? '';
$cvv = $_POST['cvv'] ?? '';
$fpx_bank = $_POST['fpx_bank'] ?? '';

// Process the payment method
if ($payment_method == 'credit_card') {
    // Validate credit card details (you can add additional validation here)
    if (empty($card_number) || empty($expiry_date) || empty($cvv)) {
        echo json_encode(['success' => false, 'message' => 'Credit card details are incomplete.']);
        exit();
    }

    // Here you would typically call an API to process the payment

    // For now, let's simulate successful payment and update the order status
    $payment_status = 'completed'; // You can set this to 'pending' if using actual payment gateways for confirmation

} elseif ($payment_method == 'fpx') {
    // Validate FPX bank details
    if (empty($fpx_bank)) {
        echo json_encode(['success' => false, 'message' => 'Bank selection is required.']);
        exit();
    }

    // Process FPX payment (similar to credit card, but use FPX API if available)

    // Simulate successful payment
    $payment_status = 'completed'; // Adjust the status as per actual payment

} else {
    echo json_encode(['success' => false, 'message' => 'Invalid payment method.']);
    exit();
}

// Update the order with the payment method and status
$sql_update = "UPDATE orders SET payment_method = ?, status = ? WHERE order_id = ? AND user_id = ?";
$stmt = $conn->prepare($sql_update);
$stmt->bind_param("ssii", $payment_method, $payment_status, $order_id, $user_id);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Payment processed successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error updating order status.']);
}

$stmt->close();
$conn->close();
?>
