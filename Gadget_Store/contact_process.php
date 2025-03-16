<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Process form (e.g., save to database or send email)
    // For this example, we'll just redirect to a thank-you page
    header("Location: thank_you.php");
    exit();
} else {
    // Redirect to contact page if accessed directly without submitting the form
    header("Location: contact.php");
    exit();
}
?>
