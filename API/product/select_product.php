<?php
//include connection file
require_once '../config/database.php';
function my_array_unique($array, $keep_key_assoc = false){
    $duplicate_keys = array();
    $tmp = array();       

    foreach ($array as $key => $val){
        // convert objects to arrays, in_array() does not support objects
        if (is_object($val))
            $val = (array)$val;

        if (!in_array($val, $tmp))
            $tmp[] = $val;
        else
            $duplicate_keys[] = $key;
    }

    foreach ($duplicate_keys as $key)
        unset($array[$key]);

    return $keep_key_assoc ? $array : array_values($array);
}
 //get data from json file
 $postdata = file_get_contents("php://input");
 if(isset($postdata) && !empty($postdata)){
     $request = json_decode($postdata);

     $product_usefor =   $request->product_usefor;
     //store values in index 
    

     //select all data from product
   $sql = "SELECT * FROM product";
    $exeSQL = mysqli_query($conn, $sql);

	//check if any record found
		if(mysqli_num_rows($exeSQL) > 0){
			while($row_product = mysqli_fetch_array($exeSQL)){ 
			      $usefor= json_decode($row_product['product_usefor']);
                $usefor=explode(",",$usefor);
       
                for ($x = 0; $x <count($product_usefor); $x++) {
	  if(in_array($product_usefor[$x],$usefor))
                  {
                //store data into array
                    $json_array[] = array(
                'product_id' =>  $row_product ['product_id'],
				  'category_id' =>  $row_product ['category_id'],
				  'product_name' =>  $row_product ['product_name'],
				  'product_price' =>  $row_product ['product_price'],
				  'product_image' =>  $row_product ['product_image'],
				  'product_quantity' =>  $row_product ['product_quantity'],
				  'product_usefor' =>  json_decode($row_product ['product_usefor']),
				  'product_description' =>  $row_product ['product_description']
                      );
            }
                }
  
}

                  //search which product to reccomend
			
			}
            //return json array
            $json_array=my_array_unique($json_array);
            echo json_encode(["success"=>true,"fetchproduct"=>$json_array]);
			return;
			
		}
		else{
			echo json_encode(["success"=>false]);
			return;
		}


 

?>