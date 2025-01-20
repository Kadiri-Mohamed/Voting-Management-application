<?php

// require_once "./../Model/Users.php";
include_once __DIR__ . '/../Model/Users.php';

class UsersController{
    private $user;

     /** 
     * @fonction __construct
     * @description Initialise un objet Users pour l'utiliser dans les méthodes suivantes.
     * @param Aucun
     * @return void
     */

    public function __construct(){
        $this->user = new Users(); 
    }

    /** 
     * @fonction find
     * @description Recherche un utilisateur en fonction de son ID.
     * @param Aucun
     * @return mixed Retourne les données de l'utilisateur trouvé ou une erreur si l'ID est manquant.
     */

    public function find() {
        $id = $_POST['id'] ?? null;
        
        if (!$id) {
            return "Error: 'id' is required.";
        }
        
        $findSuccess = $this->user->find($id);
        return $findSuccess;
    }

    /** 
     * @fonction signUp
     * @description Crée un nouvel utilisateur avec un nom d'utilisateur et un mot de passe.
     * @param Aucun
     * @return string Retourne un message de succès ou une erreur selon l'état de la création de l'utilisateur.
     */

    public function signUp(){
        $username=$POST_['username'] ?? null;
        $password=$POST_['password'] ?? null;

        if(!$username || !$password){
            return "Error: 'username' and 'password' are required.";
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $signUpSucces = $this->user->create($username,$hashedPassword);

        if($signUpSucces){
            return "User registered successfully";
        }else{
            return "Error: Failed to register user";
        }
    }

    /** 
     * @fonction logIn
     * @description Permet à un utilisateur de se connecter en vérifiant son nom d'utilisateur et son mot de passe.
     * @param Aucun
     * @return string Retourne un message de succès ou une erreur selon les résultats de l'authentification.
     */
    
    public function logIn(){
        $username = $_POST['username'] ?? null;
        $password = $_POST['password'] ?? null;

        if($username || $password){
            return "Error: 'username' and 'password' are required.";
        }

        $user = $this->user->findByUsername($username);
        if ($user && password_verify($password, $user['password'])) {
            return json_encode(['user' => $user , 'status' => 'success']);
        } else {
            return json_encode(['user' => $user , 'status' => 'failed']);
            // return "Error: Invalid username or password.";
        }
    }
}
