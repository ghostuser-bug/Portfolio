<?php
session_start();
include('db_connection.php');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in.']);
    exit();
}

$user_id = $_SESSION['user_id'];
$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;

if ($order_id <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid order ID.']);
    exit();
}

$payment_method = $_POST['payment_method'] ?? '';
$card_number = $_POST['card_number'] ?? '';
$expiry_date = $_POST['expiry_date'] ?? '';
$cvv = $_POST['cvv'] ?? '';
$fpx_bank = $_POST['fpx_bank'] ?? '';

if ($payment_method == 'credit_card') {
    if (empty($card_number) || empty($expiry_date) || empty($cvv)) {
        echo json_encode(['success' => false, 'message' => 'Credit card details are incomplete.']);
        exit();
    }


    $payment_status = 'completed'; 

} elseif ($payment_method == 'fpx') {
    if (empty($fpx_bank)) {
        echo json_encode(['success' => false, 'message' => 'Bank selection is required.']);
        exit();
    }


    $payment_status = 'completed'; 

} else {
    echo json_encode(['success' => false, 'message' => 'Invalid payment method.']);
    exit();
}

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
