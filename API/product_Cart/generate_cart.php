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
    
    //check if the product is already in cart
    $sql ="SELECT * FROM Cart WHERE product_id = '$product_id'";
    $exeSQL = mysqli_query($conn, $sql);
    if(mysqli_num_rows($exeSQL) > 0){

        //fetch row into variable 
        $row_cart = mysqli_fetch_array($exeSQL);

        //store data in varriables
        $price = $row_cart['product_price'];
        $quantity = $row_cart['product_quantity'];
        $total = $row_cart['total_bill'];

   
        $update_quantity = $quantity + 1;
        $update_total = $total + $price;

        $sql = "SELECT product_name FROM product WHERE product_id = '$product_id'";
        
    }
 
    $sql = "INSERT INTO product_cart(product_id) VALUES ('$product_id')";
    if(mysqli_query($conn,$sql)){
 
        
        echo json_encode(["success"=>true,"msg"=>"inserted"]);
		return;
    }
    else{
        echo json_encode(["success"=>false,"msg"=>"failed"]);
		return;
    } 
}
 else{
    echo json_encode(["success"=>false,"msg"=>"Some fields missing!"]);
	return;
}  


?> 