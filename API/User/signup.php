<?php
require_once 'database.php';
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header("Access-Control-Allow-Headers: Content-Type, Authorization");
 
$postdata = file_get_contents("php://input");
if(isset($postdata) && !empty($postdata)){
    $request = json_decode($postdata);
     
     
    $firstname = $request->firstname;
    $lastname = $request->lastname;
    $email = $request->email;
    $mobileno = $request->mobileno;
    $password = $request->password;
    $sql = "INSERT INTO users (firstname, lastname, email, mobileno, password) VALUES ('$firstname','$lastname','$email','$mobileno','$password')";
    if(mysqli_query($conn,$sql)){
        http_response_code(200);
        
    }
    else{
         http_response_code(400); 
    }
         
}

?> 