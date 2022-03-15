<?php
//include connection file
require_once '../config/database.php';


//select data query
	$sql = "SELECT * FROM product_category ORDER BY category_id ASC LIMIT 5";
    $exeSQL = mysqli_query($conn, $sql);
	
	//check if any record found
		if(mysqli_num_rows($exeSQL) > 0){
			while($row_category = mysqli_fetch_array($exeSQL)){ 

				//store data into array
				$json_array[] = array(
				  'category_id' =>  $row_category ['category_id'],
				  'category_name' =>  $row_category ['category_name'],
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