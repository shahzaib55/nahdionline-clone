<?php
//include headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT');
header("Access-Control-Allow-Headers: Content-Type, Authorization");

$servername = "mysqlsrv.dcs.bbk.ac.uk";
$username = "asaie01";
$password = "bbkmysql";
$database= "asaie01own";

 
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
 
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>

