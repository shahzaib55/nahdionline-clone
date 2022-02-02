<?php
require_once '../config/database.php';
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header("Access-Control-Allow-Headers: Content-Type, Authorization");
 
$postdata = file_get_contents("php://input");
if(isset($postdata) && !empty($postdata)){
    $request = json_decode($postdata);
     
     
    $order_id = $request->order_id;
    $product_id = $request->product_id;
    $user_id = $request->user_id;
 
    $sql = "INSERT INTO orders(order_id, product_id, user_id) VALUES ('$order_id','$product_id','$user_id')";
    if(mysqli_query($conn,$sql)){
 
        
        echo json_encode(["success"=>true,"msg"=>"inserted"]);
		return;
    }
    else{
        echo json_encode(["success"=>false,"msg"=>"failed"]);
		return;
    } 
}
 else{
    echo json_encode(["success"=>false,"msg"=>"Please fill all the required fields!"]);
	return;
}  


?> 