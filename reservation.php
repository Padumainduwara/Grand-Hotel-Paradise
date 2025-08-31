<?php
session_start();

require 'connector.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the user is logged in (has a valid session).
    if (isset($_SESSION['user_id'])) {
        // Get user_id from the session.
        $user_id = $_SESSION['user_id'];
		
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $reservation_date = isset($_POST['date']) ? $_POST['date'] : '';
        $reservation_time = isset($_POST['time']) ? $_POST['time'] : '';
        $party_size = isset($_POST['party_size']) ? $_POST['party_size'] : '';
        $services = isset($_POST['services']) ? $_POST['services'] : '';
        $swimming_pool = isset($_POST['swimming_pool']) ? 1 : 0;
        $package_id = isset($_POST['package_id']) ? $_POST['package_id'] : '';
        $special_requests = isset($_POST['special_requests']) ? $_POST['special_requests'] : '';

        $stmt = $conn->prepare("INSERT INTO reservations (user_id, name, email, reservation_date, reservation_time, party_size, services, swimming_pool, package_id, special_requests) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issisiisis", $user_id, $name, $email, $reservation_date, $reservation_time, $party_size, $services, $swimming_pool, $package_id, $special_requests);
        $stmt->execute();
		
		// Redirect to a success page after making a reservation.
        header("Location: reservation_suc.php");
    } else {
        // User is not logged in. Redirect to the login page.
        header("Location: login.php");
    }
}

$packages = [];
$query = "SELECT id, package_name FROM packages";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $packages[] = $row;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Make a Reservation</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #2b2b2b;
            color: #fff;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        .container {
            background-color: #2b2b2b;
            color: #fff;
            text-align: center;
            padding: 20px;
            border-radius: 5px;
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            background-color: #fff;
            color: #000;
            border: 1px solid #000;
            border-radius: 5px;
            padding: 10px;
        }

        .form-check-input {
            background-color: #fff;
            border: 1px solid #000;
            border-radius: 5px;
        }

        .form-check-label {
            color: #fff;
        }

        select.form-control {
            background-color: #fff;
            color: #000;
        }

        .btn-primary {
            background-color: #fff;
            color: #000;
            border: 2px solid #000;
            border-radius: 5px;
            text-transform: uppercase;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="mt-4">Make a Reservation</h2>
        <form method="POST" class="mt-4">
            <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="Name" required />
            </div>
            <div class="form-group">
                <input type="text" name="email" class="form-control" placeholder="Email" required />
            </div>
            <div class="form-group">
                <input type="date" name="date" class="form-control" required />
            </div>
            <div class="form-group">
                <input type="time" name="time" class="form-control" required />
            </div>
            <div class="form-group">
                <input type="number" name="party_size" class="form-control" placeholder="Party size" required />
            </div>
            <div class="form-group">
                <input type="text" name="services" class="form-control" placeholder="Services" required />
            </div>
            <div class="form-check">
                <input type="checkbox" id="swimming_pool" name="swimming_pool" class="form-check-input"/>
                <label class="form-check-label" for="swimming_pool">Swimming pool</label>
            </div>
            <div class="form-group">
                <label for="package_id">Package</label>
                <select name="package_id" class="form-control" required>
                    <?php foreach ($packages as $package) { ?>
                        <option value="<?php echo $package['id']; ?>"><?php echo $package['package_name']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <textarea name="special_requests" class="form-control" placeholder="Any special requests?" rows="4"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>

