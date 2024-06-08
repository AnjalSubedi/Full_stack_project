<?php
session_start();
include '../connection/connect.php';

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Insert the new visit record with the current date and time
$visit_date = date('Y-m-d');
$visit_time = date('H:i:s');

// Use prepared statements to prevent SQL injection
$insert_query = "INSERT INTO visits (customer_id, visit_date, visit_time) VALUES (?, ?, ?)";
$stmt = mysqli_prepare($con, $insert_query);
mysqli_stmt_bind_param($stmt, 'sss', $user_id, $visit_date, $visit_time);
$insert_result = mysqli_stmt_execute($stmt);

if (!$insert_result) {
    die("Error inserting visit: " . mysqli_error($con));
}
mysqli_stmt_close($stmt);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Visits</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <style>
        body {
            background: linear-gradient(to right, #ec2F4B, #009FFF);
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }
        .container {
            text-align: center;
            max-width: 600px;
            margin-top: 100px;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            flex-grow: 1;
            overflow-y: auto;
        }
        .table {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Ashish25</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/index.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1 class="title">Your Visits</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Retrieve all visits for the logged-in user
                $query = "SELECT * FROM visits WHERE customer_id = ? ORDER BY visit_date DESC, visit_time DESC";
                $stmt = mysqli_prepare($con, $query);
                mysqli_stmt_bind_param($stmt, 's', $user_id);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if (!$result) {
                    die("Error retrieving visits: " . mysqli_error($con));
                }

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . date('Y-m-d', strtotime($row['visit_date'])) . "</td>";
                        echo "<td>" . date('H:i:s', strtotime($row['visit_time'])) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>No visits found</td></tr>";
                }

                mysqli_stmt_close($stmt);
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-kaX9pThEFpO91TAqg8T3v8Ez7ViQ5tFi3ixQpF9N5+Rjz5INt7PCzBk2KQX1+La8" crossorigin="anonymous"></script>
</body>
</html>