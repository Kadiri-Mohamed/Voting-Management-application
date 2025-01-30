<?php
include_once __DIR__ .  '/Db.php';

class Votes
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
    public function update( $poll_id, $user_id,$option_id)
    {
        $dem = $this->pdo->prepare("UPDATE votes SET option_id=? WHERE poll_id = ? AND user_id = ?");
        return $dem->execute([$option_id, $poll_id, $user_id]);
    }
    public function find($pollId, $userId)
    {
        $dem = $this->pdo->prepare("SELECT  * FROM votes  WHERE poll_id =? AND user_id = ?");
        $dem->execute([$pollId, $userId]);
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