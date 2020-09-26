<?php  
require_once '../includes/DbOperations.php';
 
$response_data = array();
if($_SERVER['REQUEST_METHOD']=='POST'){

    $db = new DbOperations;

    if (
        isset($_POST['name']) AND  isset($_POST['tel']) AND  isset($_POST['amount']) AND isset($_POST['date']))
         {
            $isUser = $db->isCreditorAvailable($_POST['name']);
            if($isUser ){
                $response_data = array();
                $response_data['error'] = true; 
                $response_data['message'] =  $_POST['name']. " Already exists, please choose another one"  ;
            }else{
                $saveRespose = $db->addCreditor($_POST['name'],$_POST['tel'],$_POST['amount'],$_POST['date']);
                $response_data = array();
                $response_data['error'] = false; 
                $response_data['message'] = "success"; 
                $response_data['creditor'] = $_POST['name'];         

            }
         }
         else{

            $response_data = array();
            $response_data['error'] = true; 
            $response_data['message'] = "Make sure all Field Are Filled..."; 


         }
         echo json_encode($response_data);


}