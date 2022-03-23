<?php
//include headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token");
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT,DELETE');
header("Access-Control-Allow-Headers: Content-Type, Authorization");

  
$servername = "remotemysql.com:3306";
$username = "z6wrFpPwtG";
$password = "9grwvrCf1m";
$database= "z6wrFpPwtG";



 
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
 
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>

