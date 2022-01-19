<?php
require_once '../config/database.php';
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header("Access-Control-Allow-Headers: Content-Type, Authorization");
 
$postdata = file_get_contents("php://input");
if(isset($postdata) && !empty($postdata)){
    $request = json_decode($postdata);
     
     
    $user_firstname = $request->user_firstname;
    $user_lastname = $request->user_lastname;
    $user_email = $request->user_email;
    $user_mobileno = $request->user_mobileno;
    $user_password = $request->user_password;

    $sql = "INSERT INTO users (user_firstname, user_lastname, user_email, user_mobileno, user_password) VALUES ('$user_firstname','$user_lastname','$user_email','$user_mobileno','$user_password')";
    if(mysqli_query($conn,$sql)){
        http_response_code(200);
        $msg="succes";
       
    }
    else{
         http_response_code(400); 
         $msg="fail";
         
    }
    echo json_encode($msg);
     
}

?> 