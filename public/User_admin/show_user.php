<?php
//include connection file
require_once '../config/database.php';


//select data query
	$sql = "SELECT * FROM users_admin ORDER BY User_id ASC";
    $exeSQL = mysqli_query($conn, $sql);
	//check if any record found
		if(mysqli_num_rows($exeSQL) > 0){
			while($row_product = mysqli_fetch_array($exeSQL)){ 
				//store data into array
				$json_array[] = array(
				  'user_id' =>  $row_product ['user_id'],
				  'user_name' =>  $row_product ['user_name'],
				  'user_email' =>  $row_product ['user_email'],
				  'user_roll' =>  $row_product ['user_roll']
				);
			}
			echo json_encode(["success"=>true,"fetchuser"=>$json_array]);
			return;
		}
		else{
			echo json_encode(["success"=>false]);
			return;
		}
?>