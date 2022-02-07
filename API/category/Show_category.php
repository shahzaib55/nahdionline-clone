<?php
require_once '../config/database.php';


	$sql = "SELECT * FROM product_category ORDER BY category_id ASC";
    $exeSQL = mysqli_query($conn, $sql);
		if(mysqli_num_rows($exeSQL) > 0){
			while($row_category = mysqli_fetch_array($exeSQL)){ 
				$json_array[] = array(
				  'category_id' =>  $row_category ['category_id'],
				  'category_name' =>  $row_category ['category_name'],
				  'category_description' =>  $row_category ['category_description'],
				);
			}
			echo json_encode(["success"=>true,"fetchcategory"=>$json_array]);
			return;
		}
		else{
			echo json_encode(["success"=>false]);
			return;
		}
?>