<?php
session_start();
include('db.php');

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

if (isset($_POST['update_status'])) {
    $complaint_id = $_POST['complaint_id'];
    $status = $_POST['status'];

    $sql = "UPDATE complaints SET status = '$status' WHERE id = $complaint_id";

    if ($conn->query($sql) === TRUE) {
        echo "Complaint status updated successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
header("Location: admin_dashboard.php");
?>
