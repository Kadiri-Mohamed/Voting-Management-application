<?php

require_once __DIR__ . '/Controllers/UsersController.php'; 
require_once __DIR__ . '/Controllers/PollsController.php'; 

$action = $_GET['action'] ?? ''; 
$instance = new UsersController(); 
$poolinstance = new PollsController(); 

switch ($action) {
    case 'signup':
        $instance->signUp(); 
        break;

    case 'login':
        $instance->logIn(); 
        break;
    case 'poll';
        $poolinstance->find();
        break;
        

    default:
    echo json_encode([
       
        'message' => 'non action selected',
    ]);
        break;
}
?>
