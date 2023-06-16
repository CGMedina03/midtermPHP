<?php
include 'connect.php';

$sql = "SELECT * FROM `crud`";
$result = mysqli_query($con, $sql);

if ($result && mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  $name = $row['name'];
  $email = $row['email'];
  $mobile = $row['mobile'];
  $password = $row['password'];
} else {
  // Handle the case when no data is available
  $name = "";
  $email = "";
  $mobile = "";
  $password = "";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="node_modules\bootstrap\dist\css\bootstrap.css" />
  <title>Profile</title>
</head>

<body>
  <div class="container-lg">
    <h1 class="mt-3 text-success display-6 text-center fw-semibold">
      Greetings, Christian Genesis #1!
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
          <h3>Profile</h3>
          <h3 class="fw-semibold text-muted">Name: <?php echo $name; ?></h3>
          <h5>Email: <?php echo $email; ?></h5>
          <h5>Contact number: <?php echo $mobile; ?></h5>
          <h5>Password: <?php echo $password; ?></h5>
        </div>
      </div>
    </div>
    <div class="tab-pane fade p-3" id="tableData" role="tabpanel">
      <h3>Table data</h3>
      <div class="container">
        <button class="btn btn-primary my-5"> <a href="sample.php" class="text-light">Add user </a>
        </button>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID no.</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Mobile</th>
              <th scope="col">Password</th>
              <th scope="col">Operation</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = "Select * from `crud`";
            $result = mysqli_query($con, $sql);
            if ($result) {
              while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $name = $row['name'];
                $email = $row['email'];
                $mobile = $row['mobile'];
                $password = $row['password'];

                echo '   <tr>
                <th scope="row">' . $id . '</th>
                <td>' . $name . '</td>
                <td>' . $email . '</td>
                <td>' . $mobile . '</td>
                <td>' . $password . '</td>
                <td>
                <button class="btn btn-primary"><a href="update.php? updateid=' . $id . '" class="text-light" >Update </a></button>
                <button class="btn btn-danger"><a href="delete.php? deleteid=' . $id . '" class="text-light">Delete </a></button>
                </td>
                </tr>';
              }
            }
            ?>
          </tbody>
        </table>
        </p>
      </div>
    </div>
  </div>

  <script src="node_modules\bootstrap\dist\js\bootstrap.bundle.js"></script>
  </div>
</body>

</html>