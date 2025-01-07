<?php
require_once '../controllers/UserController.php'; 

$action = $_GET['action'] ?? ''; 
$instance = new UserController(); 

switch ($action) {
    case 'signup':
        $instance->signUp(); 
        break;

    case 'login':
        $instance->logIn(); 
        break;

    default:
    echo json_encode([
       
        'message' => 'non action selected',
    ]);
        break;
}
?>
