<?php
include './Db.php';

class POlls
{

    private $pdo;

    public function __construct()
    {

        $this->pdo = new Db()->connect();


    }

    public function create($title, $description, $created, $shareable, $public)
    {
        $dem = $this->pdo->prepare("INSERT INTO polls(title,description,created,shareable,public)VALUE(?,?,?,?,?)");
        return $dem->execute([$title, $description, $created, $shareable, $public]);
    }
    public function update($id, $title, $description, $created, $shareable, $public)
    {
        $dem = $this->pdo->prepare("UPDATE polls SET title = ?, description = ?,created=?,shareable=?,public=?  WHERE id = ?");
        return $dem->execute([$title, $description, $created, $shareable, $public, $id]);
    }
    public function find($id)
    {
        $dem = $this->pdo->prepare("SELECT * FROM polls  WHERE id=?");
        $dem->execute([$id]);
        return $dem->fetch();
    }
    public function delete($id){
        $dem=$this->pdo->prepare("DELETE FROM polls WHERE id=?");
        return $dem->execute([$id]);
    }
    public function getAll(){
        $dem=$this->pdo->prepare("SELECT* FROM polls");
        $dem->execute();
        return $dem->fetchAll();
    }


}



?>