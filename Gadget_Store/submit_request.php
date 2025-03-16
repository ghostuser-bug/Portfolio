<?php
session_start();
include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['product_id'];
    $request_type = $_POST['request_type'];
    $reason = $_POST['reason'];
    $status = 'Pending'; // Default status for new requests
    $created_at = date('Y-m-d H:i:s'); // Current timestamp

    // Insert the request into the return_exchange_requests table
    $stmt = $conn->prepare("
        INSERT INTO return_exchange_requests (user_id, product_id, request_type, reason, status, created_at) 
        VALUES (?, ?, ?, ?, ?, ?)
    ");
    $stmt->bind_param('iissss', $user_id, $product_id, $request_type, $reason, $status, $created_at);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Your request has been submitted successfully.";
    } else {
        $_SESSION['error'] = "Failed to submit your request. Please try again.";
    }

    header('Location: return_exchange.php');
    exit;
} else {
    $_SESSION['error'] = "Invalid request.";
    header('Location: return_exchange.php');
    exit;
}
