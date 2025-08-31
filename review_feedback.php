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

// Retrieve feedback data
$sql = "SELECT * FROM feedback";
$result = $conn->query($sql);
$feedbackData = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $feedbackData[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Review Feedback</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f5f5f5;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
        }

        .my-4 {
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .table {
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="my-4">Review Feedback</h1>

        <?php if (!empty($feedbackData)) : ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Feedback ID</th>
                    <th>Rating</th>
                    <th>Comments</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($feedbackData as $feedback) : ?>
                    <tr>
                        <td><?php echo $feedback['FeedbackID']; ?></td>
                        <td><?php echo $feedback['Rating']; ?></td>
                        <td><?php echo $feedback['Comments']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else : ?>
            <p>No feedback data available.</p>
        <?php endif; ?>
    </div>
</body>
</html>
