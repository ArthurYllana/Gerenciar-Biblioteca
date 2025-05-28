<?php

class Database {
    private $host = 'localhost';
    private $db_name = 'biblioteca';
    private $username = 'root';
    private $password = '';
    private $DBConn;

    public function __construct($servidor = 'localhost', $nomeBanco = 'biblioteca', 
                               $usuario = 'root', $senha = '') {
        $this->host = $servidor;
        $this->db_name = $nomeBanco;
        $this->username = $usuario;
        $this->password = $senha;
        $this->createDatabase();
    }

    public function createDatabase() {
        try {
            // Conexão inicial sem database especificado
            $this->DBConn = new PDO(
                'mysql:host=' . $this->host, 
                $this->username, 
                $this->password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );

            $this->DBConn->exec('CREATE DATABASE IF NOT EXISTS ' . $this->db_name);
            
            // Reconectar ao database específico
            $this->DBConn = new PDO(
                'mysql:host=' . $this->host . ';dbname=' . $this->db_name,
                $this->username,
                $this->password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
            $this->DBConn->exec('SET NAMES utf8');
        } catch (PDOException $e) {
            error_log("Erro ao criar o banco de dados: " . $e->getMessage());
            throw new Exception("Erro ao conectar-se ao banco de dados.");
        }
    }

    public function getConnection() {
        try {
            if ($this->DBConn === null) {
                $this->DBConn = new PDO(
                    'mysql:host=' . $this->host . ';dbname=' . $this->db_name,
                    $this->username,
                    $this->password,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]
                );
                $this->DBConn->exec('SET NAMES utf8');
            }
            return $this->DBConn;
        } catch (PDOException $e) {
            error_log("Erro ao conectar-se ao banco: " . $e->getMessage());
            throw new Exception("Falha na conexão. Por favor, tente novamente mais tarde.");
        }
    }
}
?>