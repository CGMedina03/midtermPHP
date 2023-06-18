<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "crudoperation";

$con = mysqli_connect($servername, $username, $password, $database);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
// Retrieve all existing records from the table
$query = "SELECT * FROM crud";
$result = mysqli_query($con, $query);

// Loop through each record
while ($row = mysqli_fetch_assoc($result)) {
    // Remove this loop and update code
}
