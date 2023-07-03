<?php
session_start();
include 'connect.php';

// Check if the user is logged in and is an admin
if (isset($_SESSION['email']) && $_SESSION['email'] === 'admin@gmail.com') {
  $isAdmin = true;
} else {
  $isAdmin = false;
}

// Retrieve data from the database
$sql = "SELECT * FROM `crud`";
$result = mysqli_query($con, $sql);

if ($result && mysqli_num_rows($result) > 1) {
  // Fetch the first row of data
  $row = mysqli_fetch_assoc($result);
  $name = $row['name'];
  $email = $row['email'];
  $mobile = $row['mobile'];
  $password = $row['password'];
  $id = $row['id'];
} else {
  // Handle the case when no data is available
  $name = "";
  $email = "";
  $mobile = "";
  $password = "";
  $id = "";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css" />
  <title>Profile</title>
</head>

<body>
  <div class="container-lg p-3">
    <h1 class="mt-3 text-success display-6 text-center fw-semibold">
      Greetings, <?php echo $_SESSION['name']; ?> #<?php echo $_SESSION['id']; ?>!
    </h1>
    <nav>
      <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-link active" id="nav-profile-tab" data-bs-toggle="tab" href="#userProfile" role="tab" aria-controls="userProfile" aria-selected="true">Profile</a>
        <a class="nav-link" id="nav-tabledata-tab" data-bs-toggle="tab" href="#tableData" role="tab" aria-controls="tableData" aria-selected="false">Table Data</a>
      </div>
    </nav>

    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active p-3" id="userProfile" role="tabpanel">
        <div class="d-flex flex-column">
          <?php if (!empty($_SESSION['name'])) : ?>
            <h3 class="fw-semibold text-muted py-3">Name: <?php echo $_SESSION['name']; ?></h3>
            <h5>Email: <?php echo $_SESSION['email']; ?></h5>
            <h5>Contact number: <?php echo $_SESSION['mobile']; ?></h5>
            <?php if ($isAdmin) : ?>
              <h5>Password: <?php echo $_SESSION['password']; ?></h5>
            <?php endif; ?>
          <?php else : ?>
            <p>No user profile found.</p>
          <?php endif; ?>
        </div>
        <button class="btn btn-success mt-5 me-3">
          <a href="update.php?updateid=<?php echo $_SESSION['id']; ?>" class="text-light text-decoration-none">Update</a>
        </button>
        <button type="submit" class="btn btn-success mt-5"><a href="login.php" class="text-decoration-none text-white">Log out</a></button>
      </div>
      <div class="tab-pane fade p-3" id="tableData" role="tabpanel">
        <div class="container">
          <?php if ($isAdmin) : ?>
            <button class="btn btn-success my-2"> <a href="addUser.php" class="text-light text-decoration-none">Add user</a></button>
          <?php endif; ?>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">ID no.</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Mobile</th>
                <?php if ($isAdmin) : ?>
                  <th scope="col">Password</th>
                  <th scope="col">Operation</th>
                <?php endif; ?>
              </tr>
            </thead>
            <tbody>
              <?php
              $sql = "SELECT * FROM `crud`";
              $result = mysqli_query($con, $sql);
              if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                  $row_id = $row['id'];
                  $row_name = $row['name'];
                  $row_email = $row['email'];
                  $row_mobile = $row['mobile'];
                  $row_password = $row['password'];

                  // Skip the row if it corresponds to the logged-in user or if it is an admin
                  if ((!$isAdmin && $row_email === $_SESSION['email']) || $row_email === 'admin@gmail.com') {
                    continue;
                  }

                  // Rest of the code to display the table row
                  echo '<tr>
                      <th scope="row">' . $row_id . '</th>
                      <td>' . $row_name . '</td>
                      <td>' . $row_email . '</td>
                      <td>' . $row_mobile . '</td>';
                  if ($isAdmin) {
                    echo '<td>' . $row_password . '</td>
                          <td><button class="btn btn-success"><a href="update.php?updateid=' . $row_id . '" class="text-light  text-decoration-none">Update</a></button>
                              <button class="btn btn-secondary"><a href="delete.php?deleteid=' . $row_id . '" class="text-light  text-decoration-none">Delete</a></button></td>';
                  }
                  echo '</tr>';
                }
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
  </div>
</body>

</html>