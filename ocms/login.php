<?php include('db.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <style>
        body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #eef2f3; /* Light gradient-like background */
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

form {
    background-color: #ffffff; /* White background for the form */
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 350px;
    text-align: center;
}

h2 {
    margin-bottom: 20px;
    color: #4a90e2; /* Light blue color for the heading */
    font-size: 1.8em;
    font-weight: bold;
}

label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
    color: #333; /* Dark gray text color for labels */
}

input[type="text"],
input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 1em;
    box-sizing: border-box;
    background-color: #f9f9f9;
}

input:focus {
    border-color: #4a90e2;
    outline: none;
    box-shadow: 0 0 5px rgba(74, 144, 226, 0.5);
}

button {
    width: 100%;
    padding: 10px;
    font-size: 1em;
    font-weight: bold;
    color: white;
    background-color: #4a90e2;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s, transform 0.2s;
}

button:hover {
    background-color: #357ab8;
    transform: scale(1.05);
}

button:active {
    transform: scale(1);
}

</style>
</head>
<body>
    <form action="" method="POST">
        <h2>Login</h2>
        <label for="username">Username:</label>
        <input type="text" name="username" required>
        
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        
        <button type="submit" name="login">Login</button>
    </form>

    <?php
    session_start();
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['user_id'] = $row['id'];
                header("Location: dashboard.php");
            } else {
                echo "Invalid credentials.";
            }
        } else {
            echo "User not found.";
        }
    }
    ?>
</body>
</html>                             