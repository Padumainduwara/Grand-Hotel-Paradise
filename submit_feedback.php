<?php
// Include your database connection code (e.g., require 'connector.php');
require_once('connector.php');
session_start(); // Start the session

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['feedback']) && isset($_POST['rating'])) {
            $feedback = $_POST['feedback'];
            $rating = $_POST['rating'];

            // Insert the feedback and rating into the feedback table
            $insertFeedbackQuery = "INSERT INTO feedback (user_id, comments, rating) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($insertFeedbackQuery);

            if ($stmt === false) {
                die("Error preparing SQL query: " . $conn->error);
            }

            $stmt->bind_param("iss", $user_id, $feedback, $rating);

            if ($stmt->execute()) {
                // Feedback submitted successfully, now redirect to customerdashboard
                header("Location: customerdashboard.php");
                exit();
            } else {
                echo "Error executing SQL query: " . $stmt->error;
            }
        }
    }
} else {
    // Redirect to the login page if the user is not logged in
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Submit Feedback</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            background-color: #000;
            color: #fff;
        }

        .container {
            margin-top: 50px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .star-rating {
            font-size: 24px;
        }

        .checked {
            color: gold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Submit Feedback</h1>
        <form method="POST" action="submit_feedback.php">
            <div class="form-group">
                <label for="feedback">Your Feedback:</label>
                <textarea name="feedback" id="feedback" rows="4" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label for="rating">Rating:</label><br>
                <div class="star-rating">
                    <span class="fa fa-star" id="star1" onclick="rate(1)"></span>
                    <span class="fa fa-star" id="star2" onclick="rate(2)"></span>
                    <span class="fa fa-star" id="star3" onclick="rate(3)"></span>
                    <span class="fa fa-star" id="star4" onclick="rate(4)"></span>
                    <span class="fa fa-star" id="star5" onclick="rate(5)"></span>
                </div>
                <input type="hidden" name="rating" id="rating" value="0">
            </div>

            <button type="submit" class="btn btn-light btn-block">Submit Feedback</button>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/js/all.min.js"></script>
    <script>
        let currentRating = 0;

        function rate(star) {
            currentRating = star;
            for (let i = 1; i <= 5; i++) {
                const starIcon = document.getElementById(`star${i}`);
                if (i <= star) {
                    starIcon.classList.add("checked");
                } else {
                    starIcon.classList.remove("checked");
                }
            }
            document.getElementById('rating').value = star;
        }
    </script>
</body>
</html>
