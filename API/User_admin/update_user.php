<?php
require_once '../config/database.php';
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT',);
header("Access-Control-Allow-Headers: Content-Type, Authorization");
 
$postdata = file_get_contents("php://input");
if(isset($postdata) && !empty($postdata)){
    $request = json_decode($postdata);
     
    $user_name = $request->user_name;
    $user_email = $request->user_email;
    $user_password = $request->user_password;
    $user_roll = $request->user_roll;
 
    $sql = "UPDATE product SET user_name='$user_name', user_email='$user_email',user_password='$user_password',user_roll='$user_roll',
     WHERE users_id='$users_id'";
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