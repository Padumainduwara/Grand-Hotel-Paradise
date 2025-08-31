<?php
// Your database connection code here
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ghp";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['account_type'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $account_type = $_POST['account_type'];

        // Add more fields if needed

        // Insert the new account into the users table
        $insertAccountQuery = "INSERT INTO users (username, password, account_type) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($insertAccountQuery);
        $stmt->bind_param("sss", $username, $password, $account_type);

        if ($stmt->execute()) {
            echo "Account created successfully!";
        } else {
            echo "Error creating account.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
        <title>Create Admin/Staff Accounts</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <style>
        body {
            background-color: #f5f5f5;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-control {
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            color: #fff;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Create Admin/Staff Accounts</h1>
        <form method="POST" action="adminaccountcreate.php">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="account_type">Account Type:</label>
                <select name="account_type" id="account_type" class="form-control">
                    <option value="Admin">Admin</option>
                    <option value="Staff">Staff</option>
                </select>
            </div>
            <!-- Add more form fields if needed -->

            <button type="submit" class="btn btn-primary">Create Account</button>
        </form>
    </div>
</body>
</html>
