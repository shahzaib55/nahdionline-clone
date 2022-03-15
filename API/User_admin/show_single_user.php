<?php
//include connection file
require_once '../config/database.php';


//get dtaa from json file
$postdata = file_get_contents("php://input");
if(isset($postdata) && !empty($postdata)){

$request = json_decode($postdata);
$user_id = $request->user_id;

//select data query
	$sql = "SELECT * FROM users_admin WHERE user_id='$user_id'";
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
    }
    else{
        echo json_encode(["success"=>false,"msg"=>"Please fill the required field!"]);
        return;
    }
?>