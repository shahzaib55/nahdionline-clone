<?php    
    /*
     * Register New User
     *
     * @param $firstname, $firstname, $email, $mobileno, $password
     * @return ID
     * */     function Register($firstname, $lastname, $email, $mobileno, $password)
    {
        
         require_once '../config/database.php';
        try {
            
            $db = getConnection();
            
            $query = $db->prepare("INSERT INTO users(firstname,lastname, email,mobileno,password) VALUES (:firstname,:lastname,:email,:mobileno,:password)");
            
            $query->bindParam("firstname", $firstname, PDO::PARAM_STR);
            $query->bindParam("lastname", $lastname, PDO::PARAM_STR);
            $query->bindParam("email", $email, PDO::PARAM_STR);
            $query->bindParam("mobileno", $mobileno, PDO::PARAM_INT);
            $enc_password = password_hash($password,  PASSWORD_DEFAULT);
            $query->bindParam("password", $password, PDO::PARAM_STR);
            
            
            $query->execute();
            
            return $db->lastInsertId();
           
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    

    /*
     * Check Email
     *
     * @param $email
     * @return boolean
     * */    
    function isEmail($email)
    {
        require_once '../config/database.php';
        try {
           
            $db = getConnection();
            $query = $db->prepare("SELECT id FROM users WHERE email=:email");
            $query->bindParam("email", $email, PDO::PARAM_STR);
            $query->execute();
            if ($query->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }
    

    /*
     * Login
     *
     * @param $username, $password
     * @return $mixed
     * */
         function Login($username, $password)
    {
        require_once '../config/database.php';
        try {
            $db = getConnection();
            $query = $db->prepare("SELECT * FROM users WHERE  (email=:email OR mobileno=:mobileno)  AND password=:password");
            $query->bindParam("email", $username, PDO::PARAM_STR);
            $query->bindParam("mobileno", $username, PDO::PARAM_INT);
            
            $query->bindParam("password", $password, PDO::PARAM_STR);
            $query->execute();
            
            if ($query->rowCount() > 0) {
                $result = $query->fetch(PDO::FETCH_OBJ);
                return $result->id;
                
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    

?>