<?php
require_once '../config/database.php';
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header("Access-Control-Allow-Headers: Content-Type, Authorization");


	$sql = "SELECT * FROM order ORDER BY order_id ASC";
    $exeSQL = mysqli_query($conn, $sql);
		if(mysqli_num_rows($exeSQL) > 0){
			while($row_product = mysqli_fetch_array($exeSQL)){ 
				$json_array[] = array(
				  'order_id' =>  $row_product ['order_id'],
                  'product_id' =>  $row_product ['product_id'],
				  'user_id' =>  $row_product ['user_id'],
				  
				);
			}
			echo json_encode(["success"=>true,"fetchorder"=>$json_array]);
			return;
		}
		else{
			echo json_encode(["success"=>false]);
			return;
		}
?>