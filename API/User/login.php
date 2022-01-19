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
        http_response_code(400);
    } else {
        $user_arr=array();
        $user_arr["records"]=array();
       
        while ($row = $sql->fetch_assoc()){
            // extract row
            // this will make $row['name'] to
            // just $name only
            extract($row);
        
            $user_item=array(
                "user_id" => $user_id,
                "user_firstname" => $user_firstname,
                "user_lastname" => $user_lastname,
                "user_email" => $user_email,
                "user_mobileno" => $user_mobileno,
                "user_password" => $user_password
            );
        
            array_push($user_arr["user"], $user_item);
        }
        // set response code - 200 OK
        http_response_code(200);
    }
}
}



// show products data in json format
echo json_encode($user_arr);
?>   


}