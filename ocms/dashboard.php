<?php
session_start();
include('db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch user's complaints
$sql = "SELECT * FROM complaints WHERE user_id = $user_id";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
        body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f0f4f8; /* Light background color */
    color: #333; /* Text color */
}

header {
    background-color: #007bff; /* Blue background for the header */
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
    transition: background-color 0.3s, transform 0.2s;
}

header .logout:hover {
    background-color: #cc0000;
    transform: scale(1.05);
}

main {
    padding: 20px;
    max-width: 800px;
    margin: 0 auto;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

h2 {
    color: #007bff;
    font-size: 1.5em;
    margin-bottom: 20px;
}

form {
    margin-bottom: 30px;
}

form label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
    color: #333;
}

form input[type="text"],
form textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 1em;
    background-color: #f9f9f9;
}

form input:focus,
form textarea:focus {
    border-color: #007bff;
    outline: none;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

form button {
    width: 100%;
    padding: 10px;
    font-size: 1em;
    font-weight: bold;
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

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

table thead {
    background-color: #007bff;
    color: white;
}

table th,
table td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ccc;
}

table tbody tr:hover {
    background-color: #f1f9ff; /* Light blue hover effect for rows */
}

table th {
    font-size: 1em;
}

table td {
    font-size: 0.9em;
    color: #555;
}

@media (max-width: 768px) {
    main {
        padding: 15px;
    }

    table {
        font-size: 0.8em;
    }

    header .logout {
        padding: 8px 12px;
    }
}
</style>
</head>
<body>
    <header>
        <h1>Welcome to Your Dashboard</h1>
        <a href="logout.php" class="btn logout">Logout</a>
    </header>
    <main>
        <h2>File a Complaint</h2>
        <form action="file_complaint.php" method="POST">
            <label for="title">Complaint Title:</label>
            <input type="text" name="title" required>

            <label for="description">Complaint Description:</label>
            <textarea name="description" rows="5" required></textarea>

            <button type="submit" name="submit_complaint">Submit Complaint</button>
        </form>

        <h2>Your Complaints</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                        <td><?php echo $row['created_at']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
</body>
</html>
