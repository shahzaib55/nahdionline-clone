<?php
//include connection
require_once '../config/database.php';

 //get data from json file
$postdata = file_get_contents("php://input");
if(isset($postdata) && !empty($postdata)){
    $request = json_decode($postdata);
     
     
    $product_name = $request->product_name;
    $product_price = $request->product_price;
    $product_image = $request->product_image;
    $product_quantity = $request->product_quantity;
    $product_usefor = json_encode($request->product_usefor);
    $product_description = $request->product_description;
    $category_id = $request->category_id;

    //store data query
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