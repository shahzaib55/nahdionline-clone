<?php
// header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json; charset=UTF-8");
// header("Access-Control-Allow-Methods: GET");

require_once '../Objects/user.php';


$login_error_message = '';

//check Login request

if (isset($_POST['submit']) && !empty($_POST['submit'])  ) {

    $username = $_POST['username'];
    $password = $_POST['password'];


        $user_id = Login($username, $password); // check user login
        if($user_id > 0)
        {
            session_start();
            $_SESSION['id'] = $user_id; // Set Session
             header("Location: profile.php"); // Redirect user to the profile.php
            echo($user_id);
        }
        else
        {
            $login_error_message = 'Invalid login details!';
        }
    }





?>




