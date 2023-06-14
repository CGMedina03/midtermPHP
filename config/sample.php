<?php
   include 'connect.php';

    if(isset($_POST['submit'])){

        $name=$_POST['name'];
        $email=$_POST['email'];
        $mobile=$_POST['mobile'];
        $password1=$_POST['password'];

        $sql="insert into `crud` (name,email,mobile,password)
        values('$name','$email','$mobile','$password1')";

        $result = mysqli_query($con,$sql);

        if($result){

          //  echo "Data inserted successfully";

          header('location:display.php');
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

   <!-- bootstrap css cdn -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <title>CRUD Operation</title>
  </head>
  <body>
        <div class = "container my-5"> <!--Container -->
        <form method = "post"> <!--Form Method -->
  <div class="form-group">
    <label  class="form-label">Name</label> <!--Form Name -->
    <input type="text" class="form-control" placeholder= "Enter your name" name="name" autocomplete="off" required>
</div>
<div class="form-group">
    <label  class="form-label">Email</label> <!--Form Email -->
    <input type="email" class="form-control" placeholder= "Enter your email" name="email" autocomplete="off" required >
</div>

<div class="form-group">
    <label class="form-label">Mobile Number</label>
    <input type="text" class="form-control" placeholder="Enter your Mobile Number" name="mobile" autocomplete="off" maxlength="11" minlength="11">
</div>

<div class="form-group">
    <label  class="form-label">Password</label> <!--Form Password -->
    <input type="password" class="form-control" placeholder= "Enter your password" name="password" autocomplete="off" required>
</div>
    
    
    
     <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>
    </div>

<!-- bootstrap js cdn -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>

  </body>
</html>