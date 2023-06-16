<?php
include 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="node_modules/bootstrap/dist/css/bootstrap.css"
    />

    <title>Log in</title>
  </head>

  <body>
    <h1 class="text-center m-3 text-success">Log in</h1>
    <form action="index.php" method="POST">
      <div class="container">
        <div class="mb-3 row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
          <div class="col-sm-10">
            <input
              type="email"
              class="form-control"
              id="staticEmail"
              name="email"
              required
            />
          </div>
        </div>
        <div class="mb-3 row">
          <label for="inputPassword" class="col-sm-2 col-form-label"
            >Password</label
          >
          <div class="col-sm-10">
            <input
              type="password"
              class="form-control"
              id="inputPassword"
              name="password"
              required
            />
          </div>
        </div>
        <div class="justify-content-center d-flex">
          <button
            type="submit"
            class="btn btn-outline-primary justify-content-center"
          >
            Log in
          </button>
        </div>
      </div>
    </form>

    <p class="ms-5">Create account <a href="sample.php">here</a></p>

    <script src="node_modules\bootstrap\dist\js\bootstrap.bundle.js"></script>
  </body>
</html>
