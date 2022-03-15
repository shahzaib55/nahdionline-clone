<?php
//include connection file
require_once '../config/database.php';

 //get data from json file
 $postdata = file_get_contents("php://input");
 if(isset($postdata) && !empty($postdata)){
     $request = json_decode($postdata);

     $product_usefor =   unserialize($request->product_usefor);
     $userfor1 =  $product_usefor[0];
     $userfor2 =  $product_usefor[1];
     $userfor3 =  $product_usefor[2];

     echo $userfor1;
     echo $userfor2;
     echo $userfor3;


 }

?>