<?php

class Database  {
    private $host = "localhost";
    private $dbname = "Biblioteca"; 
    private $user = "root";
    private $passwd = "";

    public function getConnection() {
        $conn = null;
        try {
            $conn = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname,
                     $this->user, $this->passwd);
            $conn->exec("set names utf8");
        }
        catch (PDOException $erro) {
            echo "Erro de conexão: " . $erro->getMessage(); 
        }
        return $conn;
    }
}
?>