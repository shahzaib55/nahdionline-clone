<?php
require_once '../config/database.php';

 
$postdata = file_get_contents("php://input");
if(isset($postdata) && !empty($postdata)){
    $request = json_decode($postdata);
     
    $category_id = $request->category_id;
    $category_name = $request->category_name;
    $category_description = $request->category_description;
 
    $sql = "UPDATE product_category SET category_name='$category_name', category_description='$category_description' WHERE category_id='$category_id'";
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