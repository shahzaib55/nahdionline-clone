<?php
//include connection file
require_once '../config/database.php';


//select data query
	$sql = "SELECT * FROM product ORDER BY product_id ASC";
    $exeSQL = mysqli_query($conn, $sql);

	//check if any record found
		if(mysqli_num_rows($exeSQL) > 0){
			while($row_product = mysqli_fetch_array($exeSQL)){ 

				//store data into array
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
?>