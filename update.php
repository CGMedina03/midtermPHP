<?php
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
            header('location:index.php#tabledata');
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
                    <svg class="password-toggle-icon" onclick="togglePasswordVisibility()" xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24">
                        <path d="M12 19.7c-2.9 0-5.7-1.1-7.9-3.3a11 11 0 0 1 0-16.4C6.3 1.4 9.1.3 12 .3s5.7 1.1 7.9 3.3A11 11 0 0 1 12 19.7zM12 2.1C9.1 3.6 4.9 7.7 2 12c2.9 4.3 7.1 8.4 10 9.9 2.9-1.6 7.1-5.7 10-9.9-2.9-4.3-7.1-8.4-10-9.9zm0 15.8c-3.4-2.6-7-6.4-9.4-10C4 5.7 7.6 3.9 12 3.9s8 1.8 9.4 4c-2.4 3.6-6 7.4-9.4 10z" />
                    </svg>
                </div>
                <?php if (isset($errors['password'])) echo '<p class="text-danger">' . $errors['password'] . '</p>'; ?>
            </div>
            <div class="d-flex justify-content-around align-items-center mt-3">
                <button type="button" class="btn btn-secondary btn-sm"><a href="index.php" class="text-white text-decoration-none">Cancel</a></button>
                <button type="submit" class="btn btn-success " name="submit">Update</button>
            </div>
        </form>
    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById("password");
            const toggleIcon = document.querySelector(".password-toggle-icon");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleIcon.innerHTML = `<path d="M12 19.7c-2.9 0-5.7-1.1-7.9-3.3a11 11 0 0 1 0-16.4C6.3 1.4 9.1.3 12 .3s5.7 1.1 7.9 3.3A11 11 0 0 1 12 19.7zM12 2.1C9.1 3.6 4.9 7.7 2 12c2.9 4.3 7.1 8.4 10 9.9 2.9-1.6 7.1-5.7 10-9.9-2.9-4.3-7.1-8.4-10-9.9zm0 15.8c-3.4-2.6-7-6.4-9.4-10C4 5.7 7.6 3.9 12 3.9s8 1.8 9.4 4c-2.4 3.6-6 7.4-9.4 10z" />`;
            } else {
                passwordInput.type = "password";
                toggleIcon.innerHTML = `<path d="M12 7.3a4.7 4.7 0 1 0 0 9.4 4.7 4.7 0 0 0 0-9.4zm0 7.1a2.4 2.4 0 1 1 0-4.8 2.4 2.4 0 0 1 0 4.8zM12 3.5a9.4 9.4 0 1 0 0 18.8 9.4 9.4 0 0 0 0-18.8zm0 16.3A6.9 6.9 0 1 1 12 3.9a6.9 6.9 0 0 1 0 13.9z" />`;
            }
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>