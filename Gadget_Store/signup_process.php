<?php
session_start();
include('db_connection.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate the inputs
    if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
        $_SESSION['error'] = 'All fields are required.';
        header('Location: signup_login.php');
        exit;
    }

    // Check if passwords match
    if ($password !== $confirm_password) {
        $_SESSION['error'] = 'Passwords do not match.';
        header('Location: signup_login.php');
        exit;
    }

    // Check if the email already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param('s', $email); // Bind email as a string
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['error'] = 'Email is already registered.';
        header('Location: signup_login.php');
        exit;
    }

    // Hash the password for storage
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert the new user into the database
    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param('sss', $name, $email, $hashed_password); // Bind name, email, and hashed password as strings
    if ($stmt->execute()) {
        // Redirect to the login page after successful signup
        $_SESSION['success'] = 'Account created successfully. Please log in.';
        header('Location: signup_login.php');
        exit;
    } else {
        $_SESSION['error'] = 'Error creating account. Please try again.';
        header('Location: signup_login.php');
        exit;
    }
} else {
    // Redirect to the signup page if the form is not submitted
    header('Location: signup_login.php');
    exit;
}
?>
