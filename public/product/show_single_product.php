<?php
//include connection file
require_once '../config/database.php';

//fetch data from json file
    $postdata = file_get_contents("php://input");
    if(isset($postdata) && !empty($postdata)){
    $request = json_decode($postdata);

    $product_id = $request->product_id;
//select data query
	$sql = "SELECT * FROM product WHERE product_id='$product_id'";
    $exeSQL = mysqli_query($conn, $sql);
		if(mysqli_num_rows($exeSQL) > 0){
			while($row_product = mysqli_fetch_array($exeSQL)){ 
				$json_array[] = array(
				  'product_id' =>  $row_product ['product_id'],
				  'product_name' =>  $row_product ['product_name'],
				  'product_price' =>  $row_product ['product_price'],
				  'product_image' =>  $row_product ['product_image'],
				  'product_quantity' =>  $row_product ['product_quantity'],
				  'product_usefor' =>  unserialize($row_product ['product_usefor']),
				  'product_description' =>  $row_product ['product_description']
				);
			}
			echo json_encode(["success"=>true,"fetchproduct"=>$json_array]);
			return;
		}
		else{
			echo json_encode(["success"=>false]);
			return;
		}
    }
    else{
        echo json_encode(["success"=>false,"msg"=>"Please fill the required field!"]);
        return;
    } 
?>