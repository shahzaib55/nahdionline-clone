<?php
//include connection file
require_once '../config/database.php';

 //get data from json file
$postdata = file_get_contents("php://input");
if(isset($postdata) && !empty($postdata)){
    $request = json_decode($postdata);
     
     
  //GET data from json file
    $product_detail[] = $request->product_detail;
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

        //create user detail array
        $user_detail[] = array(
            'user_id' => $user_id,
            'user_firstname' =>  $row['user_firstname'],
            'user_address' =>  $row['user_address']
          );
        

        
        //convert user_detail array into json form
        $user_detail = json_encode($user_detail);

        //convert product_detail array into json form
          $product_detail=json_encode($product_detail);
        //store data into database
        $sql = "INSERT INTO orders(product_detail, user_detail, total_bill) 
        VALUES ('$product_detail','$user_detail','$bill')";
        if(mysqli_query($conn,$sql)){
     
            $qry = "DELETE FROM product_cart WHERE user_id= '$user_id' ";
          
    
            if(mysqli_query($conn, $qry )){
                
                //start session of total bill 
                session_start();
                $_SESSION["bill"] = $bill;

                //move to paypal integration
                header("Location: http://localhost/API/paypal_integration/request.php");
	        }
           
            
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