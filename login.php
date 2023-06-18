<?php
include 'connect.php';

// Initialize error variables
$emailErr = $passwordErr = '';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Check if the email and password fields are set
  if (isset($_POST['email'], $_POST['password'])) {
    // Retrieve the user input
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Perform the database query to check if the input matches the database record
    $query = "SELECT * FROM crud WHERE email = '$email'";
    $result = mysqli_query($con, $query);

    // Check if a matching record is found in the database
    if (mysqli_num_rows($result) > 0) {
      // Fetch the user record from the database
      $row = mysqli_fetch_assoc($result);

      // Verify the entered password with the stored hashed password
      if (password_verify($password, $row['password'])) {
        // Password is correct, redirect to index.php or the desired destination
        header("Location: index.php");
        exit;
      } else {
        $passwordErr = "Invalid password. Please try again.";
      }
    } else {
      $emailErr = "Invalid email. Please try again.";
    }
  } else {
    echo "Invalid form submission.";
  }
}

// Display error message if email or password is invalid and the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && (!empty($emailErr) || !empty($passwordErr))) {
  $error = "Invalid email or password. Please try again.";
} else {
  $error = ''; // Clear the error message
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css" />

  <title>Log in</title>
</head>

<body>
  <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="box p-4 col-4 shadow">
      <h1 class="text-center m-3 text-success">Log in</h1>
      <?php if (!empty($error)) { ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
      <?php } ?>

      <form action="" method="POST"> <!-- Update the form action to the current page -->
        <div class="form-floating mb-3">
          <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email" required>
          <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating mb-3">
          <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" required>
          <label for="floatingPassword">Password</label>
        </div>
        <div class="d-grid gap-2">
          <button type="submit" class="btn btn-success" name="submit">
            Log in
          </button>
        </div>
      </form>
      <div class="text-center mt-3">
        <p>Create an account <a href="sample.php" class="text-success">here</a></p>
      </div>
    </div>
  </div>

  <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
</body>

</html>