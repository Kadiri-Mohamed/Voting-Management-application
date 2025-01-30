<?php
require_once '../controllers/UserController.php'; 
require_once '../controllers/PollsController.php'; 
require_once '../controllers/VotesController.php'; 


$action = $_GET['action'] ?? ''; 
$instance = new UsersController(); 
$pool_instance = new PollsController();
$vote_instance = new VotesController();

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
    case 'updateProfile':
        $instance->updateProfile();
        break;
   case 'createPool ':
        $pool_instance->addPoll();
        break;
    case 'Vote':
        $vote_instance->vote();
        break;

         
    default:
    echo json_encode([
       
        'message' => 'non action selected',
    ]);
        break;
}
?>
