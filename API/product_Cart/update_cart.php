<?php
require_once '../config/database.php';

 
$postdata = file_get_contents("php://input");
if(isset($postdata)){
    $request = json_decode($postdata);
     
     //get json data
    $product_id = $request->product_id;
    $user_id = $request->user_id;
    //check if the product is already in cart
    $sql ="SELECT * FROM product_cart WHERE product_id = '$product_id' AND user_id='$user_id'";
    $exeSQL = mysqli_query($conn, $sql);
    if(mysqli_num_rows($exeSQL) > 0){

        //fetch row into variable 
        $row_cart = mysqli_fetch_array($exeSQL);

        //store data in varriables
        $price = $row_cart['product_price'];
        $quantity = $row_cart['product_quantity'];
        $total = $row_cart['total_bill'];

   
        $product_quantity_update = $quantity + 1;
        $total_update = $total + $price;

       

        $sql = "UPDATE product_cart SET   product_quantity= '$product_quantity_update', total_bill='$total_update' WHERE product_id ='$product_id' AND user_id='$user_id";
       
        if(mysqli_query($conn,$sql)){

            echo json_encode(["success"=>true,"msg"=>"updated"]);
            return;
        }
        else{
            echo json_encode(["success"=>false,"msg"=>"failed"]);
            return;
        } 
    }
    else{
        echo json_encode(["success"=>false,"msg"=>"no record found"]);
        return;
    }
     
    
}else{
    echo json_encode(["success"=>false,"msg"=>"some fields missing"]);
    return;
} 
 


?> 