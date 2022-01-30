<?php
require_once '../config/database.php';
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header("Access-Control-Allow-Headers: Content-Type, Authorization");


	$sql = "SELECT * FROM users_admin ORDER BY Users_id ASC";
    $exeSQL = mysqli_query($conn, $sql);
		if(mysqli_num_rows($exeSQL) > 0){
			while($row_product = mysqli_fetch_array($exeSQL)){ 
				$json_array[] = array(
				  'users_id' =>  $row_product ['users_id'],
				  'user_name' =>  $row_product ['user_name'],
				  'user_email' =>  $row_product ['user_email'],
				  'user_roll' =>  $row_product ['user_roll']
				);
			}
			echo json_encode(["success"=>true,"fetchproduct"=>$json_array]);
			return;
		}
		else{
			echo json_encode(["success"=>false]);
			return;
		}
?>