<?php
require_once '../config/database.php';



$request = json_decode(file_get_contents("php://input"));  
	$user_id =  $request->user_id;
	$sql = "DELETE FROM users_admin WHERE user_id= '$user_id' ";
    
    
    if(mysqli_query($conn, $sql)){ 
		echo json_encode(["success"=>true]);
		return;
	}
	else{
		echo json_encode(["success"=>false]);
		return;
	}
?>