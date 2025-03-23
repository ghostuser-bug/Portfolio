<?php
session_start();
include('../db_connection.php');

if (!isset($_SESSION['admin_id'])) {
    header('Location: admin_login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .dashboard-container {
            margin-top: 50px;
        }
        .nav-link {
            font-size: 18px;
        }
        .nav-link:hover {
            background-color: #0d6efd;
            color: #fff !important;
        }
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <div class="container dashboard-container">
        <h1 class="text-center text-primary mb-4">Admin Dashboard</h1>
        <div class="row">
            <div class="col-md-4 mb-4">
                <a href="admin_view_orders.php" class="text-decoration-none">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title text-primary">View Orders</h5>
                            <p class="card-text">Review and manage customer orders.</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="admin_verify_requests.php" class="text-decoration-none">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Verify Requests</h5>
                            <p class="card-text">Handle verification requests from users.</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="admin_process_orders.php" class="text-decoration-none">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Process Orders</h5>
                            <p class="card-text">Approve or reject pending orders.</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="admin_manage_users.php" class="text-decoration-none">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Manage Users</h5>
                            <p class="card-text">View, edit, or delete user profiles.</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="admin_reports.php" class="text-decoration-none">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Reports & Analytics</h5>
                            <p class="card-text">View reports and analyze data.</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="admin_manage_products.php" class="text-decoration-none">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Manage Products</h5>
                            <p class="card-text">Add, update, or remove products.</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="admin_add_deals.php" class="text-decoration-none">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Add Deals</h5>
                            <p class="card-text">Make a new deals and promotion</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="admin_new_arrivals.php" class="text-decoration-none">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Add new Arrivals</h5>
                            <p class="card-text">Add new arrivals product</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="admin_logout.php" class="btn btn-danger btn-lg">Logout</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
