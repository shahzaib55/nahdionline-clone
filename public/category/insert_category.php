<?php
//include connection file
require_once '../config/database.php';

 //get data from json file
$postdata = file_get_contents("php://input");
if(isset($postdata) && !empty($postdata)){
    $request = json_decode($postdata);
     
     
    $category_name = $request->category_name;
    $category_description = $request->category_description;
    
  //store data query
    $sql = "INSERT INTO product_category (category_name, category_description) VALUES ('$category_name','$category_description')";
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