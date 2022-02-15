<?php
//include connection file
require_once '../config/database.php';


//get data from json file
$data = json_decode(file_get_contents("php://input"));  
	$product_id = $data->product_id;

	//delete data query
	$sql = "DELETE FROM product WHERE product_id= '$product_id' ";
    
    
    if(mysqli_query($conn, $sql)){ 
		echo json_encode(["success"=>true]);
		return;
	}
	else{
		echo json_encode(["success"=>false]);
		return;
	}
?>