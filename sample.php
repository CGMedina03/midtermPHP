<?php
include 'connect.php';

$nameError = $emailError = $mobileError = $passwordError = '';

$name = $email = $mobile = $password = ''; // Initialize variables

if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $mobile = $_POST['mobile'];
  $password = $_POST['password'];

  // Validate Name: Should not contain special symbols or numbers
  if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
    $nameError = "Name should only contain letters and spaces.";
  }

  // Validate Email: Use PHP filter_var function
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $emailError = "Invalid email format.";
  }

  // Validate Mobile Number: Should be 11 digits starting from 09
  if (!preg_match('/^09\d{9}$/', $mobile)) {
    $mobileError = "Mobile number should be 11 digits starting from 09.";
  }

  // Validate Password: Should have at least 12 characters
  if (strlen($password) < 12) {
    $passwordError = "Password should have at least 12 characters.";
  }

  // If there are no validation errors, proceed with the insert operation
  if (empty($nameError) && empty($emailError) && empty($mobileError) && empty($passwordError)) {
    $sql = "INSERT INTO `crud` (name, email, mobile, password) VALUES ('$name', '$email', '$mobile', '$password')";
    $result = mysqli_query($con, $sql);

    if ($result) {
      header('location:index.php');
      exit; // Stop further execution
    } else {
      die(mysqli_error($con));
    }
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
  <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">

  <title>CRUD Operation</title>
</head>

<body>
  <div class="container my-5">
    <form method="post">
      <div class="form-group">
        <label class="form-label">Name</label>
        <input type="text" class="form-control" placeholder="Enter your name" name="name" autocomplete="off" value="<?php echo htmlspecialchars($name); ?>">
        <?php if (!empty($nameError)) : ?>
          <span class="text-danger"><?php echo $nameError; ?></span>
        <?php endif; ?>
      </div>
      <div class="form-group">
        <label class="form-label">Email</label>
        <input type="email" class="form-control" placeholder="Enter your email" name="email" autocomplete="off" value="<?php echo htmlspecialchars($email); ?>">
        <?php if (!empty($emailError)) : ?>
          <span class="text-danger"><?php echo $emailError; ?></span>
        <?php endif; ?>
      </div>
      <div class="form-group">
        <label class="form-label">Mobile Number</label>
        <input type="text" class="form-control" placeholder="Enter your Mobile Number" name="mobile" autocomplete="off" value="<?php echo htmlspecialchars($mobile); ?>">
        <?php if (!empty($mobileError)) : ?>
          <span class="text-danger"><?php echo $mobileError; ?></span>
        <?php endif; ?>
      </div>
      <div class="form-group">
        <label class="form-label">Password</label>
        <input type="password" class="form-control" placeholder="Enter your password" name="password" autocomplete="off">
        <?php if (!empty($passwordError)) : ?>
          <span class="text-danger"><?php echo $passwordError; ?></span>
        <?php endif; ?>
      </div>
      <button type="submit" class="btn btn-primary mt-3" name="submit">Submit</button>
    </form>
  </div>

  <script src="node_modules\bootstrap\dist\js\bootstrap.bundle.js"></script>
</body>

</html>