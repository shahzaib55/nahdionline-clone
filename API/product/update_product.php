<?php
//include connection file
require_once '../config/database.php';

 //get data from json file
$postdata = file_get_contents("php://input");
if(isset($postdata) && !empty($postdata)){
    $request = json_decode($postdata);
     
    $product_id = $request->product_id;
    $product_name = $request->product_name;
    $product_price = $request->product_price;
    $product_image = $request->product_image;
    $product_quantity = $request->product_quantity;
    $product_usefor = serialize($request->product_usefor);
    $product_description = $request->product_description;
    $category_id = $request->category_id;

    //update data query
    $sql = "UPDATE product SET product_name='$product_name',product_price='$product_price',product_image='$product_image'
    ,product_quantity='$product_quantity',product_usefor='$product_usefor', product_description='$product_description', category_id='$category_id' WHERE product_id='$product_id'";
    //check if the data is updated
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
