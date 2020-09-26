<?php
	class DbOperations{
		private $con;
		function __construct(){
			require_once dirname(__FILE__).'/DbConnect.php';
			$db = new DbConnect();
            $this->con = $db->connect();


        }


    // check if user exists
    public function isUserAvailable($username,$password){
        $stmt = $this->con->prepare("SELECT id FROM user WHERE username= ? AND password=?");
        $stmt->bind_param("ss",$username,$password);
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
        $stmt = $this->con->prepare("SELECT  id,email,username FROM user WHERE username= ? AND password = ?");
        $stmt->bind_param("ss",$username,$password);
        $stmt->execute();
        $stmt->bind_result($id,$email,$username);
        $factors = array(); 
        while($stmt->fetch()){ 
            $factor = array(); 
            $factor['id'] = $id;  
            $factor['email']=$email; 
            $factor['username']=$username; 
            array_push($factors, $factor); 
        } 
        return $factors;
    }
 // User registration...
 public function addDebtor($debtor_name,$Tel,$amount,$date_of_payment){
    $stmt = $this->con->prepare("INSERT INTO `dobtors` (`id`, `debtor_name`,`Tel`,`amount`,`date_of_payment`) VALUES (NULL,?,?,?,?);");
    $stmt->bind_param("ssss", $debtor_name,$Tel,$amount,$date_of_payment);
    if($stmt->execute()){
        return $debtor_name ." added successfully";
    }else{
        return $debtor_name ." Registration Failed!!";
    }
    }
     // check if detor exists
     public function isDebtorAvailable($name){
        $stmt = $this->con->prepare("SELECT id FROM dobtors WHERE debtor_name= ? ");
        $stmt->bind_param("s",$name);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }

    public function getDebtors(){
        $stmt = $this->con->prepare("SELECT  id,debtor_name,tel,amount,date_of_payment FROM dobtors"); 
        $stmt->execute();
        $stmt->bind_result($id,$debtor_name,$tel,$amount,$date_of_payment);
        $factors = array(); 
        while($stmt->fetch()){ 
            $factor = array(); 
            $factor['id'] = $id;  
            $factor['debtor_name']=$debtor_name;             
            $factor['amount']=$amount;             
            $factor['date_of_payment']=$date_of_payment; 
            array_push($factors, $factor); 
        } 
        return $factors;
    }
    


       // check if creditor exists
       public function isCreditorAvailable($name){
        $stmt = $this->con->prepare("SELECT id FROM credotors WHERE credotors_name= ? ");
        $stmt->bind_param("s",$name);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }

    
    public function getCreditors(){
        $stmt = $this->con->prepare("SELECT  id,credotors_name,tel,amount,date_of_payment FROM credotors"); 
        $stmt->execute();
        $stmt->bind_result($id,$credotors_name,$tel,$amount,$date_of_payment);
        $factors = array(); 
        while($stmt->fetch()){ 
            $factor = array(); 
            $factor['id'] = $id;  
            $factor['credotors_name']=$credotors_name;             
            $factor['amount']=$amount;             
            $factor['date_of_payment']=$date_of_payment; 
            array_push($factors, $factor); 
        } 
        return $factors;
    }

    // User registration...
 public function addCreditor($credotors_name,$Tel,$amount,$date_of_payment){
    $stmt = $this->con->prepare("INSERT INTO `credotors` (`id`, `credotors_name`,`Tel`,`amount`,`date_of_payment`) VALUES (NULL,?,?,?,?);");
    $stmt->bind_param("ssss", $credotors_name,$Tel,$amount,$date_of_payment);
    if($stmt->execute()){
        return $credotors_name ." added successfully";
    }else{
        return $credotors_name ." Registration Failed!!";
    }
    }
    
    
    
    }

