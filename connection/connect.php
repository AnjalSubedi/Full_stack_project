<?php
$servername = "localhost";
$username = "u873260560_ashish25";
$password = "Aloneathiest123!"; // Replace with your actual root password
$dbname = "u873260560_backend"; // Replace with your actual database name

// Create connection
$con = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} else {
    // echo "Database connected successfully.";
}
?>
