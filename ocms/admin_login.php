<?php include('db.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Form Container */
        form {
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        /* Heading */
        form h2 {
            margin-bottom: 20px;
            color: #333333;
            font-size: 24px;
        }

        /* Labels */
        form label {
            display: block;
            margin-bottom: 8px;
            color: #555555;
            font-weight: bold;
            text-align: left;
        }

        /* Inputs */
        form input[type="text"],
        form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #cccccc;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }

        /* Button */
        form button {
            background-color: #007BFF;
            color: #ffffff;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        form button:hover {
            background-color: #0056b3;
        }

        /* Error Messages */
        form .error {
            color: red;
            font-size: 14px;
            margin-top: -15px;
            margin-bottom: 15px;
        }

    </style>
</head>
<body>
    <form action="" method="POST">
        <h2>Admin Login</h2>
        <label for="username">Username:</label>
        <input type="text" name="username" required>
        
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        
        <button type="submit" name="login">Login</button>
        <!-- Add this in your admin login page (admin_login.php) -->
<a href="logout.php">Logout</a>

    </form>

    <?php
    session_start();
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM admin WHERE username='$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (md5($password) == $row['password']) {
                $_SESSION['admin_id'] = $row['id'];
                header("Location: admin_dashboard.php");
            } else {
                echo "Invalid credentials.";
            }
        } else {
            echo "Admin not found.";
        }
    }
    ?>
</body>
</html>                     