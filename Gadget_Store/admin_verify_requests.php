<?php
session_start();
include('db_connection.php');

// Ensure admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header('Location: admin-login.php');
    exit;
}

// Handle approval/rejection of requests
if (isset($_POST['action']) && isset($_POST['request_id'])) {
    $request_id = $_POST['request_id'];
    $action = $_POST['action'];

    // Update the status of the verification request
    if ($action == 'approve') {
        $status = 'Approved';
    } elseif ($action == 'reject') {
        $status = 'Rejected';
    }

    // Update the request status in the database
    $stmt = $conn->prepare("UPDATE return_exchange_requests SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $request_id);
    if ($stmt->execute()) {
        $_SESSION['message'] = "Request status updated successfully!";
    } else {
        $_SESSION['message'] = "Error updating request status: " . $conn->error;
    }
    header('Location: admin_verify_requests.php');
    exit;
}

// Fetch all verification requests
$result = $conn->query("SELECT * FROM return_exchange_requests ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Verify Requests</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Admin Navbar -->
    <?php include('admin-navbar.php'); ?>

    <div class="container mt-4">
        <h1 class="mb-4">Verification Requests</h1>

        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-info">
                <?php 
                    echo $_SESSION['message']; 
                    unset($_SESSION['message']); 
                ?>
            </div>
        <?php endif; ?>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Request ID</th>
                    <th>User ID</th>
                    <th>Request Type</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['user_id']; ?></td>
                        <td><?php echo $row['request_type']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                        <td><?php echo $row['created_at']; ?></td>
                        <td>
                            <?php if ($row['status'] == 'Pending'): ?>
                                <form method="POST" action="admin_verify_requests.php" class="d-inline">
                                    <input type="hidden" name="request_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" name="action" value="approve" class="btn btn-success btn-sm">Approve</button>
                                </form>
                                <form method="POST" action="admin_verify_requests.php" class="d-inline">
                                    <input type="hidden" name="request_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" name="action" value="reject" class="btn btn-danger btn-sm">Reject</button>
                                </form>
                            <?php else: ?>
                                <span class="text-muted">No action needed</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JavaScript Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

