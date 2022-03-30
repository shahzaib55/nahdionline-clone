<?php
//include connection file
require_once '../config/database.php';

 //get data from json file
$postdata = file_get_contents("php://input");
if(isset($postdata) && !empty($postdata)){
    $request = json_decode($postdata);
     
     
  //GET data from json file
    $product_detail= json_encode($request->product_detail);
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
        $user_detail = json_encode([$user_id,$user_firstname,$user_address]); 
        
        //store data into database
        $sql = "INSERT INTO orders(product_detail, user_detail, total_bill) 
        VALUES ('$product_detail','$user_detail','$bill')";
        if(mysqli_query($conn,$sql)){
     
            $qry = "DELETE FROM product_cart WHERE user_id= '$user_id' ";
          
    
            if(mysqli_query($conn, $qry )){ 

                session_start();
       echo json_encode(["success"=>false,"msg"=>$request->order_bill]);
            return;
                // $_SESSION['bill'] = $request->order_bill;
                
              
                // header("Location: https://quiet-caverns-02461.herokuapp.com/paypal_integration/request.php");
	      
	       //ob_end_clean();
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
}?>