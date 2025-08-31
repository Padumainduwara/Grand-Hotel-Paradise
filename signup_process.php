// signup_process.php
<?php
require 'connector.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $account_type = $_POST['account_type'];
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];

    if ($password !== $confirm_password) {
        header("Location: signup.php?error=1");
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO Users (username, password, account_type, full_name, email, phone_number, address) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $username, $password, $account_type, $full_name, $email, $phone_number, $address);
    $stmt->execute();
    header("Location: login.php");
}
?>
