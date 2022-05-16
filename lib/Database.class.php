<?php
class DB{
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $dbname = 'duanmau';
    public function connect(){
        try{
            $pdo = "mysql:host=".$this->host.";dbname=".$this->dbname.";charset=utf8";
            $conn = new PDO($pdo, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e){
            die('Error:' . $e->getMessage());
        }
    }
}

?>