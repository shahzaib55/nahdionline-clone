<?php
//include connection file
require_once '../config/database.php';

//get data query 
$postdata = file_get_contents("php://input");
if(isset($postdata) && !empty($postdata)){
    $request = json_decode($postdata);
     
     
    $product_id = $request->product_id;
    $user_id = $request->user_id;
    $quantity = $request->quantity;
    //check if the product is already in cart
   
    //select data query
        $sql = "SELECT * FROM product WHERE product_id = '$product_id'";
        $exeSQL = mysqli_query($conn, $sql);
        
        //check if any record found
        if(mysqli_num_rows($exeSQL) > 0){

        //store data into variables
            $row = mysqli_fetch_array($exeSQL);
            $product_name = $row['product_name'];
            $product_price = $row['product_price'];
            $product_quantity = $row['product_quantity'];
            $product_image = $row['product_image'];
            $total_bill = $product_price * $quantity;
           
        }else{
            echo json_encode(["success"=>false,"msg"=>"product select failed"]);
                
        }
        
        //check the product quantity availble for sale
        if($product_quantity > $quantity)
        {
            //select data query
            $sql ="SELECT * FROM product_cart WHERE product_id = '$product_id' AND user_id='$user_id'";
            $exeSQL = mysqli_query($conn, $sql);

            //check if any record found
            //if found then update 
            if(mysqli_num_rows($exeSQL) > 0){


                $row = mysqli_fetch_array($exeSQL);
           
                //store data into array
                $product_price = $row['product_price'];
                $product_quantity = $row['product_quantity'];
                $total_bill = $row['total_bill'];
                
              
                $new_quantity = $quantity;
                $new_bill = ($product_price * $new_quantity);
               
                //update data query
                $update_query = "UPDATE product_cart SET   product_quantity= '$new_quantity', total_bill='$new_bill' WHERE product_id ='$product_id' AND user_id='$user_id'";
       
                if(mysqli_query($conn,$update_query)){
         
                    echo json_encode(["success"=>true,"msg"=>"updated"]);
                    return;
                }
                else{
                    echo json_encode(["success"=>false,"msg"=>"failed"]);
                    return;
                } 


            }
            //if no existing data found then insert new 
            else{ 

                //insert data query
            $query = "INSERT INTO product_cart(product_id, product_name, product_quantity, product_price, total_bill, user_id, product_image) 
            VALUES ('$product_id','$product_name','$quantity','$product_price', '$total_bill','$user_id','$product_image')";
     
            if(mysqli_query($conn,$query)){
         
                
                echo json_encode(["success"=>true,"msg"=>"inserted"]);
                return;
            }
            else{
                echo json_encode(["success"=>false,"msg"=>"failed"]);
                return;
            } 
         }
         
        }else{
            echo json_encode(["success"=>false,"msg"=>"exceeded the limit"]);
            return;
        } 
   
}
 else{
    echo json_encode(["success"=>false,"msg"=>"Please fill all the required fields!"]);
	return;
}  


?> 