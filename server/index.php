<?php
header("Access-Control-Allow-Origin: *"); // Allow requests from React
header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); // Specify allowed HTTP methods
header("Access-Control-Allow-Headers: Content-Type, Authorization"); // Allow specific headers
header("Access-Control-Allow-Credentials: true"); // If you're using cookies or authentication headers

require_once __DIR__ . '/Controllers/UsersController.php'; 
require_once __DIR__ . '/Controllers/PollsController.php'; 

$action = $_GET['action'] ?? ''; 
$instance = new UsersController(); 
$poolinstance = new PollsController(); 

switch ($action) {
    case 'signup':
        echo $instance->signUp(); 
        break;

    case 'login':
        echo $instance->logIn(); 
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
