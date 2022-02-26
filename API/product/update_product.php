<?php
require_once '../config/database.php';

 
$postdata = file_get_contents("php://input");
if(isset($postdata) && !empty($postdata)){
    $request = json_decode($postdata);
     
    $product_id = $request->product_id;
    $product_name = $request->product_name;
    $product_price = $request->product_price;
    $product_image = $request->upload;
    $product_quantity = $request->product_quantity;
    $product_usefor = serialize($request->product_usefor);
    $product_description = $request->product_description;
    $category_id = $request->category_id;

    //fetch old image path
    $query = "SELECT product_image FROM product WHERE product_id= '$product_id' ";
	$exeSQL = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($exeSQL);
	$old_Image_Path = $row['product_image'];

    //compare with new image path
    if($product_image != $old_Image_Path){     
        //delete old image from images folder
        if (file_exists($old_Image_Path)) 
               {
                   

                 unlink($old_Image_Path);
                 
                 //update image in images folder
                 $extension = pathinfo($_FILES['upload']['name'], PATHINFO_EXTENSION);
                 $new_image_name = time() . "." . $extension;
                 move_uploaded_file($_FILES['upload']['tmp_name'],'/images/' . $new_image_name);
                 $image_path = "/images/" . $new_image_name;
                
                  //update with new image
                 $sql = "UPDATE product SET product_name='$product_name',product_price='$product_price',product_image='$image_path'
                 ,product_quantity='$product_quantity',product_usefor='$product_usefor', product_description='$product_description', category_id='$category_id' WHERE product_id='$product_id'";
                 if(mysqli_query($conn,$sql)){
                     echo json_encode(["success"=>true,"msg"=>"updated"]);
                     return;
                 }
                 else{
                     echo json_encode(["success"=>false,"msg"=>"failed"]);
                     return;
                      
                 }
              }else{
                echo json_encode(["success"=>false,"msg"=>"image not exist"]);
              }
              //update with old image     
}else{
    $qry = "UPDATE product SET product_name='$product_name',product_price='$product_price',product_image='$product_image'
                 ,product_quantity='$product_quantity',product_usefor='$product_usefor', product_description='$product_description', category_id='$category_id' WHERE product_id='$product_id'";
                 if(mysqli_query($conn,$qry)){
                     echo json_encode(["success"=>true,"msg"=>"updated"]);
                     return;
                 }
                 else{
                     echo json_encode(["success"=>false,"msg"=>"failed"]);
                     return;   
                 }
                   }
     
             }else{
                echo json_encode(["success"=>false,"msg"=>"Please fill all the required fields!"]);
                return;
                  }
?> 


