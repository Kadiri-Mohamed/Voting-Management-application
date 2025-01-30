<?php
include_once __DIR__ .  '/Db.php';
class Users
{
    private $pdo;
    public function __construct()
    {

        $temp = new Db();
        $this->pdo = $temp->connect();
    }
    public function create($username, $password)
    {
        $dem = $this->pdo->prepare("INSERT INTO users(username,password_hash)VALUE(?,?)");
        return $dem->execute([$username, $password]);
    }
    public function update($id, $username, $hashedPassword, $email, $uploadPath)
    {
        $dem = $this->pdo->prepare("UPDATE users SET username = ?, password_hash = ?  , email = ? , profile_image = ? WHERE id = ?");
        return $dem->execute([$username, $hashedPassword, $email , $uploadPath,  $id]);
    }
    public function find($id)
    {
        $dem = $this->pdo->prepare("SELECT ( username, email, profile_image) FROM users  WHERE id=?");
        $dem->execute([$id]);
        return $dem->fetch();
    
    }
    public function findByUsername($username)
    {
        $dem = $this->pdo->prepare("SELECT  * FROM users  WHERE username=?");
        $dem->execute([$username]);
        return $dem->fetch();
    }
    public function delete($id){
        $dem=$this->pdo->prepare("DELETE FROM users WHERE id=?");
        return $dem->execute([$id]);
    }
    public function getAll(){
        $dem=$this->pdo->prepare("SELECT (username,created) FROM users");
        $dem->execute();
        return $dem->fetchAll();
    }


}
?>