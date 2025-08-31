# Grand Hotel Paradise - Hotel Management System

This is a web-based application for managing the "Grand Hotel Paradise." It provides a platform for customers to book rooms and for the hotel staff and administration to manage reservations, packages, and user feedback.

## Features

* **User Authentication:** Separate login and registration systems for customers, staff, and administrators.
* **Role-Based Dashboards:**
    * **Customer Dashboard:** Allows customers to view their booking history, manage their profile, and submit feedback.
    * **Staff Dashboard:** Provides staff with tools to view and manage reservations.
    * **Admin Dashboard:** A comprehensive panel for administrators to oversee all operations, including managing room packages, reviewing reservations, and viewing customer feedback.
* **Room Reservation:** An easy-to-use interface for customers to check room availability and make reservations.
* **Package Management:** Administrators can add, edit, and delete various hotel packages.
* **Feedback System:** Customers can submit reviews and feedback about their stay.

## Technologies Used

* **Frontend:**
    * HTML
    * CSS
    * JavaScript
    * [Bootstrap 4](https://getbootstrap.com/docs/4.4/getting-started/introduction/)
    * [jQuery](https://jquery.com/)
* **Backend:**
    * PHP
* **Database:**
    * MySQL

## Getting Started

To get a local copy up and running, follow these simple steps.

### Prerequisites

You will need a local web server environment that supports PHP and MySQL. We recommend using one of the following:
* [XAMPP](https://www.apachefriends.org/index.html)
* [WAMP](https://www.wampserver.com/en/)
* [MAMP](https://www.mamp.info/en/mamp/)

### Installation

1.  **Clone the repo**
    ```sh
    git clone [https://github.com/your_username/Grand-Hotel-Paradise.git](https://github.com/your_username/Grand-Hotel-Paradise.git)
    ```
2.  **Move the project folder** into your web server's root directory.
    * For **XAMPP**, this is typically the `htdocs` folder (`C:\xampp\htdocs`).

3.  **Database Setup**
    * Start the Apache and MySQL services from your server's control panel.
    * Open your web browser and navigate to `http://localhost/phpmyadmin/`.
    * Create a new database for the project (e.g., `grand_hotel`).
    * Since a `.sql` file is not provided, you will need to create the necessary tables manually based on the PHP code. Key tables would likely include `users`, `reservations`, `packages`, and `feedback`.

4.  **Configure Database Connection**
    * Open the `connector.php` file in a code editor.
    * Update the database connection variables (`$servername`, `$username`, `$password`, `$dbname`) to match your local setup.
    ```php
    <?php
    $servername = "localhost";
    $username = "root";       // Your database username
    $password = "";           // Your database password
    $dbname = "grand_hotel";  // The name of the database you created

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    ?>
    ```

## Usage

1.  Open your web browser and navigate to `http://localhost/Grand-Hotel-Paradise/` (or the name of your project folder).
2.  You can now use the website to register, log in, and access the different user dashboards.

## Contributing

Contributions are what make the open-source community such an amazing place to learn, inspire, and create. Any contributions you make are **greatly appreciated**.

1.  Fork the Project
2.  Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3.  Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4.  Push to the Branch (`git push origin feature/AmazingFeature`)
5.  Open a Pull Request

## License

Distributed under the MIT License. See `LICENSE` for more information.
