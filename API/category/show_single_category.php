<?php
require_once '../config/database.php';
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header("Access-Control-Allow-Headers: Content-Type, Authorization");




$postdata = file_get_contents("php://input");
if(isset($postdata) && !empty($postdata)){
$request = json_decode($postdata);

$category_id = $request->$category_id;

	$sql = "SELECT * FROM product_category WHERE category_id='$category_id'";
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
	}
		else{
			echo json_encode(["success"=>false,"msg"=>"Please fill the required field!"]);
			return;
		} 
?>