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
        .warranty-box h4 {
            font-size: 1.5rem;
            font-weight: bold;
        }
        .warranty-box p {
            font-size: 1rem;
            color: #555;
        }
        .mobile-phone {
            color: #28a745; 
        }
        .laptop {
            color: #007bff;
        }
        .accessories {
            color: #ffc107; 
        }
        .warranty-policy {
            background-color: #f8f9fa; 
            padding: 30px;
            border-radius: 8px;
            margin-top: 30px;
        }
        .warranty-policy h4 {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
        }
        .warranty-policy p {
            font-size: 1rem;
            color: #555;
        }
    </style>
</head>
<body>
<?php
session_start();
include('header.php');
include('db_connection.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = "You must be logged in to view warranty information.";
    header('Location: signup_login.php');
    exit;
}
?>

<div class="container my-5">
    <div class="warranty-info-background">
        <h3 class="fw-bold text-center">Warranty Information</h3>
        <p>For peace of mind, we offer a manufacturer's warranty on all our products. If you ever need to claim against the warranty, please contact us and we'll guide you through the process. Below you'll find details of what's covered in your warranty at a glance, as well as links to register your product and check what products you already have registered. We recommend registering your product with us so we can help you more quickly and efficiently should you need to contact us.</p>
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
                <p><strong>Warranty Excludes:</strong> This warranty does not cover damage to the mobile phone's buttons, housing, external attachments, or LCD screen (except at the point of purchase). It also excludes issues related to SIM cards, network coverage, service, or range. The warranty is limited to the phone's hardware and original battery, and does not cover unauthorized repairs, modifications, software issues, or accessories not included with the original purchase.</p>
                <p><strong>Product:</strong> Product hardware.</p>                
                <p><strong>Warranty Period:</strong> 12 months warranty for phone hardware.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="warranty-box">
                <h4 class="accessories">Accessories</h4>
                <p><strong>Warranty Excludes:</strong> This warranty does not cover damage caused by misuse, accidents, or improper handling of the product. It also excludes wear and tear resulting from regular use or aging, as well as damage from unauthorized repairs, modifications, or alterations. Cosmetic damage, such as scratches, dents, or cracks, is not covered, nor is any issue arising from improper installation or connections, including damage caused by incompatible devices. Additionally, loss or theft of the product is not covered, and products purchased from unauthorized sellers or third-party platforms are excluded from warranty coverage. Software-related issues or malfunctions that are not linked to hardware defects are also excluded.</p>
                <p><strong>Product:</strong> USB Lightning, USB Type-C, USB Micro, Power Bank, Car Charger, Charger Adapter, Magnetic Charger, Keyboard, Mouse, Camera Web Cam, Airpod Pro, Selfie Stick, Bluetooth Speakers.</p>
                <p><strong>Warranty Period:</strong> 6 months warranty for accessories.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="warranty-box">
                <h4 class="laptop">Laptop</h4>
                <p><strong>Warranty Excludes:</strong> This warranty does not cover damage caused by misuse, accidents, or improper handling. It also excludes wear and tear, cosmetic damage (such as scratches, dents, or cracks), and issues resulting from unauthorized repairs or modifications. The warranty does not cover software-related problems, data loss, or issues caused by third-party accessories. Additionally, any damage to the battery or power adapter due to normal usage is not included. Loss, theft, or damages caused by external factors such as power surges or environmental conditions are also excluded.</p>
                <p><strong>Product:</strong> Laptop hardware and battery (excluding consumables and external attachments).</p>
                <p><strong>Warranty Period:</strong> 12 months warranty for laptop hardware.</p>
            </div>
        </div>
    </div>

    <div class="warranty-policy">
        <h4 class="fw-bold">Product Warranty Policy</h4>
        <p>Thank you for purchasing from Gadget Store! We are committed to providing the best products and services to our customers. To ensure your satisfaction, we offer a warranty on all products purchased at our store. This policy is designed to protect your rights as a consumer and provide peace of mind with every purchase.</p>

        <h5 class="fw-bold">Warranty Period</h5>
        <p>All products purchased from Gadget Store are covered by a 12-month warranty (or the period specified on the purchase receipt) from the date of purchase. This warranty applies to all items damaged due to manufacturing defects or technical issues that are not caused by improper use.</p>

        <h5 class="fw-bold">What the Warranty Covers</h5>
        <ul>
            <li>Technical malfunctions caused by manufacturing defects.</li>
            <li>Hardware defects resulting from manufacturing faults.</li>
            <li>Functionality issues that arise within the warranty period, without user error.</li>
        </ul>

        <h5 class="fw-bold">What the Warranty Does Not Cover</h5>
        <ul>
            <li>Damages caused by improper use, accidents, or mishandling.</li>
            <li>Cosmetic damages (e.g., scratches or dents).</li>
            <li>Products that have been serviced or modified by unauthorized third parties.</li>
            <li>Damage caused by using incompatible or non-original accessories or components.</li>
        </ul>

        <h5 class="fw-bold">Warranty Claim Procedure</h5>
        <ol>
            <li>Contact us via phone or email with the product details and issue you are facing.</li>
            <li>Provide the purchase receipt and images of the product if needed.</li>
            <li>The product will be sent to our service center for inspection.</li>
            <li>We will repair or replace your product if it meets the warranty conditions.</li>
        </ol>

        <h5 class="fw-bold">Our Warranty Advantages</h5>
        <ul>
            <li>Easy and quick process: We aim to process your claim as swiftly as possible to ensure you can enjoy your product without delay.</li>
            <li>Free replacement or repair: If your product is damaged during the warranty period, we will replace or repair it at no additional cost.</li>
            <li>Friendly customer support: We are always available to assist you with any questions or concerns regarding our products.</li>
        </ul>

        <h5 class="fw-bold">Important Notes</h5>
        <ul>
            <li>This warranty is valid only for products purchased from Gadget Store.</li>
            <li>Warranty claims must be made within the specified period.</li>
            <li>We reserve the right to modify this policy at any time without prior notice. Please check this policy for any updates.</li>
        </ul>

        <h5 class="fw-bold">Thank you for trusting Gadget Store! We strive to provide you with the best shopping experience!</h5>
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
