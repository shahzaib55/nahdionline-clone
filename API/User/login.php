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
    $user_mobileno = $request->user_mobileno;
    $user_password = $request->user_password;
    $sql = "SELECT * FROM users WHERE  (user_email='$user_email' OR user_mobileno='$user_mobileno')  AND user_password='$user_password'";
    $exeSQL = mysqli_query($conn, $sql);
$checkuser =  mysqli_num_rows($exeSQL);

if ($checkuser != 0) {
    
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
        
            array_push($user_arr["records"], $user_item);

        }
        // set response code - 200 OK
        http_response_code(200);
        // show products data in json format
      echo json_encode($user_arr);
    }

}




?>   


}