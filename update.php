<?php
    $servername = "localhost";
    $username="root";
    $password="";
    $database="crudoperation";
    
    $con = mysqli_connect($servername,$username,$password,$database);

        $id=$_GET['updateid'];
        $sql="Select * from `crud` where id=$id";
        $result=mysqli_query($con,$sql);
        $row=mysqli_fetch_assoc($result);
        $name=$row['name'];
        $email=$row['email'];
        $mobile=$row['mobile'];
        $password1=$row['password'];

    if(isset($_POST['submit'])){

        $name=$_POST['name'];
        $email=$_POST['email'];
        $mobile=$_POST['mobile'];
        $password1=$_POST['password'];

        $sql="update `crud` set id='$id',name='$name',email='$email',mobile='$mobile',
        password='$password1' where id=$id";
       

        $result = mysqli_query($con,$sql);

        if($result){

           echo "Updated Successfuly!";

         
        }
        else{

            die(mysqli_error($con));
        }


    }
   
    

?>

  

<!doctype html>

<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">

    <title>CRUD Operation</title>
  </head>
  <body>
        <div class = "container my-5"> <!--Container -->
        <form method = "post"> <!--Form Method -->
  <div class="form-group">
    <label  class="form-label">Name</label> <!--Form Name -->
    <input type="text" class="form-control" placeholder= "Enter your name" name="name" autocomplete="off" 
    value=<?php echo $name;?>>
</div>
<div class="form-group">
    <label  class="form-label">Email</label> <!--Form Email -->
    <input type="email" class="form-control" placeholder= "Enter your email" name="email" autocomplete="off"
    value=<?php echo $email;?>>
</div>

<div class="form-group">
    <label  class="form-label">Mobile Number</label> <!--Form Number -->
    <input type="text" class="form-control" placeholder= "Enter your Mobile Number" name="mobile" autocomplete="off"
    value=<?php echo $mobile;?>>
</div>

<div class="form-group">
    <label  class="form-label">Password</label> <!--Form Password -->
    <input type="password" class="form-control" placeholder= "Enter your password" name="password" autocomplete="off"
    value=<?php echo $password1;?>>
</div>
    
    
    
     <button type="submit" class="btn btn-primary" name="submit">Update</button>
    </form>
    </div>

   
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>