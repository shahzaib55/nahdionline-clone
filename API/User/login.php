<?php
require_once '../config/database.php';
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header("Access-Control-Allow-Headers: Content-Type, Authorization");
 
$postdata = file_get_contents("php://input");
if(isset($postdata) && !empty($postdata)){
    $request = json_decode($postdata);
     
     
    $user_email = $request->user_email;
    $user_password = $request->user_password;
    $sql = "SELECT * FROM users WHERE  user_email='$user_email'  AND user_password='$user_password'";
    $exeSQL = mysqli_query($conn, $sql);
    if(mysqli_num_rows($exeSQL) > 0){
        while($row_user = mysqli_fetch_array($exeSQL)){ 
            $json_array[] = array(
              'user_id' =>  $row_user ['user_id'],
              'user_firstname' =>  $row_user ['user_firstname'],
              'user_lastname' =>  $row_user ['user_lastname'],
              'user_email' =>  $row_user ['user_email'],
              'user_mobileno' =>  $row_user ['user_mobileno'],
            );
        }
        echo json_encode(["success"=>true,"fetchuser"=>$json_array]);
        return;
    }
    else{
        echo json_encode(["success"=>false]);
        return;
    }


}
else{
    echo json_encode(["please fill all fields"=>false]);
    return;
}




?>   


