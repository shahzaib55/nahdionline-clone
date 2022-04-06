<?php
//include connection file
require_once '../config/database.php';

 //get data from json file
 $postdata = file_get_contents("php://input");
 if(isset($postdata) && !empty($postdata)){
     $request = json_decode($postdata);

     $product_usefor =   $request->product_usefor;
     //store values in index 
     $usefor1 =  $product_usefor[0];
     $usefor2 =  $product_usefor[1];
     $usefor3 =  $product_usefor[2];

     //select all data from product
   $sql = "SELECT * FROM product";
    $exeSQL = mysqli_query($conn, $sql);

	//check if any record found
		if(mysqli_num_rows($exeSQL) > 0){
			while($row_product = mysqli_fetch_array($exeSQL)){ 
			      $usefor= explode(",",$row_product['product_usefor']);
                
   echo json_encode(["success"=>true,"fetchproduct"=>$row_product['product_usefor']]);
			return;

                  //search which product to reccomend
			// 	  if(in_array($usefor1,$usefor))
            //       {
            //     //store data into array
            //         $json_array[] = array(
            //             'product_name' =>  $row_product ['product_name'],
            //             'product_price' =>  $row_product ['product_price'],
            //             'product_image' =>  $row_product ['product_image'],
            //             'product_description' =>  $row_product ['product_description']
            //           );
            // }
			}
            //return json array
            echo json_encode(["success"=>true,"fetchproduct"=>$json_array]);
			return;
			
		}
		else{
			echo json_encode(["success"=>false]);
			return;
		}


 }

?>