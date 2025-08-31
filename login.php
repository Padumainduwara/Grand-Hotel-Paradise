<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Grand Hotel Paradise</title>
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
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

       

        .footer {
            background-color: #333;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }

        .login-form {
            text-align: left;
            width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #333;
            border-radius: 5px;
        }

        .login-form label {
            color: #fff;
        }

        .login-form input[type="text"],
        .login-form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #000;
            border-radius: 5px;
        }

        .login-form button[type="submit"] {
            background-color: #fff;
            color: #000;
            padding: 20px 20px;
            text-transform: uppercase;
            font-weight: bold;
            border: thick;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
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
        
        <div class="login-form">
            <form method="POST" action="login_process.php">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">Log In</button>
            </form>
			<form method="POST" action="signup.php">
            <button type="submit">Create an Account</button>
        </form>
        </div>
        
    </div>

    <div class="menu-container">
        <!-- Your menu items go here -->
    </div>

    <div class="footer">
        &copy; 2023 Grand Hotel Paradise. All rights reserved.
    </div>
</body>
</html>
