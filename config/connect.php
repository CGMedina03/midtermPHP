<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "crudoperation";

$con = mysqli_connect($servername, $username, $password, $database);

if(!$con) {
  echo "Connection failed: " . mysqli_connect_error();
  die();
}
