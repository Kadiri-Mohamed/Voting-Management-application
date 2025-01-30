<?php

include_once __DIR__ . '/../Model/Users.php';

class UsersController
{
    private $user;

    public function __construct()
    {
        $this->user = new Users();
    }

    public function find()
    {
        $id = $_POST['id'] ?? null;

        if (!$id) {
            return json_encode(['error' => "'id' is required."]);
        }

        $findSuccess = $this->user->find($id);
        return json_encode($findSuccess);
    }

    public function signUp()
    {
        $username = $_POST['username'] ?? null;
        $password = $_POST['password'] ?? null;

        if (!$username || !$password) {
            return json_encode(['error' => "'username' and 'password' are required."]);
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $signUpSuccess = $this->user->create($username, $hashedPassword);

        if ($signUpSuccess) {
            return json_encode(['message' => "User registered successfully"]);
        } else {
            return json_encode(['error' => "Failed to register user"]);
        }
    }

    public function logIn()
    {
        $username = $_POST['username'] ?? null;
        $password = $_POST['password'] ?? null;

        if (!$username || !$password) {
            return json_encode(['error' => "'username' and 'password' are required."]);
        }

        $user = $this->user->findByUsername($username);
        if ($user && password_verify($password, $user['password'])) {
            return json_encode(['user' => $user, 'status' => 'success']);
        } else {
            return json_encode(['error' => "Invalid username or password"]);
        }
    }

    public function getUserDetails()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            return json_encode(['error' => "'id' is required."]);
        }

        $userDetails = $this->user->find($id);
        if ($userDetails) {
            return json_encode(['message' => 'success', 'details' => $userDetails]);
        } else {
            return json_encode(['error' => "No user found with the given id"]);
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
            return json_encode(['status' => 'error', 'message' => 'All fields are required.']);
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

                $result = $this->user->update($id, $username, $hashedPassword, $email, $uploadPath);

                if ($result) {
                    return json_encode([
                        'status' => 'success',
                        'message' => "Profile updated successfully.",
                        'data' => [
                            'id' => $id,
                            'username' => $username,
                            'email' => $email,
                            'image_path' => $uploadPath
                        ]
                    ]);
                } else {
                    return json_encode(['status' => 'error', 'message' => "Error updating profile."]);
                }
            } else {
                return json_encode(['status' => 'error', 'message' => "Error uploading image."]);
            }
        } else {
            return json_encode(['status' => 'error', 'message' => "Invalid or no image uploaded."]);
        }
    }
}
