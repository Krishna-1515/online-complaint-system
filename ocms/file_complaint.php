<?php
session_start();
include('db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['submit_complaint'])) {
    $user_id = $_SESSION['user_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    $sql = "INSERT INTO complaints (user_id, title, description) VALUES ('$user_id', '$title', '$description')";

    if ($conn->query($sql) === TRUE) {
        echo "Complaint filed successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
header("Location: dashboard.php");
?>

