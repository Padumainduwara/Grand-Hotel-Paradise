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

// Retrieve reservations data
$sql = "SELECT * FROM reservations";
$result = $conn->query($sql);
$reservationsData = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $reservationsData[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Review Reservations</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #000;
            color: #fff;
        }

        .container {
            margin-top: 50px;
        }

        .table {
            background-color: #fff;
            color: #000;
        }

        th, td {
            text-align: center;
        }

        th {
            background-color: #000;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="my-4">Review Reservations</h1>

        <?php if (!empty($reservationsData)) : ?>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Reservation ID</th>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Reservation Date</th>
                    <th>Reservation Time</th>
                    <th>Party Size</th>
                    <th>Services</th>
                    <th>Swimming Pool</th>
                    <th>Package ID</th>
                    <th>Special Requests</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservationsData as $reservation) : ?>
                    <tr>
                        <td><?php echo $reservation['id']; ?></td>
                        <td><?php echo $reservation['user_id']; ?></td>
                        <td><?php echo $reservation['name']; ?></td>
                        <td><?php echo $reservation['email']; ?></td>
                        <td><?php echo $reservation['reservation_date']; ?></td>
                        <td><?php echo $reservation['reservation_time']; ?></td>
                        <td><?php echo $reservation['party_size']; ?></td>
                        <td><?php echo $reservation['services']; ?></td>
                        <td><?php echo $reservation['swimming_pool']; ?></td>
                        <td><?php echo $reservation['package_id']; ?></td>
                        <td><?php echo $reservation['special_requests']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else : ?>
            <p>No reservation data available.</p>
        <?php endif; ?>
    </div>
</body>
</html>
