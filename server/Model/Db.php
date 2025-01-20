<?php




class Db{

    public $pdo ;
    private $dsn = "mysql:host=localhost;dbname=sondages";
    private $username = "root";
    private $pass = '';
    
    public  function connect(){
        try {
            $this->pdo = new PDO($this->dsn,$this->username,$this->pass);
        } catch (PDOException $e) {
            $this->pdo = null;
            echo $e->getMessage();
        }
        return $this->pdo;
    }
    
}
