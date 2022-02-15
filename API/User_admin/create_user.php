<?php
//include connection file
require_once '../config/database.php';

 //get data from json file
$postdata = file_get_contents("php://input");
if(isset($postdata) && !empty($postdata)){
    $request = json_decode($postdata);
     
     
    $user_name = $request->user_name;
    $user_email = $request->user_email;
    $user_password = $request->user_password;
    $user_roll = $request->user_roll;

    //store data query
    $sql = "INSERT INTO users_admin (user_name, user_email, user_password, user_roll) VALUES ('$user_name','$user_email','$user_password','$user_roll')";
    if(mysqli_query($conn,$sql)){
    
        echo json_encode(["success"=>true,"msg"=>"inserted"]);
		return;
    }
    else{
        echo json_encode(["success"=>false,"msg"=>"Failed"]);
		return;
         
    }
     
}
else{
    echo json_encode(["success"=>false,"msg"=>"Please fill all the required fields!"]);
    return;
     
}

?> 