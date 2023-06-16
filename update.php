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
</head>

<body>
    <div class="container my-5">
        <form method="post">
            <div class="form-group">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" placeholder="Enter your name" name="name" autocomplete="off" value="<?php echo $name; ?>">
                <?php if (isset($errors['name'])) echo '<p class="text-danger">' . $errors['name'] . '</p>'; ?>
            </div>
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" placeholder="Enter your email" name="email" autocomplete="off" value="<?php echo $email; ?>">
            </div>

            <div class="form-group">
                <label class="form-label">Mobile Number</label>
                <input type="text" class="form-control" placeholder="Enter your Mobile Number" name="mobile" autocomplete="off" value="<?php echo $mobile; ?>">
                <?php if (isset($errors['mobile'])) echo '<p class="text-danger">' . $errors['mobile'] . '</p>'; ?>
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" placeholder="Enter your password" name="password" autocomplete="off" value="<?php echo $password1; ?>">
                <?php if (isset($errors['password'])) echo '<p class="text-danger">' . $errors['password'] . '</p>'; ?>
            </div>

            <button type="submit" class="btn btn-primary" name="submit">Update</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>