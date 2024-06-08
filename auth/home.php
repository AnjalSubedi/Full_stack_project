<?php include'../connection/connect.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    body{
        background: #009FFF;  /* fallback for old browsers */
    background: -webkit-linear-gradient(to right, #ec2F4B, #009FFF);  /* Chrome 10-25, Safari 5.1-6 */
    background: linear-gradient(to right, #ec2F4B, #009FFF); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    }
    .container {
        text-align: center;
        height: 100vh;
        display: flex;
        align-items: center;
        flex-direction: column;
        justify-content: center;
    }

    /* .title{
        font-weight: bolder;
        font size
    } */
    .container form {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .container form input,
    textarea {
        margin: 10px;
        padding: 15px;
        display: block;
        width: 55em;
        border: 2px solid black;
        border-radius: 8px;
    }

    /* img {
        position: absolute;
        z-index: -1;
        width: 100%;
        height: 100%;
        opacity: 0.5;
    } */

    button {
        margin: 10px;
        padding: 7px;
        cursor: pointer;
        border: 2px solid black;
        border-radius: 5px;
    }

    .success{
        
        font-size: large;
        color: green;
        font-weight:bolder ;
    }
    .red{
        font-size: large;
        color: red;
        font-weight:bolder ;
    }
    .btn:hover{
        text-decoration:underline;
    }
</style>

<body>
    <div class="container">
        <!-- <img src="https://csit.pncampus.edu.np/wp-content/uploads/2022/10/s_1.jpg"> -->
        <h1 class="title"> Welcome to Form Submission</h1>
        <p>Enter your details and submit this form to confirm your participation. </p>

        <?php
            $insert=false;
            if(isset($_POST['submit'])){

                $name=$_POST['Name'];
                $major=$_POST['Class'];
                $rollno=$_POST['Roll_no'];
                $faculty=$_POST['Faculty'];
                $other=$_POST['remarks'];

                if($name!="" && $major!="" && $rollno!="" && $faculty!="" && $other!=""){
                    // Use prepared statements to prevent SQL injection
                    $query="INSERT INTO practice(Name,Major,RollNO,Faculty,Remarks,DateAndTime) VALUES(?, ?, ?, ?, ?, current_timestamp())";
                    $stmt = mysqli_prepare($con, $query);
                    mysqli_stmt_bind_param($stmt, 'ssiss', $name, $major, $rollno, $faculty, $other);

                    $result = mysqli_stmt_execute($stmt);
                    if($result){
                        $insert=true;
                    }

                    if ($insert==true){
                        // echo "<p class='success' >Your details has been succesfully submitted.</p>";
                        header('location:read.php');
                        exit;
                    }
                    mysqli_stmt_close($stmt);
                } else {
                    echo"<p class='red'>All fields are required.</p>";
                }
            }
        ?>
        <form action="#" method="post">
            <input type="text" name="Name" placeholder="Enter your Name:" required>
            <input type="text" name="Class" placeholder="Enter your Major:" required>
            <input type="number" name="Roll_no" placeholder="Enter your Roll number:" required>
            <input type="text" name="Faculty" placeholder="Enter your Faculty:" required>
            <textarea name="remarks" placeholder="Other / Remarks" rows="3" required></textarea>
            <button class="btn btn-primary" type="Submit" name="submit">Submit</button>
        </form>
    </div>
    
</body>

</html>
