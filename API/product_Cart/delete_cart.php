<?php
require_once '../config/database.php';
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header("Access-Control-Allow-Headers: Content-Type, Authorization");




$postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
     
    $product_id = $request->product_id;
    $user_id = $request->user_id;


	$sql = "DELETE FROM product_cart WHERE product_id= '$product_id' AND user_id= '$user_id' ";
    
    if(mysqli_query($conn, $sql)){ 
		echo json_encode(["success"=>true]);
		return;
	}
	else{
		echo json_encode(["success"=>false]);
		return;
	}
?>