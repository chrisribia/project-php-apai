<?php  
require_once '../includes/DbOperations.php';
 
$response_data = array();
if($_SERVER['REQUEST_METHOD']=='POST'){

    $db = new DbOperations;

    if (
        isset($_POST['username']) AND     isset($_POST['password']) )
         {
            $isUser = $db->isUserAvailable($_POST['username']);
            if($isUser ){ 
                if($db->userLogin($_POST['username'],$_POST['password'])){
                    $response_data = array();
                    $response_data['error'] = false; 
                    $response_data['message'] = "success login"; 
                    $response_data['user'] = $_POST['username'] ;
 

                }else{
                    $response_data = array();
                    $response_data['error'] = false; 
                    $response_data['message'] = "User password Wrong ..."; 


                }


            }else{ 
                $response_data = array();
                $response_data['error'] = false; 
                $response_data['message'] = " User does not exist"; 
        

            }
         }
         else{

            $response_data = array();
            $response_data['error'] = true; 
            $response_data['message'] = "Make sure all Field Are Filled..."; 


         }
         echo json_encode($response_data);


}