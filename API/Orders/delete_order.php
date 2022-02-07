<?php
require_once '../config/database.php';



$data = json_decode(file_get_contents("php://input"));  
	$order_id = $data->order_id;
	$sql = "DELETE FROM orders WHERE order_id= '$order_id' ";
    
    
    if(mysqli_query($conn, $sql)){ 
		echo json_encode(["success"=>true]);
		return;
	}
	else{
		echo json_encode(["success"=>false]);
		return;
	}
?>