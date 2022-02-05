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
     
     
    $product_name = $request->product_name;
    $product_price = $request->product_price;
    $product_image = $request->product_image;
    $product_quantity = $request->product_quantity;
    $product_usefor = serialize($request->product_usefor);
    $product_description = $request->product_description;
    $category_id = $request->category_id;

    $sql = "INSERT INTO product(product_name, product_price, product_image, product_quantity, product_usefor, product_description, category_id) 
    VALUES ('$product_name','$product_price','$product_image','$product_quantity','$product_usefor','$product_description', '$category_id')";
   
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