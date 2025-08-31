<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ghp";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// CRUD operations
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["action"])) {
        $action = $_POST["action"];
        switch ($action) {
            case "create":
                // Create a new package
                $name = $_POST["name"];
                $description = $_POST["description"];
                $price = $_POST["price"];
                $sql = "INSERT INTO packages (package_name, description, price) VALUES ('$name', '$description', '$price')";
                if ($conn->query($sql) === TRUE) {
                    echo "Package created successfully!";
                } else {
                    echo "Error: " . $conn->error;
                }
                break;
            case "update":
                // Update an existing package
                $id = $_POST["id"];
                $name = $_POST["name"];
                $description = $_POST["description"];
                $price = $_POST["price"];
                $sql = "UPDATE packages SET package_name = '$name', description = '$description', price = '$price' WHERE id = $id";
                if ($conn->query($sql) === TRUE) {
                    echo "Package updated successfully!";
                } else {
                    echo "Error: " . $conn->error;
                }
                break;
            case "delete":
                // Delete a package
                $id = $_POST["id"];
                $sql = "DELETE FROM packages WHERE id = $id";
                if ($conn->query($sql) === TRUE) {
                    echo "Package deleted successfully!";
                } else {
                    echo "Error: " . $conn->error;
                }
                break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Packages</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="my-4">Edit Packages</h1>

        <!-- Create Package Form -->
        <div class="card my-3">
            <div class="card-header">Create New Package</div>
            <div class="card-body">
                <form method="post">
                    <input type="hidden" name="action" value="create">
                    <div class="form-group">
                        <label for="name">Package Name:</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" name="description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="number" class="form-control" name="price" step="0.01" required>
                    </div>
                    <button type="submit" class="btn btn-success">Create Package</button>
                </form>
            </div>
        </div>

        <!-- Update Package Form -->
        <div class="card my-3">
            <div class="card-header">Update Package</div>
            <div class="card-body">
                <form method="post">
                    <input type="hidden" name="action" value="update">
                    <div class="form-group">
                        <label for="id">Package ID:</label>
                        <input type="number" class="form-control" name="id" required>
                    </div>
                    <div class="form-group">
                        <label for="name">New Package Name:</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="description">New Description:</label>
                        <textarea class="form-control" name="description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">New Price:</label>
                        <input type="number" class="form-control" name="price" step="0.01" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Package</button>
                </form>
            </div>
        </div>

        <!-- Delete Package Form -->
        <div class="card my-3">
            <div class="card-header">Delete Package</div>
            <div class="card-body">
                <form method="post">
                    <input type="hidden" name="action" value="delete">
                    <div class="form-group">
                        <label for="id">Package ID to Delete:</label>
                        <input type="number" class="form-control" name="id" required>
                    </div>
                    <button type="submit" class="btn btn-danger">Delete Package</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
