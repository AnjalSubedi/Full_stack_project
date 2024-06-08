<?php include'connect.php' ?>

<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
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
        background: #009FFF;
        background: -webkit-linear-gradient(to right, #ec2F4B, #009FFF); 
        background: linear-gradient(to right, #ec2F4B, #009FFF);
    }

    .container {
    }
    .btntop{
        width: 10%;
    }
    .btn:hover{
        text-decoration:underline;
    }
    .bold{
        font-weight:500;
    }
</style>

<body>
  <header>
    <!-- place navbar here -->
  </header>
  <main>
    <div class="container">

    <a name="" id="" class="btn btntop btn-primary my-5 " href="create.php

" role="button">Add New</a>

    <div class="table-responsive">
        <table class="table table-primary">
            <thead>
                <tr>
                    <th scope="col">S.No.</th>
                    <th scope="col">Name</th>
                    <th scope="col">Major</th>
                    <th scope="col">Roll No</th>
                    <th scope="col">Faculty</th>
                    <th scope="col">Remarks</th>
                    <th scope="col">Operations</th>
                </tr>
            </thead>
            
            <?php
            $sql="SELECT * FROM `practice`";
            $result=mysqli_query($con,$sql);
            if($result){
              $i=1;
                while($row=mysqli_fetch_assoc($result)){
                    $id=$row['id'];
                    $name=$row['Name'];
                    $major=$row['Major'];
                    $rollno=$row['RollNO'];
                    $faculty=$row['Faculty'];
                    $other=$row['Remarks'];
                    echo'<tbody>
                    <tr class="">
                    <td scope="row" class="bold">'.$i++.'</td>
                    <td>'.$name.'</td>
                    <td>'.$major.'</td>
                    <td>'.$rollno.'</td>
                    <td>'.$faculty.'</td>
                    <td>'.$other.'</td>
                    <td>
                    <a name="" id="" href="update.php?updateid='.$id.'" class="btn btn-primary">Update</a>
                    <a name="" id="" href="delete.php?deleteid='.$id.'" class="btn btn-danger">Delete</a>
                    </td>
                    </tr>
                    </tbody>';
            }}
            ?>
            
        </table>
    </div>

    </div>

  </main>
  <footer>
    <!-- place footer here -->
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>
