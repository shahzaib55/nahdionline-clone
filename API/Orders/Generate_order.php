<?php
//include connection file
require_once '../config/database.php';

 //get data from json file
$postdata = file_get_contents("php://input");
if(isset($postdata) && !empty($postdata)){
    $request = json_decode($postdata);
     
     
  //GET data from json file
    $product_id = serialize($request->product_id);
    $product_quantity = serialize($request->product_quantity);
    $user_id = $request->user_id;
    $bill = 0;

    //fetch carts only for specific user
    $sqlquery = "SELECT * FROM product_cart WHERE user_id='$user_id'";
    $exeSQL = mysqli_query($conn, $sqlquery);
		if(mysqli_num_rows($exeSQL) > 0){
			while($row_cart = mysqli_fetch_array($exeSQL)){ 

				//store data into array
                $bill = $bill + $row_cart['total_bill'];
				
			}
        }
  //fetch user information
    $query = "SELECT * FROM user_customer WHERE user_id='$user_id'";
    $querySQL=mysqli_query($conn,$query);
    if(mysqli_num_rows($querySQL) > 0){

        $row = mysqli_fetch_array($querySQL);
        $user_firstname = $row['user_firstname'];
        $user_address = $row['user_address'];

        //store user information into array
        $user_detail = serialize([$user_id,$user_firstname,$user_address]); 
        
        //store data into database
        $sql = "INSERT INTO orders(product_id, product_quantity, price, user_detail) 
        VALUES ('$product_id','$product_quantity','$bill','$user_detail')";
        if(mysqli_query($conn,$sql)){
     
            $qry = "DELETE FROM product_cart WHERE user_id= '$user_id' ";
          
    
            if(mysqli_query($conn, $qry )){ 
                session_start();
                $_SESSION["bill"] = $bill;
                header("Location: http://localhost/API/paypal_integration/request.php");
	        }
            // echo json_encode(["success"=>true,"msg"=>"inserted"]);
            
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