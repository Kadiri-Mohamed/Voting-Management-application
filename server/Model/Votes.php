<?php
include './Db.php';

class Users
{
    private $pdo;

    public function __construct()
    {

        $temp = new Db();
        $this->pdo = $temp->connect();
    }



    public function create($poll_id, $user_id,$option_id)
    {
        $dem = $this->pdo->prepare("INSERT INTO votes (poll_id,user_id,option_id)VALUE(?,?,?)");
        return $dem->execute([$poll_id, $user_id,$option_id]);
    }
    public function update($id, $poll_id, $user_id,$option_id)
    {
        $dem = $this->pdo->prepare("UPDATE votes SET poll_id = ?, user_id = ?,option_id=? WHERE id = ?");
        return $dem->execute([$poll_id, $user_id,$option_id, $id]);
    }
    public function find($id)
    {
        $dem = $this->pdo->prepare("SELECT  * FROM votes  WHERE id=?");
        $dem->execute([$id]);
        return $dem->fetch();
    }
    public function delete($id){
        $dem=$this->pdo->prepare("DELETE FROM votes WHERE id=?");
        return $dem->execute([$id]);
    }
    public function getAll(){
        $dem=$this->pdo->prepare("SELECT* FROM votes");
        $dem->execute();
        return $dem->fetchAll();
    }


}
?>