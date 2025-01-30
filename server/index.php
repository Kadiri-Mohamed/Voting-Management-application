<?php
// header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

require_once __DIR__ . '/Controllers/UsersController.php';
require_once __DIR__ . '/Controllers/PollsController.php';
require_once __DIR__ . '/Controllers/VotesController.php';



$action = $_GET['action'] ?? '';
$instance = new UsersController();
$pool_instance = new PollsController();
$vote_instance = new VotesController();

switch ($action) {
    case 'signup':
        echo $instance->signUp();
        break;

    case 'login':
        echo $instance->logIn();
        break;
    case 'getPollsByUserId':
        echo $pool_instance->getPollsByUserId();
        break;
    case 'getPublicPolls':
        echo $pool_instance->getPublicPolls();
        break;
    case 'getUserDetails':
        echo $instance->getUserDetails();
        break;
    case 'updateProfile':
        echo $instance->updateProfile();
        break;
    case 'createPool':
        echo $pool_instance->addPoll();
        break;
    case 'Vote':
        echo $vote_instance->vote();
        break;
    case 'poll';
        echo $pool_instance->find();
        break;


    default:
        echo json_encode([

            'message' => 'non action selected',
        ]);
        break;
}
?>