<?php
//include connection file
require_once '../config/database.php';

 //get data from json file
$postdata = file_get_contents("php://input");
if(isset($postdata) && !empty($postdata)){
    $request = json_decode($postdata);
     
    $order_id = $request->order_id;
    $product_id = serialize($request->product_id);
    $product_quantity = serialize($request->product_quantity);
    $price = $request->price;
   
 //update data query
    $sql = "UPDATE orders SET product_id='$product_id', product_quantity='$product_quantity', price='$price'  WHERE order_id='$order_id'";
    if(mysqli_query($conn,$sql)){
 
        echo json_encode(["success"=>true,"msg"=>"updated"]);
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