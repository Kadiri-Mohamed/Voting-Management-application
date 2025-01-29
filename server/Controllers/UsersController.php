<?php

// require_once "./../Model/Users.php";
include_once __DIR__ . '/../Model/Users.php';

class UsersController
{
    private $user;

    /** 
     * @fonction __construct
     * @description Initialise un objet Users pour l'utiliser dans les méthodes suivantes.
     * @param Aucun
     * @return void
     */

    public function __construct()
    {
        $this->user = new Users();
    }

    /** 
     * @fonction find
     * @description Recherche un utilisateur en fonction de son ID.
     * @param Aucun
     * @return mixed Retourne les données de l'utilisateur trouvé ou une erreur si l'ID est manquant.
     */

    public function find()
    {
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

    public function signUp()
    {
        $username = $POST_['username'] ?? null;
        $password = $POST_['password'] ?? null;

        if (!$username || !$password) {
            return "Error: 'username' and 'password' are required.";
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $signUpSucces = $this->user->create($username, $hashedPassword);

        if ($signUpSucces) {
            return "User registered successfully";
        } else {
            return "Error: Failed to register user";
        }
    }

    /** 
     * @fonction logIn
     * @description Permet à un utilisateur de se connecter en vérifiant son nom d'utilisateur et son mot de passe.
     * @param Aucun
     * @return string Retourne un message de succès ou une erreur selon les résultats de l'authentification.
     */

    public function logIn()
    {
        $username = $_POST['username'] ?? null;
        $password = $_POST['password'] ?? null;

        if ($username || $password) {
            return "Error: 'username' and 'password' are required.";
        }

        $user = $this->user->findByUsername($username);
        if ($user && password_verify($password, $user['password'])) {
            return json_encode(['user' => $user, 'status' => 'success']);
        } else {
            return json_encode(['user' => $user, 'status' => 'failed']);
            // return "Error: Invalid username or password.";
        }
    }

    public function getUserDetails()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            return json_encode([
                'message' => 'Error :id is required'
            ]);
        }

        $userDetails = $this->user->find($id);
        if ($userDetails) {
            return json_encode([
                'message' => 'success',
                'details' => $userDetails,
            ]);
        } else {
            return json_encode([
                'message' => 'Error : no user found with the given id'
            ]);
        }
    }

    public function updateProfile()
    {
        $id = $_POST['id'] ?? null;
        $username = $_POST['username'] ?? null;
        $password = $_POST['password'] ?? null;
        $email = $_POST['email'] ?? null;
        $img = $_FILES['image'] ?? null;

        if (!$id || !$username || !$password || !$email || !$img) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Tous les champs sont obligatoires.'
            ]);
            return;
        }

        if ($img && $img['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'Images/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $imgName = uniqid() . '-' . basename($img['name']);
            $uploadPath = $uploadDir . $imgName;

            if (move_uploaded_file($img['tmp_name'], $uploadPath)) {
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

                $result = $this->user->update([$id, $username, $hashedPassword, $email, $uploadPath]);

                if ($result) {
                    echo json_encode([
                        'status' => 'success',
                        'message' => "Profil mis à jour avec succès.",
                        'data' => [
                            'id' => $id,
                            'username' => $username,
                            'email' => $email,
                            'image_path' => $uploadPath
                        ]
                    ]);
                } else {
                    echo json_encode([
                        'status' => 'error',
                        'message' => "Erreur lors de la mise à jour du profil."
                    ]);
                }
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => "Erreur lors du téléchargement de l'image."
                ]);
                return;
            }
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => "Image invalide ou non envoyée."
            ]);
            return;
        }
    }
}
