 <?php
require_once '../config/database.php';

//get data from json file
$data = json_decode(file_get_contents("php://input"));  
	$category_id = $data->category_id;

	//delete data query
	$sql = "DELETE FROM product_category WHERE category_id= '$category_id' ";
    
    
    if(mysqli_query($conn, $sql)){ 
		echo json_encode(["success"=>true]);
		return;
	}
	else{
		echo json_encode(["success"=>false]);
		return;
	}
?>