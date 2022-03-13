<?php
//include connection file
require_once '../config/database.php';


//select data query
	$sql = "SELECT * FROM orders ORDER BY order_id ASC";
    $exeSQL = mysqli_query($conn, $sql);
		if(mysqli_num_rows($exeSQL) > 0){
			while($row_order = mysqli_fetch_array($exeSQL)){ 

				//store data into array
				$json_array[] = array(
				  'order_id' =>  $row_order ['order_id'],
                  'product_detail' =>  json_decode($row_order ['product_detail']),
				  'user_detail' => json_decode($row_order['user_detail']),
				  'total_bill' =>  $row_order ['total_bill'],
				  'Date' => $row_order['Date']
				  
				);
			}
			echo json_encode(["success"=>true,"fetchorder"=>$json_array]);
			return;
		}
		else{
			echo json_encode(["success"=>false]);
			return;
		}
?>