<?php

include 'connect.php';

if(isset($_GET['deleteid'])){
    $id=$_GET['deleteid'];
    $sql="DELETE FROM `practice` where id=$id";
    $result=mysqli_query($con,$sql);
    header('location:read.php');
    
}



?>