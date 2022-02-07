<?php
require_once '../config/database.php';

 
$postdata = file_get_contents("php://input");
if(isset($postdata) && !empty($postdata)){
    $request = json_decode($postdata);
     
     
    $product_id = $request->product_id;
    $user_id = $request->user_id;
    $quantity = $request->quantity;
    //check if the product is already in cart
   
    
        $sql = "SELECT * FROM product WHERE product_id = '$product_id'";

        $exeSQL = mysqli_query($conn, $sql);
        if(mysqli_num_rows($exeSQL) > 0){

            $row = mysqli_fetch_array($exeSQL);
            $product_name = $row['product_name'];
            $product_price = $row['product_price'];
            $product_quantity = $row['product_quantity'];
            $total_bill = $product_price * $quantity;
            echo json_encode(["success"=>false,"msg"=>"select run"]);
        }else{
            echo json_encode(["success"=>false,"msg"=>"select failed"]);
                
        }
        
        
        if($product_quantity > $quantity)
        {
            $sql ="SELECT * FROM product_cart WHERE product_id = '$product_id' AND user_id='$user_id'";
            $exeSQL = mysqli_query($conn, $sql);
            if(mysqli_num_rows($exeSQL) > 0){


                $row = mysqli_fetch_array($exeSQL);
           
                $product_price = $row['product_price'];
                $product_quantity = $row['product_quantity'];
                $total_bill = $row['total_bill'];
                
              
                $new_quantity = $quantity;
                $new_bill = ($product_price * $new_quantity);

                $update_query = "UPDATE product_cart SET   product_quantity= '$new_quantity', total_bill='$new_bill' WHERE product_id ='$product_id' AND user_id='$user_id'";
       
                if(mysqli_query($conn,$update_query)){
         
                
                    echo json_encode(["success"=>true,"msg"=>"inserted updated"]);
                    return;
                }
                else{
                    echo json_encode(["success"=>false,"msg"=>"failed updated"]);
                    return;
                } 


            }
            else{ 
            $query = "INSERT INTO product_cart(product_id, product_name, product_quantity,product_price, total_bill,user_id) 
            VALUES ('$product_id','$product_name','$quantity','$product_price', '$total_bill','$user_id')";
     
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