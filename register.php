<?php
include 'connect.php';
$nameError = $emailError = $mobileError = $passwordError = '';
$name = $email = $mobile = $password = '';
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
      header('location: login.php');
      exit; // Stop further execution
    } else {
      die(mysqli_error($con));
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">
  <title>Register</title>
</head>

<body>
  <div class="container my-5 col-sm-9 col-lg-5">
    <h1 class="text-center text-success">User Register</h1>
    <form method="POST">
      <div class="form-group mb-3">
        <label class="form-label">Name</label>
        <input type="text" class="form-control " placeholder="Enter your name" name="name" autocomplete="off" value="<?php echo htmlspecialchars($name); ?>">
        <?php if (!empty($nameError)) : ?>
          <span class="text-danger"><?php echo $nameError; ?></span>
        <?php endif; ?>
      </div>
      <div class="form-group mb-3">
        <label class="form-label">Email</label>
        <input type="email" class="form-control " placeholder="Enter your email" name="email" autocomplete="off" value="<?php echo htmlspecialchars($email); ?>">
        <?php if (!empty($emailError)) : ?>
          <span class="text-danger"><?php echo $emailError; ?></span>
        <?php endif; ?>
      </div>
      <div class="form-group mb-3">
        <label class="form-label">Mobile Number</label>
        <input type="text" class="form-control " placeholder="Enter your Mobile Number" name="mobile" autocomplete="off" value="<?php echo htmlspecialchars($mobile); ?>">
        <?php if (!empty($mobileError)) : ?>
          <span class="text-danger"><?php echo $mobileError; ?></span>
        <?php endif; ?>
      </div>
      <div class="form-group mb-3">
        <label class="form-label">Password</label>
        <div class="input-group">
          <input type="password" class="form-control" placeholder="Enter your password" name="password" id="passwordInput" value="<?php echo htmlspecialchars($password); ?>">
          <div class="input-group-text">
            <span class="toggle-icon" onclick="togglePasswordVisibility()">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16">
                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
              </svg>
            </span>
          </div>
        </div>
        <?php if (!empty($passwordError)) : ?>
          <span class="text-danger"><?php echo $passwordError; ?></span>
        <?php endif; ?>
      </div>
      <div class="d-flex justify-content-end align-items-center ">
        <button type="button" class="btn btn-secondary btn-sm m-3" onclick="goBack()">Cancel</button>
        <button type="submit" class="btn btn-success " name="submit">Submit</button>
      </div>
    </form>
  </div>
  <script src="node_modules\bootstrap\dist\js\bootstrap.bundle.js"></script>
  <script>
    function togglePasswordVisibility() {
      var passwordInput = document.getElementById("passwordInput");
      passwordInput.type = passwordInput.type === "password" ? "text" : "password";
    }

    function goBack() {
      window.history.back();
    }
  </script>
</body>

</html>