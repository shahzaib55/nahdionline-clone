<?php
//include connection file
require_once '../config/database.php';


//get data from json file
$postdata = file_get_contents("php://input");
    if(isset($postdata) && !empty($postdata)){
    $request = json_decode($postdata);

    $order_id = $request->order_id;

	//select data query
	$sql = "SELECT * FROM orders WHERE order_id = '$order_id'";
    $exeSQL = mysqli_query($conn, $sql);
		if(mysqli_num_rows($exeSQL) > 0){
			while($row_order = mysqli_fetch_array($exeSQL)){ 
				//store data into array
				$json_array[] = array(
				  'order_id' =>  $row_order ['order_id'],
                  'product_id' =>  unserialize($row_order ['product_id']),
				  'product_quantity' => unserialize($row_order ['product_quantity']),
				  'price' =>  $row_order ['price'],
				  'user_detail' => unserialize($row_order['user_detail']),
				  'date' => $row_order['date']
				  
				);
			}
			echo json_encode(["success"=>true,"fetchorder"=>$json_array]);
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