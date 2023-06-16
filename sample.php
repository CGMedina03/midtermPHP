<?php
include 'connect.php';

if (isset($_POST['submit'])) {

  $name = $_POST['name'];
  $email = $_POST['email'];
  $mobile = $_POST['mobile'];
  $password1 = $_POST['password'];

  $sql = "insert into `crud` (name,email,mobile,password)
        values('$name','$email','$mobile','$password1')";

  $result = mysqli_query($con, $sql);

  if ($result) {

    //  echo "Data inserted successfully";

    header('location:display.php');
  } else {

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
  <div class="container my-5"> <!--Container -->
    <form method="post"> <!--Form Method -->
      <div class="form-group">
        <label class="form-label">Name</label> <!--Form Name -->
        <input type="text" class="form-control" placeholder="Enter your name" name="name" autocomplete="off">
      </div>
      <div class="form-group">
        <label class="form-label">Email</label> <!--Form Email -->
        <input type="email" class="form-control" placeholder="Enter your email" name="email" autocomplete="off">
      </div>

      <div class="form-group">
        <label class="form-label">Mobile Number</label> <!--Form Number -->
        <input type="text" class="form-control" placeholder="Enter your Mobile Number" name="mobile" autocomplete="off">
      </div>

      <div class="form-group">
        <label class="form-label">Password</label> <!--Form Password -->
        <input type="password" class="form-control" placeholder="Enter your password" name="password" autocomplete="off">
      </div>



      <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>
  </div>


  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>