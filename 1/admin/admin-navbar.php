<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin_id'])) {
    header('Location: admin-login.php');
    exit;
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="admin_dashboard.php">Admin Panel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="admin_view_orders.php">View Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_verify_requests.php">Verify Requests</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_process_orders.php">Process Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_manage_users.php">Manage Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_reports.php">Reports & Analytics</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_manage_products.php">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_add_deals.php">Add Deals</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_new_arrivals.php">Add New Arrival</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="admin_logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
