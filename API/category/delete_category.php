 <?php
require_once '../config/database.php';


$data = json_decode(file_get_contents("php://input"));  
	$category_id = $data->category_id;
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