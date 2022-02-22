<?php
//include connection file
require_once '../config/database.php';

 //get data from json file
$postdata = file_get_contents("php://input");
if(isset($postdata) && !empty($postdata)){
    $request = json_decode($postdata);
    $user_firstname = $request->user_firstname;
    $user_lastname = $request->user_lastname;
    $user_email = $request->user_email;
    $user_mobileno = $request->user_mobileno;
    $user_password = $request->user_password;

    //insert data query
    $sql = "INSERT INTO user_customer (user_firstname, user_lastname, user_email, user_mobileno, user_password) 
    VALUES ('$user_firstname','$user_lastname','$user_email','$user_mobileno','$user_password')";
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