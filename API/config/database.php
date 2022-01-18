<?php

//database Connection variables
define('HOST', 'localhost:3307'); // Database host name 
define('USER', 'root'); // Database user. 
define('PASSWORD', ''); // user password  
define('DATABASE', 'databas'); // Database Database name


//function for conection use
function getConnection()
{
    try {
        $db = new PDO('mysql:host='.HOST.';dbname='.DATABASE.'', USER, PASSWORD);
        return $db;
        echo "connected succesfully";
    } catch (PDOException $e) {
        return "Error!: " . $e->getMessage();
        die();
        
    }
    
}



?>