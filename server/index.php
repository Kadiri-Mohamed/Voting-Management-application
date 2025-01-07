<?php


include_once __DIR__ . '/Controllers/UsersController.php';
$action  = $_GET['action'] ?? '';
$userController = new UsersController();

switch ($action) {
    case 'login':
        $userController->login();

}