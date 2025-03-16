<?php
session_start();
include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $_SESSION['error'] = 'All fields are required.';
        header('Location: signup_login.php');
        exit;
    }

    // Use mysqli syntax
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param('s', $email); // Bind email as a string
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        // Set session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_email'] = $user['email'];

        // Redirect to the homepage or dashboard
        header('Location: index.php');
        exit;
    } else {
        $_SESSION['error'] = 'Invalid email or password.';
        header('Location: signup_login.php');
        exit;
    }
} else {
    header('Location: signup_login.php');
    exit;
}
?>

