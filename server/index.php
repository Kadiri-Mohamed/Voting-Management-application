<?php
require_once '../controllers/UserController.php'; 
require_once '../controllers/PollsController.php'; 


$action = $_GET['action'] ?? ''; 
$instance = new UserController(); 
$pool_instance = new PollsController();

switch ($action) {
    case 'signup':
        $instance->signUp(); 
        break;

    case 'login':
        $instance->logIn(); 
        break;
    case 'getPollsByUserId':
        $pool_instance->getPollsByUserId();
        break;
    case 'getPublicPolls' :
        $pool_instance->getPublicPolls();
        break;
    case 'getUserDetails':
        $instance->getUserDetails();
        break;


         
    default:
    echo json_encode([
       
        'message' => 'non action selected',
    ]);
        break;
}
?>
