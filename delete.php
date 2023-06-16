<?php
 $servername = "localhost";
 $username="root";
 $password="";
 $database="crudoperation";
 
 $con = mysqli_connect($servername,$username,$password,$database);

 if(isset($_GET['deleteid'])){

    $id=$_GET['deleteid'];

    $sql="delete from `crud` where id=$id";

    $result=mysqli_query($con,$sql);

    if($result){
       // echo "Deleted Successfully!";

       header('location:display.php');

    }
    else{
        die(mysqli_error($con));

    }

 }

 ?>