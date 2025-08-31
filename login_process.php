<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve user input and sanitize it to prevent SQL injection.
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    // Replace with your database connection details.
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "ghp";

    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare a secure SQL query using placeholders to prevent SQL injection.
    $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['account_type'] = $user['account_type'];
        $_SESSION['customer_name'] = $user['full_name'];

        // Redirect to the appropriate dashboard based on the account type.
        if ($user['account_type'] === 'Customer') {
            header("Location: customerdashboard.php");
        } elseif ($user['account_type'] === 'Admin') {
            header("Location: admindashboard.php");
        } elseif ($user['account_type'] === 'Staff') {
            header("Location: staffdashboard.php");
        }
    } else {
        // Invalid credentials, redirect back to the login page with an error.
        header("Location: login.php?error=1");
    }
} else {
    // Handle cases where the request method is not POST.
    header("Location: login.php");
}
?>
