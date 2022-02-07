<?php
require_once '../config/database.php';

 
$postdata = file_get_contents("php://input");
if(isset($postdata) && !empty($postdata)){
    $request = json_decode($postdata);
     
     

    $product_id = serilize($request->product_id);
    $product_quantity = serilize($request->$product_quantity);
    $user_id = $request->user_id;
    $price = $request->price;

    $query = "SELECT * FROM user_customer WHERE user_id='$user_id'";
    $querySQL=mysqli_query($conn,$sql);
    if(mysqli_num_rows($exeSQL) > 0){

        $row = mysqli_fetch_array($exeSQL);
        $user_firstname = $row['user_firstname'];
        $user_address = $row['user_address'];

        $user_detail[] = array(
            'user_id'   => $user_id,             
            'user_firstname' => $user_firstname,          
            'user_address' => $user_address 
        );
        serialize($user_detail);

        $sql = "INSERT INTO orders(product_id, product_quantity, price, user_detail) 
        VALUES ('$product_id','$product_quantity','$price','$user_detail')";
        if(mysqli_query($conn,$sql)){
     
            
            echo json_encode(["success"=>true,"msg"=>"inserted"]);
            return;
        }
        else{
            echo json_encode(["success"=>false,"msg"=>"failed"]);
            return;
        } 

    }else{
        echo json_encode(["success"=>true,"msg"=>"record not found"]);
    }



    
}
 else{
    echo json_encode(["success"=>false,"msg"=>"Please fill all the required fields!"]);
	return;
}  


?> 