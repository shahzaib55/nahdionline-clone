<?php
//include headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT');
header("Access-Control-Allow-Headers: Content-Type, Authorization");

$servername = "databases.000webhost.com";
$username = "id18414943_root";
$password = "Database123@";
$database= "id18414943_beautiproducts";

 
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
 
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>

