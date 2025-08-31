<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Please ensure to include the Bootstrap CSS for the below styling to work -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Package Info</title>
</head>
<body class="bg-dark text-white">
    <div class="container">
        <?php
            session_start();
            require 'connector.php';

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST['package_id'])) {
                    $_SESSION['selected_package_id'] = $_POST['package_id'];
                    header("Location: reservation.php");
                }
            }

            $sql = "SELECT * FROM packages"; 
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='card bg-secondary text-white mb-3 shadow-sm p-3'>";
                    echo "<h3 class='card-title'>" . $row["package_name"] ."</h3>";
                    echo "<p class='card-text'>" . $row["description"] ."</p>";
                    echo "<p class='card-text'>Price: " . $row["price"] ."</p>"; // Assuming the price field is named as "price"
                    echo "<form action='' method='post'>";
                    echo "<input type='hidden' name='package_id' value='" . $row["id"] . "'>";
                    echo "<button type='submit' class='btn btn-light'>Choose package</button>";
                    echo "</form>";
                    echo "</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>No packages found.</div>";
            }
            $conn->close();
        ?>
    </div>
</body>
</html>
