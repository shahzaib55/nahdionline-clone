<?php
require_once 'database.php';
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header("Access-Control-Allow-Headers: Content-Type, Authorization");
 
$postdata = file_get_contents("php://input");
if(isset($postdata) && !empty($postdata)){
    $request = json_decode($postdata);
     
     
    $user_email = $request->user_email;
    $user_mobileno = $request->user_mobileno;
    $user_password = $request->user_password;
    $sql = "SELECT * FROM users WHERE  (user_email='$user_email' OR user_mobileno='$user_mobileno')  AND user_password='$user_password'";
    $exeSQL = mysqli_query($conn, $sql);
$checkEmail =  mysqli_num_rows($exeSQL);

if ($checkEmail != 0) {
    $arrayu = mysqli_fetch_array($exeSQL);
    if (($arrayu['user_email'] != $user_email OR $arrayu['user_mobileno'] != $user_mobileno) && $arrayu['user_password'] != $user_password) {
        $Message = "Wrong";
    } else {
        $Message = "Success";
    }
} else {
    $Message = "No account yet";
}
}else{
    $Message = "Field is empty!";
}
$response[] = array("Message" => $Message);
echo json_encode($response);
?> 