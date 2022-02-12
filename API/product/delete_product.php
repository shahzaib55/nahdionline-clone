<?php
require_once '../config/database.php';



$data = json_decode(file_get_contents("php://input"));  
	$product_id = $data->product_id;
    $query = "SELECT product_image FROM product WHERE product_id= '$product_id' ";
	$exeSQL = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($exeSQL);
	$filePath = $row['product_image'];
	$sql = "DELETE FROM product WHERE product_id= '$product_id' ";
    
    
    if(mysqli_query($conn, $sql)){ 
		if (file_exists($filePath)) 
               {
                 unlink($filePath);
                  
              }
              else
              {
               echo "File does not exists"; 
              }
		echo json_encode(["success"=>true]);
		return;
	}
	else{
		echo json_encode(["success"=>false]);
		return;
	}
?>