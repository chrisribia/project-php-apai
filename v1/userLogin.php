<?php  
require_once '../includes/DbOperations.php';
 
$response_data = array();
if($_SERVER['REQUEST_METHOD']=='POST'){
    $db = new DbOperations;
    if (isset($_POST['username']) AND  isset($_POST['password']) )
         {
            $isUser = $db->isUserAvailable($_POST['username'],$_POST['password']);
            if($isUser ){
              $userDetails  = $db->userLogin($_POST['username'],$_POST['password']);
              $response_data['error'] = false;
              $response_data['message'] = "Login Success";
              $response_data['user'] = $userDetails;
            }
            else{
                $response_data['error'] = false;
                $response_data['message'] = " User does not exist";
            }
         }
         else{
            $response_data['error'] = true;
            $response_data['message'] = "Make sure all Field Are Filled...";


         }

}

echo json_encode($response_data);
