<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['account_type'] !== 'Customer') {
    header("Location: login.php");
    exit();
}

$customerName = $_SESSION['customer_name'];

// Replace with your database connection details.
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ghp";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$reservations = array();

if (!empty($_SESSION['user_id'])) {
    $sql = "SELECT r.id, r.reservation_date, r.reservation_time, r.party_size, r.services, r.swimming_pool, r.special_requests, r.package_id, u.username, u.email, u.phone_number
            FROM reservations r
            LEFT JOIN users u ON r.user_id = u.id
            WHERE r.user_id = " . $_SESSION['user_id'];
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $reservations[] = $row;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Customer Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #2b2b2b;
            color: #fff;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #333;
        }

        .navbar-brand {
            color: #fff;
            font-weight: bold;
        }

        .navbar-nav .nav-link {
            color: #fff;
        }

        .navbar-nav .nav-link:hover {
            color: #ddd;
        }
        .container {
            background-color: #2b2b2b;
            color: #fff;
            text-align: center;
            padding: 20px;
            border-radius: 5px;
            margin-top: 20px;
        }

        .table {
            background-color: #333;
            color: #fff;
        }

        .table th, .table td {
            border-color: #fff;
        }

        .btn {
            background-color: #fff;
            color: #000;
            font-weight: bold;
            border: 2px solid #000;
            border-radius: 5px;
            text-transform: uppercase;
        }

        .btn-danger {
            background-color: #fff;
            color: #000;
        }

        .btn-primary {
            background-color: #fff;
            color: #000;
        }
    </style>
</head>
<body>
	<nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="Index.html">Grand Hotel Paradise</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="package.php">Package <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Menu.html">Menu</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="reservation.php" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Services</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
                        <a class="dropdown-item" href="reservation.php">Private Event</a>
                        <a class="dropdown-item" href="reservation.php">Special Event</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="AboutUs.html">About Us</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <h1>Welcome, <?php echo $customerName; ?></h1>

        <h2>Your Reservations</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Reservation ID</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Party Size</th>
                    <th>Services</th>
                    <th>Swimming Pool</th>
                    <th>Special Requests</th>
                    <th>Package ID</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($reservations as $reservation) {
                    echo "<tr><td>" . $reservation['id'] . "</td><td>" . $reservation['reservation_date'] . "</td><td>" . $reservation['reservation_time'] . "</td><td>" . $reservation['party_size'] . "</td><td>" . $reservation['services'] . "</td><td>" . ($reservation['swimming_pool'] ? 'Yes' : 'No') . "</td><td>" . $reservation['special_requests'] . "</td><td>" . $reservation['package_id'] . "</td><td>" . $reservation['username'] . "</td><td>" . $reservation['email'] . "</td><td>" . $reservation['phone_number'] . "</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <div class="mt-4">
            <h2>Upgrade or Choose Package</h2>
            <form action="package.php" method="post">
                <?php
                $sql = "SELECT * FROM packages";
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<input type="radio" name="package" value="' . $row['package_name'] . '"> ' . $row['package_name'] . '<br>';
                    }
                }
                ?>
                <button type="submit" class="btn btn-primary">Make a Reservation</button>
            </form>
        </div>
        
		
		<form action="checkout.php" method="post">
            <button type="submit" class="btn btn-primary mt-4">Checkout</button>
        </form>
		
        <form action="logout.php" method="post">
            <button type="submit" class="btn btn-danger mt-4">Logout</button>
        </form>

        <form action="submit_feedback.php" method="post">
            <button type="submit" class="btn btn-primary mt-4">Submit Feedback</button>
        </form>
    </div>
</body>
</html>