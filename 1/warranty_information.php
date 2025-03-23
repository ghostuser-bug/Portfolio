<?php
ob_start();
session_start();
include('db_connection.php');

if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = "You must be logged in to view warranty information.";
    header('Location: login.php');
    exit;
}

include('header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warranty - Gadget Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .warranty-info-background {
            background-image: url('https://as2.ftcdn.net/v2/jpg/03/36/35/17/1000_F_336351674_YtV7B1F01jzBQd97D7XkFgU0jl6PM30w.jpg');
            background-size: cover;
            background-position: center;
            padding: 40px;
            color: white;
            border-radius: 10px;
        }
        .warranty-box {
            min-height: 300px;
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
        }
        .warranty-box h4 { font-size: 1.5rem; font-weight: bold; }
        .warranty-box p { font-size: 1rem; color: #555; }
        .mobile-phone { color: #28a745; }
        .laptop { color: #007bff; }
        .accessories { color: #ffc107; }
        .warranty-policy {
            background-color: #f8f9fa;
            padding: 30px;
            border-radius: 8px;
            margin-top: 30px;
        }
        .warranty-policy h4 { font-size: 1.5rem; font-weight: bold; color: #333; }
        .warranty-policy p { font-size: 1rem; color: #555; }
    </style>
</head>
<body>

<div class="container my-5">
    <div class="warranty-info-background">
        <h3 class="fw-bold text-center">Warranty Information</h3>
        <p>For peace of mind, we offer a manufacturer's warranty on all our products. If you ever need to claim against the warranty, please contact us and we'll guide you through the process.</p>
    </div>

    <div class="text-center mt-4">
        <a href="contact.php" class="btn btn-success">Contact Us for Warranty Support</a>
    </div>

    <div class="text-center my-5">
        <h4 class="fw-bold">What is covered in your warranty</h4>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="warranty-box">
                <h4 class="mobile-phone">Mobile Phone</h4>
                <p><strong>Warranty Excludes:</strong> Damage to buttons, housing, external attachments, LCD screen, SIM cards, and network-related issues.</p>
                <p><strong>Product:</strong> Phone hardware.</p>
                <p><strong>Warranty Period:</strong> 12 months.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="warranty-box">
                <h4 class="accessories">Accessories</h4>
                <p><strong>Warranty Excludes:</strong> Damage from misuse, wear and tear, unauthorized modifications, or cosmetic damage.</p>
                <p><strong>Product:</strong> USB cables, chargers, power banks, Bluetooth speakers, etc.</p>
                <p><strong>Warranty Period:</strong> 6 months.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="warranty-box">
                <h4 class="laptop">Laptop</h4>
                <p><strong>Warranty Excludes:</strong> Misuse, wear and tear, unauthorized repairs, software issues, and external damage.</p>
                <p><strong>Product:</strong> Laptop hardware and battery.</p>
                <p><strong>Warranty Period:</strong> 12 months.</p>
            </div>
        </div>
    </div>

    <div class="warranty-policy">
        <h4 class="fw-bold">Product Warranty Policy</h4>
        <p>All products purchased from Gadget Store are covered by a 12-month warranty unless stated otherwise.</p>

        <h5 class="fw-bold">What the Warranty Covers</h5>
        <ul>
            <li>Technical malfunctions caused by manufacturing defects.</li>
            <li>Hardware defects from factory faults.</li>
            <li>Functionality issues not caused by user error.</li>
        </ul>

        <h5 class="fw-bold">What the Warranty Does Not Cover</h5>
        <ul>
            <li>Damage from misuse, accidents, or mishandling.</li>
            <li>Cosmetic damage (scratches, dents).</li>
            <li>Products serviced by unauthorized third parties.</li>
            <li>Damage from non-original accessories.</li>
        </ul>

        <h5 class="fw-bold">Warranty Claim Procedure</h5>
        <ol>
            <li>Contact us with the product details and issue.</li>
            <li>Provide the purchase receipt and images if needed.</li>
            <li>The product will be sent for inspection.</li>
            <li>Repair or replacement will be provided if eligible.</li>
        </ol>

        <h5 class="fw-bold">Important Notes</h5>
        <ul>
            <li>Warranty applies only to products from Gadget Store.</li>
            <li>Claims must be made within the specified period.</li>
        </ul>
    </div>
</div>

<?php include('footer.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const supportDropdown = document.querySelector('#supportDropdown ~ .dropdown-menu');
        if (supportDropdown) {
            const returnExchangeItem = supportDropdown.querySelector('li:nth-child(2)');
            const warrantyLink = document.createElement('li');
            warrantyLink.innerHTML = '<a class="dropdown-item" href="warranty.php">Warranty</a>';
            if (returnExchangeItem) {
                returnExchangeItem.insertAdjacentElement('afterend', warrantyLink);
            } else {
                supportDropdown.appendChild(warrantyLink);
            }
        }
    });
</script>
</body>
</html>
