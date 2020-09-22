<?php
	class DbOperations{
		private $con;
		function __construct(){
			require_once dirname(__FILE__).'/DbConnect.php';
			$db = new DbConnect();
            $this->con = $db->connect();


        }


    // check if user exists
    public function isUserAvailable($username){
        $stmt = $this->con->prepare("SELECT id FROM user WHERE username= ? ");
        $stmt->bind_param("s",$username);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }

    // User registration...
        public function userRegistration($email,$username,$password){
            $stmt = $this->con->prepare("INSERT INTO `user` (`id`, `email`,`username`,`password`) VALUES (NULL,?,?,?);");
            $stmt->bind_param("sss", $email,$username,$password);
            if($stmt->execute()){
                return $username ." added successfully";
            }else{
                return $username ." Registration Failed!!";
            }
            }


    // User login
    public function userLogin($username,$password){
        $stmt = $this->con->prepare("SELECT id FROM user WHERE username= ? AND password = ? ");
        $stmt->bind_param("ss",$username,$password);
        $stmt->execute(); 
        $stmt->store_result();
        return $stmt->num_rows > 0;	
    
    }


     


    
    }

