<?php
require_once '../config/database.php';
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header("Access-Control-Allow-Headers: Content-Type, Authorization");




$data = json_decode(file_get_contents("php://input"));  
	$category_id = $data->category_id;
	$sql = "DELETE FROM product_category WHERE category_id= .$category_id. ";
    
    
    if(mysqli_query($conn, $sql)){ 
		echo json_encode(["success"=>true]);
		return;
	}
	else{
		echo json_encode(["success"=>false]);
		return;
	}
?>