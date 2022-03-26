<?php

require_once '../config/database.php';
   header("Location:http://localhost:3000/");
echo json_encode(["success"=>true,"msg"=>"transaction succeeded"]);
?>