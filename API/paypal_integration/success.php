<?php

require_once '../config/database.php';
   header("Location:http://localhost:3000/thank-you");
echo json_encode(["success"=>true,"msg"=>"transaction succeeded"]);
?>