<?php
//include connection file
require_once '../config/database.php';


//get data from json file
$postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
     
    $product_id = $request->product_id;
    $user_id = $request->user_id;

//delete data query
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