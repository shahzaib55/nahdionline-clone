<?php
require_once '../config/database.php';
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header("Access-Control-Allow-Headers: Content-Type, Authorization");
 
$postdata = file_get_contents("php://input");
if(isset($postdata)){
    $request = json_decode($postdata);
     
     //get json data
    $product_id = $request->product_id;
    $user_id = $request->user_id;
    //check if the product is already in cart
   
    
        $sql = "SELECT product_name,product_price FROM product WHERE product_id = '$product_id'";

        $exeSQL = mysqli_query($conn, $sql);
        $product_name = $exeSQL['product_name'];
        $product_price = $exeSQL['product_price'];
        $product_quantity = 1;
        $total_bill = $product_price;
        
        $sql = "INSERT INTO product_cart(product_id, product_name, product_quantity,product_price, total_bill,user_id) VALUES ('$product_id','$product_name','$product_quantity','$product_price', '$total_bill','$user_id')";
     
        if(mysqli_query($conn,$sql)){

            echo json_encode(["success"=>true,"msg"=>"updated"]);
            return;
        }else{
            echo json_encode(["success"=>false,"msg"=>"Some fields missing!"]);
            return;
        } 
    
     
    
}else{
    echo json_encode(["success"=>false,"msg"=>"some fields missing"]);
    return;
} 
 


?> 