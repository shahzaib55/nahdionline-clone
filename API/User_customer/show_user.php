<?php
//include connection file
require_once '../config/database.php';


//select data query
	$sql = "SELECT * FROM user_customer ORDER BY user_id ASC";
    $exeSQL = mysqli_query($conn, $sql);
	 
	//check if any record found
		if(mysqli_num_rows($exeSQL) > 0){
			while($row_user = mysqli_fetch_array($exeSQL)){ 

				//store data into array
				$json_array[] = array(
				  'user_id' =>  $row_user ['user_id'],
				  'user_firstname' =>  $row_user ['user_firstname'],
				  'user_lastname' =>  $row_user ['user_lastname'],
				  'user_email' =>  $row_user ['user_email'],
                  'user_mobileno' =>  $row_user ['user_mobileno'],

				);
			}
			echo json_encode(["success"=>true,"fetchUser"=>$json_array]);
			return;
		}
		else{
			echo json_encode(["success"=>false]);
			return;
		}
?>