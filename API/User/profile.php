<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
error_reporting(E_ALL & ~E_NOTICE);

session_start();
require_once '../config/data.php';
try {
    $id=$_SESSION['id'];
    $db = getConnection();
    $query = $db->prepare("SELECT * FROM users WHERE  id=:id  ");
    $query->bindParam("id", $id, PDO::PARAM_INT);
    // query record
    $query->execute();
    $num=$query->rowCount();
 


// check if more than 0 record found
if($num>0){
  
    // products array
    $products_arr=array();
    $products_arr["records"]=array();
  
   
    while ($row = $query->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $product_item=array(
            "id" => $id,
            "firstname" => $firstname,
            "lastname" => $lastname,
            "email" => $email,
            "password" => $password,
            "mobileno" => $mobileno
            
        );
  
        array_push($products_arr["records"], $product_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show user data in json format
    echo json_encode($products_arr);
}
} catch (PDOException $e) {
    echo "error : " . $e->getMessage();
}


?>