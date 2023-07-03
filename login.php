<?php
session_start();
include 'connect.php';

// Initialize error variables
$emailErr = $passwordErr = '';

if (isset($_POST['email']) && isset($_POST['password'])) {

  // Function to validate user input
  function validate($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  $email = validate($_POST['email']);
  $password = validate($_POST['password']);

  if (empty($email)) {
  } else if (empty($password)) {
  } else {
    $sql = "SELECT * FROM crud WHERE email='$email' AND password='$password'";

    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) === 1) {
      $row = mysqli_fetch_assoc($result);
      if ($row['email'] === $email && $row['password'] === $password) {
        // Store user data in session variables
        $_SESSION['email'] = $row['email'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['id'] = $row['id'];
        $_SESSION['mobile'] = $row['mobile'];
        $_SESSION['password'] = $row['password'];

        // Redirect to the index.php page
        header("Location: index.php");
        exit();
      }
    }
  }
}

// Check if there are any errors and set the error message accordingly
if ($_SERVER['REQUEST_METHOD'] === 'POST' && (empty($emailErr) && empty($passwordErr))) {
  // Set error message for invalid email or password
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
  <link rel="stylesheet" href="styles/style.css">
  <title>Log in</title>
</head>

<body>
  <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="box p-4 col-4 shadow">
      <h1 class="text-center m-3 text-success">Log in</h1>
      <?php if (!empty($error)) : ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
      <?php endif; ?>

      <form action="login.php" method="POST"> <!-- Update the form action to the current page -->
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
        <p>Create an account <a href="register.php" class="text-success">here!</a></p>
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