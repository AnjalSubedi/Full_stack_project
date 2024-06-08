<?php include '../connection/connect.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <style>
        body {
            background: #009FFF;
            background: -webkit-linear-gradient(to right, #ec2F4B, #009FFF);
            background: linear-gradient(to right, #ec2F4B, #009FFF);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            margin: 0;
        }
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }
        .form-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        .form-container input,
        .form-container textarea {
            margin: 10px 0;
            padding: 15px;
            width: 100%;
            border: 2px solid black;
            border-radius: 8px;
        }
        .form-container button {
            margin: 10px 0;
            padding: 10px;
            cursor: pointer;
            border: 2px solid black;
            border-radius: 5px;
        }
        .success {
            font-size: large;
            color: green;
            font-weight: bolder;
        }
        .red {
            font-size: large;
            color: red;
            font-weight: bolder;
        }
        .btn:hover {
            text-decoration: underline;
        }
    </style>
    <script>
        function validateForm() {
            var phoneField = document.forms["form"]["Phone_no"].value;
            var errorMessage = document.getElementById("error-message");

            if (isNaN(phoneField)) {
                errorMessage.innerHTML = "Phone number must contain only digits.";
                return false;
            }
            if (phoneField.length != 10) {
                errorMessage.innerHTML = "Phone number must be exactly 10 digits.";
                return false;
            }
            return true;
        }
    </script>
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
                </ul>
            </div>
        </div>
    </nav>

    <div class="container d-flex justify-content-center align-items-center h-100">
        <div class="form-container">
            <h1 class="title">Sign up</h1>
            <p>Create your account</p>
            <p id="error-message" class="red"></p>

            <?php
                $insert = false;
                if (isset($_POST['submit'])) {
                    $name = $_POST['Name'];
                    $phoneno = $_POST['Phone_no'];
                    $password = $_POST['Password'];

                    if ($name != "" && $password != "" && $phoneno != "") {
                        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                        
                        // Use prepared statements to prevent SQL injection
                        $query = "INSERT INTO customer_details (name, phone_number, password) VALUES (?, ?, ?)";
                        $stmt = mysqli_prepare($con, $query);
                        mysqli_stmt_bind_param($stmt, 'sss', $name, $phoneno, $passwordHash);
                        $result = mysqli_stmt_execute($stmt);

                        if ($result) {
                            $insert = true;
                        }

                        if ($insert == true) {
                            echo "<p class='success'>Your details have been successfully submitted.</p>";
                            header('location:login.php');
                        }
                        
                        mysqli_stmt_close($stmt);
                    } else {
                        echo "<p class='red'>All fields are required.</p>";
                    }
                }
            ?>
            <form name="form" action="#" method="post" onsubmit="return validateForm()">
                <input type="text" name="Name" placeholder="Enter your Name:" required>
                <input type="text" name="Phone_no" placeholder="Enter your Phone Number:" maxlength="10" required>
                <input type="password" name="Password" placeholder="Enter your Password:" required>
                <button class="btn btn-primary" type="submit" name="submit">Submit</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-kaX9pThEFpO91TAqg8T3v8Ez7ViQ5tFi3ixQpF9N5+Rjz5INt7PCzBk2KQX1+La8" crossorigin="anonymous"></script>
</body>

</html>
