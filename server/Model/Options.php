<?php
include './Db.php';

class Options
{

    private $pdo;

    public function __construct()
    {

        $temp = new Db();
        $this->pdo = $temp->connect();
    }

    public function create($poll, $option)
    {
        $dem = $this->pdo->prepare("INSERT INTO options(poll,option)VALUE(?,?)");
        return $dem->execute([$poll, $option,]);
    }

    public function update($id, $poll_id, $option_text)
    {
        $dem = $this->pdo->prepare("UPDATE options SET poll_id = ?, option_text = ?  WHERE id = ?");
        return $dem->execute([$poll_id, $option_text,$id]);
    }

    public function find($id)
    {
        $dem = $this->pdo->prepare("SELECT * FROM options  WHERE id=?");
        $dem->execute([$id]);
        return $dem->fetch();
    }
    public function delete($id){
        $dem=$this->pdo->prepare("DELETE FROM options WHERE id=?");
        return $dem->execute([$id]);
    }
    public function getAll(){
        $dem=$this->pdo->prepare("SELECT* FROM options");
        $dem->execute();
        return $dem->fetchAll();
    }


}



?>