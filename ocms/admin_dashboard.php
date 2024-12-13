<?php
session_start();
include('db.php');

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

// Fetch all complaints
$sql = "SELECT complaints.id, complaints.title, complaints.status, complaints.created_at, users.username 
        FROM complaints 
        JOIN users ON complaints.user_id = users.id";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f7f9fc; /* Light background */
    color: #333; /* Text color */
}

header {
    background-color: #007bff; /* Blue header background */
    color: white;
    padding: 20px;
    text-align: center;
    position: relative;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

header h1 {
    margin: 0;
    font-size: 2em;
}

header .logout {
    position: absolute;
    top: 20px;
    right: 20px;
    text-decoration: none;
    background-color: #ff4d4d; /* Red logout button */
    color: white;
    padding: 10px 15px;
    border-radius: 5px;
    font-weight: bold;
    transition: background-color 0.3s, transform 0.2s;
}

header .logout:hover {
    background-color: #cc0000;
    transform: scale(1.05);
}

main {
    padding: 20px;
    max-width: 1000px;
    margin: 20px auto;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

h2 {
    color: #007bff;
    font-size: 1.8em;
    margin-bottom: 20px;
    text-align: center;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    background-color: white;
}

table thead {
    background-color: #007bff; /* Blue header for the table */
    color: white;
}

table th,
table td {
    padding: 10px;
    text-align: left;
    border: 1px solid #ddd;
    font-size: 0.9em;
}

table th {
    font-size: 1em;
    text-transform: uppercase;
}

table tbody tr:nth-child(odd) {
    background-color: #f9f9f9; /* Alternating row colors */
}

table tbody tr:hover {
    background-color: #f1f7ff; /* Light blue hover effect */
}

form {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    align-items: center;
}

form select {
    padding: 5px;
    border: 1px solid #ddd;
    border-radius: 5px;
    background-color: #f9f9f9;
    font-size: 0.9em;
}

form button {
    padding: 8px 12px;
    font-size: 0.9em;
    color: white;
    background-color: #007bff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s, transform 0.2s;
}

form button:hover {
    background-color: #0056b3;
    transform: scale(1.05);
}

@media (max-width: 768px) {
    table th,
    table td {
        font-size: 0.8em;
        padding: 8px;
    }

    form {
        flex-direction: column;
        gap: 5px;
    }

    header .logout {
        padding: 8px 12px;
        font-size: 0.9em;
    }
}
</style>
</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
        <a href="logout.php" class="btn logout">Logout</a>
    </header>
    <main>
        <h2>Manage Complaints</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>User</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                        <td><?php echo $row['created_at']; ?></td>
                        <td>
                            <form action="update_complaint.php" method="POST">
                                <input type="hidden" name="complaint_id" value="<?php echo $row['id']; ?>">
                                <select name="status" required>
                                    <option value="Pending" <?php if ($row['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                                    <option value="In Progress" <?php if ($row['status'] == 'In Progress') echo 'selected'; ?>>In Progress</option>
                                    <option value="Resolved" <?php if ($row['status'] == 'Resolved') echo 'selected'; ?>>Resolved</option>
                                </select>
                                <button type="submit" name="update_status">Update</button>
                                <a href="logout.php">Logout</a>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
</body>
</html>
