<?php

require_once '../Objects/user.php';
require_once '../config/database.php';

$register_error_message = '';

// check Register request
   
     if (!empty($_POST['submit'])) {
    if ($_POST['firstname'] == "") {
        $register_error_message = 'firstName field is required!';
    }else if ($_POST['lastname'] == "") {
        $register_error_message = 'laststName field is required!';
    } else if ($_POST['email'] == "") {
        $register_error_message = 'Email field is required!';
    } else if ($_POST['mobileno'] == "") {
        $register_error_message = 'mobileno field is required!';
    } else if ($_POST['password'] == "") {
        $register_error_message = 'Password field is required!';
    }  else if (isEmail($_POST['email'])) {
        $register_error_message = 'Email is already in use!';
    } 
    else {
        
        $user_id = Register($_POST['firstname'],$_POST['lastname'], $_POST['email'], $_POST['mobileno'], $_POST['password']);
        // redirect user to the login page
        header("Location: login.php");
   
    }

}



?>
