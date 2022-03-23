<?php
//include connection file
require_once '../config/database.php';


//get data from json file
$postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    $user_id = $request->user_id;
	
//select data query
	$sql = "SELECT * FROM product_cart WHERE user_id ='$user_id' ORDER BY cart_id ASC";
    $exeSQL = mysqli_query($conn, $sql);
		if(mysqli_num_rows($exeSQL) > 0){
			while($row_product = mysqli_fetch_array($exeSQL)){ 
				$json_array[] = array(
                  'cart_id' => $row_product ['cart_id'],
				  'product_id' =>  $row_product ['product_id'],
				  'product_name' =>  $row_product ['product_name'],
				  'product_quantity' =>  $row_product ['product_quantity'],
				  'product_price' =>  $row_product ['product_price'],
				  'total_bill' =>  $row_product ['total_bill'],
				  'product_image' =>  $row_product ['product_image']
				);
			}
			echo json_encode(["success"=>true,"fetchcart"=>$json_array]);
			return;
		}
		else{
			echo json_encode(["success"=>false]);
			return;
		}
?>