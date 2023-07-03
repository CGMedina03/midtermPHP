<?php
session_start();
include 'connect.php';
$id = $_GET['updateid'];
$sql = "SELECT * FROM `crud` WHERE id=$id";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$name = $row['name'];
$email = $row['email'];
$mobile = $row['mobile'];
$password1 = $row['password'];
$errors = array(); // Array to store validation errors
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    // Validate Name: Should not contain special symbols or numbers
    if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
        $errors['name'] = "Name should only contain letters and spaces.";
    }
    // Validate Mobile Number: Should be 11 digits starting from 09
    if (!preg_match('/^09\d{9}$/', $mobile)) {
        $errors['mobile'] = "Mobile number should be 11 digits starting from 09.";
    }
    // Validate Password: Should have at least 12 characters
    if (strlen($password) < 12) {
        $errors['password'] = "Password should have at least 12 characters.";
    }
    // Check if there are any validation errors
    if (count($errors) === 0) {
        // All inputs are valid, proceed with the update operation
        $sql = "UPDATE `crud` SET name='$name', email='$email', mobile='$mobile', password='$password' WHERE id=$id";
        $result = mysqli_query($con, $sql);
        if ($result) {
            // Check if the updated user is the admin
            if ($id == $_SESSION['id']) {
                // Update the admin's session variables
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                $_SESSION['mobile'] = $mobile;
                $_SESSION['password'] = $password;
            }
            // Redirect back to the profile page
            header('location: index.php');
            exit; // Stop further processing
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
    <title>CRUD Operation</title>
    <style>
        .password-toggle-icon {
            position: absolute;
            right: 10px;
            top: calc(50% - 7.5px);
            cursor: pointer;
            fill: currentColor;
        }
    </style>
</head>

<body>
    <div class="container my-5 col-sm-9 col-lg-6">
        <form method="post">
            <div class="form-group mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" placeholder="Enter your name" name="name" autocomplete="off" value="<?php echo $name; ?>">
                <?php if (isset($errors['name'])) echo '<p class="text-danger">' . $errors['name'] . '</p>'; ?>
            </div>
            <div class="form-group mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" placeholder="Enter your email" name="email" autocomplete="off" value="<?php echo $email; ?>">
            </div>
            <div class="form-group mb-3">
                <label class="form-label">Mobile Number</label>
                <input type="text" class="form-control" placeholder="Enter your Mobile Number" name="mobile" autocomplete="off" value="<?php echo $mobile; ?>">
                <?php if (isset($errors['mobile'])) echo '<p class="text-danger">' . $errors['mobile'] . '</p>'; ?>
            </div>
            <div class="form-group mb-3">
                <label class="form-label">Password</label>
                <div class="position-relative">
                    <input type="password" id="password" class="form-control" placeholder="Enter your password" name="password" autocomplete="off" value="<?php echo $password1; ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="password-toggle-icon bi bi-eye-slash" onclick="togglePasswordVisibility()" viewBox="0 0 16 16">
                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                    </svg>
                </div>
                <?php if (isset($errors['password'])) echo '<p class="text-danger">' . $errors['password'] . '</p>'; ?>
            </div>
            <div class="d-flex justify-content-end align-items-center mt-5">
                <button type="button" class="btn btn-secondary btn-sm me-3"><a href="index.php" class="text-white text-decoration-none">Cancel</a></button>
                <button type="submit" class="btn btn-success " name="submit">Update</button>
            </div>
        </form>
    </div>
    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById("password");
            const toggleIcon = document.querySelector(".password-toggle-icon");
            if (passwordInput.type === "password") {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('bi-eye');
                toggleIcon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('bi-eye-slash');
                toggleIcon.classList.add('bi-eye');
            }
        }
    </script>
    <script src="node_modules\bootstrap\dist\js\bootstrap.bundle.js"></script>
</body>

</html>