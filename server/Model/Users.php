<?php
include_once __DIR__ .  '/Db.php';

class Users
{
    private $pdo;

    public function __construct()
    {

        $this->pdo = new Db();


    }


    public function create($username, $password)
    {
        $dem = $this->pdo->prepare("INSERT INTO users(username,password)VALUE(?,?)");
        return $dem->execute([$username, $password]);
    }
    public function update($id, $username, $password)
    {
        $dem = $this->pdo->prepare("UPDATE users SET username = ?, password = ? WHERE id = ?");
        return $dem->execute([$username, $password, $id]);
    }
    public function find($id)
    {
        $dem = $this->pdo->prepare("SELECT  (username,created) FROM users  WHERE id=?");
        $dem->execute([$id]);
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