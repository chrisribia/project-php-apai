<?php 
require_once '../includes/DbOperations.php';
                          
        $db = new DbOperations; 
        $factors = $db->getDebtors();
        $response_data = array();
        $response_data['error'] = false; 
        $response_data['debtors'] = $factors; 
   
echo json_encode($response_data);