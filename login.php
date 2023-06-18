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
      if ($password === $row['password'] && $email === $row['email']) {
        // Password is correct, redirect to index.php or the desired destination
        header("Location: index.php");
        exit;
      }
    }
  }
}
// Check if there are any errors and set the error message accordingly
if ($_SERVER['REQUEST_METHOD'] === 'POST' && (empty($emailErr) && empty($passwordErr))) {
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
  <style>
    .password-toggle {
      position: relative;
    }

    .password-toggle input[type="password"] {
      padding-right: 35px;
    }

    .password-toggle .toggle-icon {
      position: absolute;
      top: 50%;
      right: 10px;
      transform: translateY(-50%);
      cursor: pointer;
    }
  </style>
</head>

<body>
  <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="box p-4 col-4 shadow">
      <h1 class="text-center m-3 text-success">Log in</h1>
      <?php if (!empty($error)) : ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
      <?php endif; ?>

      <form action="" method="POST"> <!-- Update the form action to the current page -->
        <div class="form-floating mb-3">
          <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email" required>
          <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating mb-3 password-toggle">
          <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" required>
          <label for="floatingPassword">Password</label>
          <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="toggle-icon bi bi-eye-slash" viewBox="0 0 16 16">
            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
          </svg>
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
  <script>
    // Password view toggle
    const toggleIcon = document.querySelector('.toggle-icon');
    const passwordInput = document.querySelector('#floatingPassword');

    toggleIcon.addEventListener('click', function() {
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('bi-eye');
        toggleIcon.classList.add('bi-eye-slash');
      } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('bi-eye-slash');
        toggleIcon.classList.add('bi-eye');
      }
    });
  </script>
  <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
</body>

</html>