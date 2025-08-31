<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>DBCON</title>
</head>

<body>
<?php

$host = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "ghp"; 


$conn = new mysqli($host, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$conn->set_charset("utf8");


?>

</body>
</html>